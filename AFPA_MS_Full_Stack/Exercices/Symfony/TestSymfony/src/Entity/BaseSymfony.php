<?php

namespace App\Entity;

use App\Repository\BaseSymfonyRepository;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Name;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Attribute\Route as AttributeRoute;
use Symfony\Component\Routing\Router;

#[ORM\Entity(repositoryClass: BaseSymfonyRepository::class)]
class BaseSymfony
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): static
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    
}