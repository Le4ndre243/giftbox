<?php

namespace gift\appli\application_core\application\exceptions;

class BadEmailOrPasswordException extends \Exception {
    public function __construct(string $message = "Email ou mot de passe incorrect") {
        parent::__construct($message, 401);
    }
}
