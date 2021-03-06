<?php

namespace Metinet\App\Forms;

use Ramsey\Uuid\Uuid;

class StudentRegistration
{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $yearOfEntry;

    public function __construct()
    {
        $this->id = (string) Uuid::uuid4();
    }
}
