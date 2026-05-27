<?php
namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\domain\entities\Box;

interface BoxInterface {

    public function createBox(string $libelle, string $description, bool $kdo, string $message_kdo): Box;

    public function addPrestation(string $box_id, string $presta_id): void;

    public function generateToken(string $box_id): string;

    public function getBoxByToken(string $token): array;

    public function validateBox(string $box_id): void;
}