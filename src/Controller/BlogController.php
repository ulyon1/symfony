<?php

namespace Metinet\Controller;

use Metinet\Blog\BlogPostRepository;
use Metinet\Blog\BlogService;
use Metinet\Blog\Forms\NewPostType;
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

    public function viewPost(string $id, BlogPostRepository $blogPostRepository): Response
    {
        return $this->render('blog/viewPost.html.twig', ['post' => $blogPostRepository->get($id)]);
    }
}
