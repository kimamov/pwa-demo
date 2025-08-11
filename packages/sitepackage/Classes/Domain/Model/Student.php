<?php
declare(strict_types=1);

namespace Skygate\Sitepackage\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference as ExtbaseFileReference;

class Student extends AbstractEntity
{
    protected string $name = '';

    protected string $lastname = '';

    /**
     * @var ExtbaseFileReference|null
     */
    protected ?ExtbaseFileReference $image = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
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


