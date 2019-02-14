<?php

namespace Metinet\App;

interface SlugGenerator
{
    public function slugify(string $text): string;
}
