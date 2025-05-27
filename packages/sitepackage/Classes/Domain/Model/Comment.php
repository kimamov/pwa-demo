<?php

declare(strict_types=1);

namespace Skygate\Sitepackage\Domain\Model;

use JsonSerializable;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Comment extends AbstractEntity implements JsonSerializable
{
    public function __construct(
        protected string $text = '',
        protected string $author = '',
    ) {
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'text' => $this->text,
            'author' => $this->author,
        ];
    }
}
