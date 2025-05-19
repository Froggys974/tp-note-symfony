<?php

namespace App\Entity;

use App\Enum\ParticipantStatusEnum;
use App\Repository\ParticipantRepository;
use App\Trait\CreationModificationTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    use CreationModificationTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    private ?Event $event = null;

    #[ORM\ManyToOne(inversedBy: 'participations')]
    private ?User $user = null;

    #[ORM\Column(enumType: ParticipantStatusEnum::class)]
    private ?ParticipantStatusEnum $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $registrationDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getStatus(): ?ParticipantStatusEnum
    {
        return $this->status;
    }

    public function setStatus(ParticipantStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeImmutable
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeImmutable $registrationDate): static
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }
}
