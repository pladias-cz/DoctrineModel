<?php declare(strict_types = 1);

namespace Pladias\ORM\Repository\Public;

use Pladias\ORM\Repository\AbstractRepository;


class TaxonsRepository extends AbstractRepository
{
    public function findAutocompleteInValidNames($name): array
    {
        $name1 = $name . "%";
        $name2 = "% " . $name . "%";

        /**
         * metapriority is used to sort genus-part-starting before epithet-starting names
         */
        $sql = "SELECT value,id FROM (
                select DISTINCT ON (value) value, id, metapriority, succession FROM(           
                (SELECT name_lat AS value, t.id, r.succession, 1 AS metapriority
                FROM public.taxons_clear t
				JOIN public.taxon_ranks r ON (r.id = t.rank)
 			    WHERE
 			    lower(unaccent(name_lat)) LIKE lower(unaccent(:name1)) )
            UNION
 			    (SELECT name_lat AS value, t.id, r.succession, 10 AS metapriority
                FROM public.taxons_clear t
				JOIN public.taxon_ranks r ON (r.id = t.rank)
 			    WHERE
 			    lower(unaccent(name_lat)) LIKE lower(unaccent(:name2)) )
            UNION
 			    (
 			    SELECT name_lat AS value, t.id, r.succession, 2 AS metapriority
                FROM public.taxons_clear t
				JOIN public.taxon_ranks r ON (r.id = t.rank)
 			    WHERE
 			    lower(unaccent(replace(name_lat,'×','x'))) LIKE lower(unaccent(:name1))
 			    )
            UNION
 			    (
 			    SELECT name_lat AS value, t.id, r.succession, 20 AS metapriority
                FROM public.taxons_clear t
				JOIN public.taxon_ranks r ON (r.id = t.rank)
 			    WHERE
 			    lower(unaccent(replace(name_lat,'×','x'))) LIKE lower(unaccent(:name2))
 			    )
                ) as ss
                ) as tt
                ORDER BY metapriority ASC, succession ASC, value  ";

        $query = $this->getEntityManager()->getConnection()->prepare($sql);
        $query->bindValue('name1', $name1);
        $query->bindValue('name2', $name2);
        $result =  $query->executeQuery();
        return $result->fetchAllAssociative();
    }

}
