<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\domain\entities\Categorie;
use gift\appli\application_core\domain\entities\Prestation;
use gift\appli\application_core\domain\entities\CoffretType;

class CatalogueService implements CatalogueInterface {
    public function getCategories(): array {
        return Categorie::all()->toArray();
    }

    public function getCategorieById(int $id): array {
        return Categorie::find($id)->toArray();
    }

    public function getPrestationById(string $id): array {
        return Prestation::find($id)->toArray();
    }

    public function getPrestationsbyCategorie(int $categ_id):array {
        return Categorie::find($categ_id)->prestations()->get()->toArray();
    }

    public function getThemesCoffrets(): array {
        return CoffretType::all()->toArray();
    }

    public function getCoffretById(int $id): array {
        return CoffretType::find($id)->toArray();
    }
}