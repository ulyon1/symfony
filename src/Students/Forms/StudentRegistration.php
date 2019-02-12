<?php

namespace Metinet\Students\Forms;

use Ramsey\Uuid\Uuid;

class StudentRegistration
{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $yearOfEntry;

    public function __construct()
    {
        $this->id = (string) Uuid::uuid4();
    }
}
