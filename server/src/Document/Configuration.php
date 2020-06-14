<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Configuration
 * @MongoDB\Document()
 * @Vich\Uploadable
 */
class Configuration
{
    /**
     * @MongoDB\Id(strategy="INCREMENT", type="string")
     */
    private ?string $id = null;

    /**
     * @MongoDB\Field(type="string")
     */
    private ?string $site_title;

    /**
     * @MongoDB\Field(type="string")
     */
    private ?string $fullName;

    /**
     * @MongoDB\Field(type="string")
     */
    private ?string $headline;

    /**
     * @MongoDB\Field(type="string")
     */
    private ?string $personalEmail;

    /**
     * @Vich\UploadableField(mapping="profile_image", fileNameProperty="imageName", size="imageSize")
     */
    private ?File $imageFile = null;

    /**
     * @MongoDB\Field(type="string")
     */
    private ?string $imageName = null;

    private ?int $imageSize = null;
    /**
     * @MongoDB\Field(type="date")
     */
    private ?\DateTime $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiteTitle(): ?string
    {
        return $this->site_title;
    }

    public function setSiteTitle(string $site_title): self
    {
        $this->site_title = $site_title;
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function getHeadline(): ?string
    {
        return $this->headline;
    }

    public function setHeadline(string $headline): self
    {
        $this->headline = $headline;
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function getPersonalEmail(): ?string
    {
        return $this->personalEmail;
    }

    public function setPersonalEmail(?string $personalEmail): self
    {
        $this->personalEmail = $personalEmail;
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTime();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): self
    {
        $this->imageSize = $imageSize;
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
}
