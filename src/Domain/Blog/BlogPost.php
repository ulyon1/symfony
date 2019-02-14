<?php

namespace Metinet\Domain\Blog;

class BlogPost
{
    private $id;
    private $title;
    private $body;
    private $slug;
    private $publicationDate;
    private $studentId;

    public static function submit(string $id, string $title, string $body, string $slug,
        \DateTimeImmutable $publicationDate, string $studentId): self
    {
        return new static($id, $title, $body, $slug, $publicationDate, $studentId);
    }

    private function __construct(string $id, string $title, string $body, string $slug,
        \DateTimeImmutable $publicationDate, string $studentId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->slug = $slug;
        $this->publicationDate = $publicationDate;
        $this->studentId = $studentId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function editTitle(string $newTitle, string $newSlug): void
    {
        $this->title = $newTitle;
        $this->slug = $newSlug;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function editBody(string $newBody): void
    {
        $this->body = $newBody;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPublicationDate(): \DateTimeImmutable
    {
        return $this->publicationDate;
    }

    public function getStudentId(): string
    {
        return $this->studentId;
    }
}
