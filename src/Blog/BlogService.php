<?php

namespace Metinet\Blog;

use Metinet\Blog\Forms\EditPost;
use Metinet\Blog\Forms\NewPost;
use Metinet\Students\Student;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class BlogService
{
    private $blogPostRepository;
    private $security;

    public function __construct(BlogPostRepository $blogPostRepository, Security $security)
    {
        $this->blogPostRepository = $blogPostRepository;
        $this->security = $security;
    }

    public function submit(NewPost $post): void
    {
        /** @var Student $currentLoggedInStudent */
        $currentLoggedInStudent = $this->security->getUser();

        $blogPost = BlogPost::submit(
            $post->id,
            $post->title,
            $post->body,
            $this->slugify($post->title),
            new \DateTimeImmutable('now', new \DateTimeZone('UTC')),
            $currentLoggedInStudent->getId()
        );

        $this->blogPostRepository->save($blogPost);
    }

    public function edit(EditPost $editPost): void
    {
        $blogPost = $this->blogPostRepository->get($editPost->id);

        if (!$this->security->isGranted('edit', $blogPost)) {

            throw new AccessDeniedException();
        }

        $blogPost->editTitle($editPost->title, $this->slugify($editPost->title));
        $blogPost->editBody($editPost->body);

        $this->blogPostRepository->save($blogPost);
    }

    private function slugify(string $title): string
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    }
}
