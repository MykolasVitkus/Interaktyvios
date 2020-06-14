<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class ContactMessage
 * @MongoDB\Document(repositoryClass="App\Repository\ContactMessageRepository")
 */
class ContactMessage
{
    /**
     * @MongoDB\Id(strategy="INCREMENT", type="string")
     */
    private ?string $id = null;

    /**
     * @MongoDB\Field(type="string", nullable=false)
     */
    private ?string $name = null;

    /**
     * @MongoDB\Field(type="string", nullable=false)
     */
    private ?string $title = null;

    /**
     * @MongoDB\Field(type="string", nullable=false)
     */
    private ?string $email = null;

    /**
     * @MongoDB\Field(type="string", nullable=false)
     */
    private ?string $content = null;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private bool $isRead = false;

    /**
     * @MongoDB\Field(type="date", nullable=false)
     */
    private ?\DateTime $sentAt = null;

    public function __construct()
    {
        $this->sentAt = new \DateTime();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(?\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRead(): bool
    {
        return $this->isRead;
    }

    /**
     * @param bool $isRead
     * @return ContactMessage
     */
    public function setIsRead(bool $isRead): ContactMessage
    {
        $this->isRead = $isRead;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return ContactMessage
     */
    public function setTitle(?string $title): ContactMessage
    {
        $this->title = $title;
        return $this;
    }



}
