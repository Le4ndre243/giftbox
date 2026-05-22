<?php

namespace gift\appli\application_core\application\exceptions;

class BoxNotEnoughPrestationsException extends \Exception {
    public function __construct(string $boxId = '') {
        $message = $boxId 
            ? "La box '$boxId' n'a pas assez de prestations. Il faut au moins 2 prestations pour valider la box." 
            : "La box n'a pas assez de prestations. Il faut au moins 2 prestations pour valider la box.";
        parent::__construct($message, 402); 
    }
}
