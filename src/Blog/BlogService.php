<?php

namespace Metinet\Blog;

use Metinet\Blog\Forms\NewPost;

class BlogService
{
    private $blogPostRepository;

    public function __construct(BlogPostRepository $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    public function submit(NewPost $post): void
    {
        $blogPost = BlogPost::submit(
            $post->id,
            $post->title,
            $post->body,
            $this->slugify($post->title),
            new \DateTimeImmutable('now', new \DateTimeZone('UTC'))
        );

        $this->blogPostRepository->save($blogPost);
    }

    private function slugify(string $title): string
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    }
}
