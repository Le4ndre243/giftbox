<?php

namespace gift\appli\application_core\application\exceptions;

class BoxAlreadyValidatedException extends \Exception {
    public function __construct(string $boxId = '') {
        $message = $boxId 
            ? "La box '$boxId' a déjà été validée." 
            : "La box n'a déjà été validée.";
        parent::__construct($message, 402); 
    }
}
