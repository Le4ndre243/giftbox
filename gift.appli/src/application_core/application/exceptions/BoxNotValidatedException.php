<?php

namespace gift\appli\application_core\application\exceptions;

class BoxNotValidatedException extends \Exception {
     public function __construct(string $boxId = '') {
        $message = $boxId 
            ? "La box '$boxId' n'est pas encore validée." 
            : "La box n'est pas encore validée.";
        parent::__construct($message, 403);
    }
}
