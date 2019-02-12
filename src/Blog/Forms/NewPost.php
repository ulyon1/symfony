<?php

namespace Metinet\Blog\Forms;

use Ramsey\Uuid\Uuid;

class NewPost
{
    public $id;
    public $title;
    public $body;

    public function __construct()
    {
        $this->id = (string) Uuid::uuid4();
    }
}
