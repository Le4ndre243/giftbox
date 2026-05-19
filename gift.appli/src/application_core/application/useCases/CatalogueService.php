<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\domain\entities\Categorie;
use gift\appli\application_core\domain\entities\Prestation;
use gift\appli\application_core\domain\entities\CoffretType;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;

class CatalogueService implements CatalogueInterface {

    public function getCategories(): array {
        return Categorie::all()->toArray();
    }

    public function getCategorieById(int $id): array {
        try {
            return Categorie::findOrFail($id)->toArray();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new EntityNotFoundException("Catégorie $id introuvable");
        }
    }

    public function getPrestations(): array {
        return Prestation::all()->toArray();
    }

    public function getPrestationById(string $id): array {
        try {
            return Prestation::with('categorie')->findOrFail($id)->toArray();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new EntityNotFoundException("Prestation $id introuvable");
        }
    }

    public function getPrestationsbyCategorie(int $categ_id): array {
        try {
            return Categorie::findOrFail($categ_id)->prestations()->get()->toArray();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new EntityNotFoundException("Catégorie $categ_id introuvable");
        }
    }

    public function getThemesCoffrets(): array {
        return CoffretType::all()->toArray();
    }

    public function getCoffretById(int $id): array {
        try {
            $coffret = CoffretType::with('prestations')->findOrFail($id);
            return [
                'coffretType' => $coffret->toArray(),
                'prestations' => $coffret->prestations->toArray(),
            ];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new EntityNotFoundException("Coffret $id introuvable");
        }
    }
}