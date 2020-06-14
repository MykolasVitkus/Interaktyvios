<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class SocialLink
 * @MongoDB\Document()
 */
class SocialLink
{
    /**
     * @MongoDB\Id(strategy="INCREMENT", type="string")
     */
    private ?string $id = null;

    /**
     * @MongoDB\Field(type="string", nullable=false)
     */
    private ?string $icon = null;

    /**
     * @MongoDB\Field(type="string", nullable=false)
     */
    private ?string $url = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return SocialLink
     */
    public function setId(?string $id): SocialLink
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     * @return SocialLink
     */
    public function setIcon(?string $icon): SocialLink
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return SocialLink
     */
    public function setUrl(?string $url): SocialLink
    {
        $this->url = $url;
        return $this;
    }


}
