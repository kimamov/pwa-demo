<?php
declare(strict_types=1);

namespace Skygate\Sitepackage\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference as ExtbaseFileReference;

class Post extends AbstractEntity
{
    protected string $title = '';

    protected string $content = '';

    /**
     * @var ExtbaseFileReference|null
     */
    protected ?ExtbaseFileReference $image = null;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getImage(): ?ExtbaseFileReference
    {
        return $this->image;
    }

    public function setImage(?ExtbaseFileReference $image): void
    {
        $this->image = $image;
    }
}


