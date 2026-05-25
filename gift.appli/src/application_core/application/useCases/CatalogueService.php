<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\domain\entities\Categorie;
use gift\appli\application_core\domain\entities\Prestation;
use gift\appli\application_core\domain\entities\CoffretType;
use gift\appli\application_core\domain\entities\Theme;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;

class CatalogueService implements CatalogueInterface {

    public function getCategories(): array {
        return Categorie::all()->toArray();
    }

    public function getCategorieById(int $id): array {
        try {
            return Categorie::findOrFail($id)->toArray();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new EntityNotFoundException("Catégorie", $id);
        }
    }

    public function getPrestations(): array {
        return Prestation::all()->toArray();
    }

    public function getPrestationById(string $id): array {
        try {
            return Prestation::with('categorie')->findOrFail($id)->toArray();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new EntityNotFoundException("Prestation", $id);
        }
    }

    public function getPrestationsbyCategorie(int $categ_id): array {
        try {
            return Categorie::findOrFail($categ_id)->prestations()->get()->toArray();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new EntityNotFoundException("Catégorie", $categ_id);
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
            throw new EntityNotFoundException("Coffret", $id);
        }
    }

    public function getThemes(): array {
        return Theme::all()->toArray();
    }

    public function getCoffretsByTheme(int $id): array {
        try {
            return CoffretType::with('theme')->where('theme_id', $id)->get()->toArray();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new EntityNotFoundException("Theme", $id);
        }
    }
}