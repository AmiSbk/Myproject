<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'task')]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'The name cannot be blank.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'The name cannot exceed {{ limit }} characters.'
    )]

    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: 'The status cannot be blank.')]
    #[Assert\Choice(
        choices: ['Pending', 'In Progress', 'Completed'],
        message: 'The status must be one of "Pending", "In Progress", or "Completed".'
    )]
    private ?string $status = null;

    // GETTERS ET SETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
}
