<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Section
 * @MongoDB\Document()
 */
class Section
{
    /**
     * @MongoDB\Id(strategy="INCREMENT", type="string")
     */
    private ?string $id = null;

    /**
     * @MongoDB\Field(type="string", nullable=false)
     */
    private ?string $title = null;

    /**
     * @MongoDB\Field(type="string", nullable=false)
     */
    private ?string $content = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return Section
     */
    public function setId(?string $id): Section
    {
        $this->id = $id;
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
     * @return Section
     */
    public function setTitle(?string $title): Section
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Section
     */
    public function setContent(?string $content): Section
    {
        $this->content = $content;
        return $this;
    }

}
