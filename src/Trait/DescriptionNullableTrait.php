<?php

namespace App\Trait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
trait DescriptionNullableTrait
{
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
