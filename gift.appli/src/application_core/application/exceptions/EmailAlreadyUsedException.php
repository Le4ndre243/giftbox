<?php

namespace gift\appli\application_core\application\exceptions;

class EmailAlreadyUsedException extends \Exception {
    public function __construct(string $message = "Email déjà utilisé") {
        parent::__construct($message, 409);
    }
}
