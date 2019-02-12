<?php

namespace Metinet\Blog;

interface SlugGenerator
{
    public function slugify(string $text): string;
}
