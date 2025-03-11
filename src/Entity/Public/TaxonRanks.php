<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'public.taxon_ranks')]
class TaxonRanks
{
    use TId;

    const GENUS_ID = 28;
    const CLASS_ID = 19;
    const FAMILIA_ID = 24;
    const LOWER_THAN_GENUS = array(4, 30, 32, 34, 35, 36, 37, 38, 39, 46, 47, 53, 54, 56, 57);
    const ORDER_AND_LOWER = array(4, 22, 23, 24, 25, 26, 27, 28, 29, 30, 32, 34, 35, 36, 37, 38, 39, 46, 47, 53, 54, 56, 57);
    const CULTIVAR = array(57);

    #[Column(name: 'abbrev_eng', type: 'string')]
    private(set) string $abbreviationEng;

    #[Column(type: 'string')]
    private(set) string $category;

    #[Column(type: 'string')]
    private(set) string $icn;

    #[Column(name: 'id_dani', type: 'string')]
    private(set) string $idDanihelka;

    #[Column(type: 'string')]
    private(set) string $succession;

    #[Column(name: 'id_tv3', type: 'string')]
    private(set) string $id_tv3;

    #[Column(name: 'name_addon', type: 'string')]
    private(set) string $nameSuffix;

    #[Column(name: 'name_cz', type: 'string')]
    private(set) string $nameCz;

    #[Column(name: 'name_eng', type: 'string')]
    private(set) string $nameEng;

    public function isSpeciesOrLower(): bool
    {
        return $this->isLowerThanGenus();
    }

    public function isLowerThanGenus(): bool
    {
        if (in_array($this->id, self::LOWER_THAN_GENUS)) {
            return true;
        }
        return false;
    }

    public function isGenus(): bool
    {
        if (self::GENUS_ID === $this->id) {
            return true;
        }
        return false;
    }

    public function isOrderOrLower(): bool
    {
        if (in_array($this->id, self::ORDER_AND_LOWER)) {
            return true;
        }
        return false;
    }
}
