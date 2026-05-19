<?php

namespace gift\appli\application_core\application\exceptions;

class BoxNotPaidException extends \Exception {
    public function __construct(string $boxId = '') {
        $message = $boxId 
            ? "La box '$boxId' n'a pas été payée." 
            : "La box n'a pas été payée.";
        parent::__construct($message, 402); 
    }
}
