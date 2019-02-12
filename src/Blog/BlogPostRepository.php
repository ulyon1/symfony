<?php

namespace Metinet\Blog;

interface BlogPostRepository
{
    public function get(string $id): BlogPost;
    public function getLatestPosts(): array;
    public function save(BlogPost $post): void;
}
