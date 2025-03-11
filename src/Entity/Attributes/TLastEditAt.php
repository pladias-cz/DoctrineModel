<?php declare(strict_types = 1);

namespace Pladias\ORM\Entity\Attributes;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\PreUpdate;

trait TLastEditAt
{

    #[Column(name: 'lastedit_timestamp', type: Types::DATETIME_MUTABLE, nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private(set) ?DateTime $lastEdit = null;

    #[PreUpdate]
    public function setLastEditAt(): mixed
    {
        $this->lastEdit = new DateTime();

        return $this;
    }

}
