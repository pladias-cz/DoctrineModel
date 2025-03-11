<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'public.users')]
class Users
{
    use TId;

    #[Column(type: 'boolean')]
    private(set) bool $biblioadmin;

    #[Column(type: 'boolean')]
    private(set) bool $deleted;

    #[Column(type: 'string')]
    private(set) string $description;

    #[Column(type: 'string')]
    private(set) string $email;

    #[Column(type: 'integer')]
    private(set) int $last_taxon_id;

    #[Column(type: 'boolean')]
    private(set) bool $mapadmin;

    #[Column(type: 'string')]
    private(set) string $name;

    #[Column(type: 'string')]
    private(set) string $password;

    #[Column(type: 'string')]
    private(set) string $surname;

    #[Column(type: 'boolean')]
    private(set) bool $sysadmin;

    #[Column(type: 'boolean')]
    private(set) bool $taxonadmin;

    #[Column(type: 'boolean')]
    private(set) bool $traitadmin;


}
