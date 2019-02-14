<?php

namespace Metinet\App\Security;

use Metinet\Domain\Students\ApiKeyNotFound;
use Symfony\Component\Security\Core\User\UserProviderInterface;

interface ApiKeyUserProvider extends UserProviderInterface
{
    /**
     * @throws ApiKeyNotFound
     */
    public function getUsernameForApiKey(string $apiKey): string;
}
