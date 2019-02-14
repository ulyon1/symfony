<?php

namespace Metinet\App\Controller\Web;

use Metinet\App\Forms\EditPost;
use Metinet\App\Forms\EditPostType;
use Metinet\App\Forms\NewPostType;
use Metinet\App\BlogService;
use Metinet\Domain\Blog\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function latestPosts(BlogPostRepository $blogPostRepository): Response
    {
        return $this->render('blog/latestPosts.html.twig', ['posts' => $blogPostRepository->getLatestPosts()]);
    }

    public function newPost(Request $request, BlogService $blogService, BlogPostRepository $blogPostRepository): Response
    {
        $form = $this->createForm(NewPostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPost = $form->getData();
            $blogService->submit($newPost);

            $blogPost = $blogPostRepository->get($newPost->id);

            return $this->redirectToRoute('blog_view_post', ['id' => $blogPost->getId(), 'slug' => $blogPost->getSlug()]);
        }

        return $this->render('blog/newPost.html.twig', ['newPostForm' => $form->createView()]);
    }

    public function editPost(string $postId, Request $request, BlogPostRepository $blogPostRepository, BlogService $blogService): Response
    {
        $blogPost = $blogPostRepository->get($postId);

        $form = $this->createForm(
            EditPostType::class,
            new EditPost($blogPost->getId(), $blogPost->getTitle(), $blogPost->getBody()),
            ['disabled' => !$this->isGranted('edit', $blogPost)]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $editPost = $form->getData();
            $blogService->edit($editPost);

            return $this->redirectToRoute('blog_view_post', ['id' => $blogPost->getId(), 'slug' => $blogPost->getSlug()]);
        }

        return $this->render('blog/editPost.html.twig', ['editPostForm' => $form->createView(), 'blogPost' => $blogPost]);
    }

    public function viewPost(string $id, BlogPostRepository $blogPostRepository): Response
    {
        return $this->render('blog/viewPost.html.twig', ['post' => $blogPostRepository->get($id)]);
    }
}
