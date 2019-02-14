<?php

namespace Metinet\App\Api;

class HttpError
{
    private $error;
    private $httpStatusCode;

    public function __construct(Error $error, int $httpStatusCode)
    {
        $this->error = $error;
        $this->httpStatusCode = $httpStatusCode;
    }

    public function getError(): Error
    {
        return $this->error;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}
