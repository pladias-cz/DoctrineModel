<?php declare(strict_types = 1);

namespace Pladias\ORM\Entity\Attributes;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;

trait TOriginalFileAt
{

    #[Column(name: 'original_file_timestamp', type: Types::DATETIME_IMMUTABLE, nullable: true, options: ['comment' => 'Timestamp of original file creation'])]
    private(set) ?DateTimeImmutable $originalFileTimestamp;

    public function setOriginalFileAt(?DateTimeImmutable $timestamp): mixed
    {
        $this->originalFileTimestamp = $timestamp;

        return $this;
    }

}
