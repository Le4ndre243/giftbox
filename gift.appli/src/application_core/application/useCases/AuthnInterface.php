<?php
namespace gift\appli\application_core\application\useCases;

interface AuthnInterface {

    public function sInscrire(string $email, string $password): User;
    public function seConnecter(string $email, string $password): ?User;
}