<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CertificateRepository")
 */
class Certificate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string a unique identifier of the certificate
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $code;

    /**
     * @var string an incremented number representing certificates that resets every year
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $number;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $createdAt;

    /**
     * @var Student the user that created this certificate
     * @ORM\ManyToOne(targetEntity="App\Entity\Student")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $createdBy;


    // ========================= Getters & Setters ========================= \\


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?Student
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Student $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
