<?php

namespace gift\appli\application_core\application\useCases;
use gift\appli\application_core\domain\entities\User;
interface AuthnProviderInterface {
    public function getSignedInUser(): ?User;
    public function signin(string $email, string $password): bool;
    public function register(string $email, string $password): User;
    public function signout(): void;
}