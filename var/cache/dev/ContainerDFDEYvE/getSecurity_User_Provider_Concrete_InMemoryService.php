<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.user.provider.concrete.in_memory' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/security-core/User/UserProviderInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/security-core/User/InMemoryUserProvider.php';

return $this->privates['security.user.provider.concrete.in_memory'] = new \Symfony\Component\Security\Core\User\InMemoryUserProvider(['admin' => ['password' => 'kimorapapy', 'roles' => [0 => 'ROLE_ADMIN']]]);
