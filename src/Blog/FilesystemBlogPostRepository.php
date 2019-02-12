<?php

namespace Metinet\Blog;

class FilesystemBlogPostRepository implements BlogPostRepository
{
    private $path;
    /** @var BlogPost[] */
    private $posts = [];

    public function __construct(string $dataPath)
    {
        $this->path = sprintf('%s/blog_posts.repository', $dataPath);
        $this->load();
    }

    public function save(BlogPost $post): void
    {
        $this->posts[$post->getId()] = $post;

        $this->commit();
    }

    public function clear(): void
    {
        $this->posts = [];
        $this->commit();
    }

    public function getLatestPosts(): array
    {
        return $this->posts;
    }

    public function get(string $id): BlogPost
    {
        if (!isset($this->posts[$id])) {

            throw new BlogPostNotFound($id);
        }

        return $this->posts[$id];
    }

    private function load(): void
    {
        if (!file_exists($this->path)) {
            file_put_contents($this->path, serialize($this->posts));
        }

        $this->posts = unserialize(file_get_contents($this->path), [BlogPost::class]);
    }

    private function commit(): void
    {
        uasort($this->posts, function (BlogPost $postA, BlogPost $postB){
            return $postA->getPublicationDate() < $postB->getPublicationDate();
        });

        file_put_contents($this->path, serialize($this->posts));
    }
}
