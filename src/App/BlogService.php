<?php

namespace Metinet\App;

use Metinet\App\Forms\EditPost;
use Metinet\App\Forms\NewPost;
use Metinet\Domain\Blog\BlogPost;
use Metinet\Domain\Blog\BlogPostRepository;
use Metinet\Domain\Students\Student;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class BlogService
{
    private $blogPostRepository;
    private $security;
    private $slugGenerator;

    public function __construct(BlogPostRepository $blogPostRepository, SlugGenerator $slugGenerator, Security $security)
    {
        $this->blogPostRepository = $blogPostRepository;
        $this->security = $security;
        $this->slugGenerator = $slugGenerator;
    }

    public function submit(NewPost $post): void
    {
        /** @var Student $currentLoggedInStudent */
        $currentLoggedInStudent = $this->security->getUser();

        $blogPost = BlogPost::submit(
            $post->id,
            $post->title,
            $post->body,
            $this->slugGenerator->slugify($post->title),
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

        $blogPost->editTitle($editPost->title, $this->slugGenerator->slugify($editPost->title));
        $blogPost->editBody($editPost->body);

        $this->blogPostRepository->save($blogPost);
    }
}
