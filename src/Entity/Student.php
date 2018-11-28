<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Student
{
    /**
     * configuration options
     */
    public const NUM_ITEMS = 25;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string student registration code
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @var string student national code
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $cne;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthPlace;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date()
     */
    private $birthDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StudyLevel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $studyLevel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StudyLevelOldRegime")
     * @ORM\JoinColumn(nullable=false)
     */
    private $studyLevelOldRegime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StudyLevelNewRegime")
     * @ORM\JoinColumn(nullable=false)
     */
    private $studyLevelNewRegime;

    /**
     * @var \DateTime the date by which the student left the school
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date()
     */
    private $stopDate;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comments;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $deleted = 0;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var Student
     * @ORM\ManyToOne(targetEntity="App\Entity\Student")
     * @ORM\JoinColumn(nullable=true)
     */
    private $deletedBy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Certificate", mappedBy="student", orphanRemoval=true)
     */
    private $certificates;


    // ========================= Getters & Setters ========================= \\

    public function __construct()
    {
        $this->certificates = new ArrayCollection();
    }

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->lastName . ' ' . $this->firstName;
    }

    public function getCne(): ?string
    {
        return $this->cne;
    }

    public function setCne(string $cne): self
    {
        $this->cne = $cne;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(string $birthPlace): self
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }


    public function getStudyLevel(): ?StudyLevel
    {
        return $this->studyLevel;
    }

    public function setStudyLevel(?StudyLevel $studyLevel): self
    {
        $this->studyLevel = $studyLevel;

        return $this;
    }

    public function getStudyLevelOldRegime():?string
    {
        return $this->studyLevelOldRegime;
    }

    public function setStudyLevelOldRegime(?string $studyLevelOldRegime):self
    {
        $this->studyLevelOldRegime = $studyLevelOldRegime;
        return $this;
    }

    public function getStudyLevelNewRegime():?string
    {
        return $this->studyLevelNewRegime;
    }
    public function setStudyLevelNewRegime(?string $studyLevelNewRegime):self
    {
        $this->studyLevelNewRegime = $studyLevelNewRegime;
        return $this;
    }


    public function getStopDate(): ?\DateTimeInterface
    {
        return $this->stopDate;
    }

    public function setStopDate(\DateTimeInterface $stopDate): self
    {
        $this->stopDate = $stopDate;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(?bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getDeletedBy(): ?self
    {
        return $this->deletedBy;
    }

    public function setDeletedBy(?self $deletedBy): self
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    /**
     * @return Collection|Certificate[]
     */
    public function getCertificates(): Collection
    {
        return $this->certificates;
    }

    public function addCertificate(Certificate $certificate): self
    {
        if (!$this->certificates->contains($certificate)) {
            $this->certificates[] = $certificate;
            $certificate->setStudent($this);
        }

        return $this;
    }

    public function removeCertificate(Certificate $certificate): self
    {
        if ($this->certificates->contains($certificate)) {
            $this->certificates->removeElement($certificate);
            // set the owning side to null (unless already changed)
            if ($certificate->getStudent() === $this) {
                $certificate->setStudent(null);
            }
        }

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

    // ========================= Special methods =========================== \\

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        $dateTimeNow = new \DateTime('now');
        $this->setUpdatedAt($dateTimeNow);
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }

    public function __toString(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

}
