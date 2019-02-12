<?php

namespace Metinet\Blog\Forms;

class EditPost
{
    public $id;
    public $title;
    public $body;

    public function __construct(string $id, string $title, string $body)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
    }
}
