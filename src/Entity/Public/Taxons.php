<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;


#[Entity()]
#[Table(name: 'public.taxons_clear')] //TODO working with view
class Taxons
{
    use TId;

    #[ManyToOne(targetEntity: TaxonRanks::class)]
    #[JoinColumn(name: 'rank', referencedColumnName: 'id')]
    protected TaxonRanks $rank;

    #[Column(type: 'string')]
    private(set) string $author;

    #[Column(type: 'string')]
    private(set) string $comment;

    #[Column(type: 'integer')]
    private(set) int $depth;

    #[Column(name: 'depth_backup', type: 'integer')]
    private(set) int $depthBackup;

    #[Column(name: 'id_dani', type: 'string')]
    private(set) string $idDanihelka;

    #[Column(type: 'integer')]
    private(set) int $lft;

    #[Column(name:'lft_backup', type: 'integer')]
    private(set) int $lft_backup;

    #[Column(name: 'name_cz', type: 'string')]
    private(set) string $nameCz;

    #[Column(name: 'name_html', type: 'string')]
    private(set) string $nameHtml;

    #[Column(name: 'name_lat', type: 'string')]
    private(set) string $nameLatin;

    #[Column(type: 'string')]
    private(set) string $parents;

    #[Column(name: 'parents_cz', type: 'string')]
    private(set) string $parentsCz;

    #[Column(type: 'integer')]
    private(set) int $rgt;

    #[Column(name:'rgt_backup', type: 'integer')]
    private(set) int $rgt_backup;

    #[Column(type: 'boolean')]
    private(set) bool $suppressed;

    /**
     * hide localities on the public presentation
     */
    #[Column(type: 'boolean')]
    private(set) bool $protected;


    public function getNamePreslia()
    {
        $name = str_replace(".", "", $this->nameLatin) . "_report.pdf";
        $name = str_replace(" ", "_", $name);
        return $name;
    }


    public function isTerminating()
    {
        if ($this->lft + 1 == $this->rgt) {
            return true;
        }
        return false;
    }


}
