<?php
namespace gift\appli\application_core\application\useCases;

interface BoxInterface {

    public function generateToken(string $box_id): string;

    public function getBoxByToken(string $token): array;

    public function validateBox(string $box_id): void;
}