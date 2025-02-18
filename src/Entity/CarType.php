<?php

namespace App\Entity;

use App\Repository\CarTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarTypeRepository::class)]
class CarType
{

    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $name = null;


	public function __construct(string $name)
	{
		$this->setName($name);
	}

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
