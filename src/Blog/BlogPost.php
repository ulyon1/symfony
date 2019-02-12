<?php

namespace Metinet\Blog;

class BlogPost
{
    private $id;
    private $title;
    private $body;
    private $slug;
    private $publicationDate;

    public static function submit(string $id, string $title, string $body, string $slug,
        \DateTimeImmutable $publicationDate): self
    {
        return new static($id, $title, $body, $slug, $publicationDate);
    }

    private function __construct(string $id, string $title, string $body, string $slug,
        \DateTimeImmutable $publicationDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->slug = $slug;
        $this->publicationDate = $publicationDate;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPublicationDate(): \DateTimeImmutable
    {
        return $this->publicationDate;
    }
}
