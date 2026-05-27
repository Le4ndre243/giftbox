<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\useCases\AuthnService;
use gift\appli\application_core\domain\entities\User;

class AuthnProviderService implements AuthnProviderInterface {
    private const SESSION_KEY = 'auth_user';

    public function __construct(private AuthnService $authnService) {}

    public function getSignedInUser(): ?User{
        return $_SESSION[self::SESSION_KEY] ?? null;
    }
    public function signin(string $email, string $password): bool{
        try {
            $user = $this->authnService->seConnecter($email, $password);
            $_SESSION[self::SESSION_KEY] = $user;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function register(string $email, string $password): User{
        $user = $this->authnService->sInscrire($email, $password);
        $_SESSION[self::SESSION_KEY] = $user; 
        return $user;
    }
    public function signout(): void{
        unset($_SESSION[self::SESSION_KEY]);
    }
}