<?php

namespace gift\appli\application_core\application\useCases;
use gift\appli\application_core\application\useCases\BoxInterface;
use gift\appli\application_core\domain\entities\Box;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use gift\appli\application_core\application\exceptions\BoxNotPaidException;
use gift\appli\application_core\application\exceptions\BoxNotEnoughPrestationsException;
use gift\appli\application_core\application\exceptions\BoxAlreadyValidatedException;

class BoxService implements BoxInterface {

    public function createBox(string $libelle, string $description, bool $kdo, string $message_kdo): Box {
        $box = new Box();
        $box->id = bin2hex(random_bytes(16));
        $box->libelle = $libelle;
        $box->description = $description;
        $box->kdo = $kdo ? 1 : 0;
        $box->message_kdo = $message_kdo;
        $box->statut = 1;
        $box->montant = 0;
        $box->token = '';
        $box->save();
        return $box;
    }

    public function addPrestation(string $box_id, string $presta_id): void {
        $box = $this->findBoxById($box_id);

        if ($box->statut !== 1) {
            throw new BoxAlreadyValidatedException($box_id);
        }

        $existing = $box->prestations()->where('presta_id', $presta_id)->first();
        if ($existing) {
            $box->prestations()->updateExistingPivot($presta_id, ['quantite' => $existing->pivot->quantite + 1]);
        } else {
            $box->prestations()->attach($presta_id, ['quantite' => 1]);
        }
    }

    public function generateToken(string $box_id): string{
        try {
            $box = BoxService::findBoxById($box_id);
            if($box->statut == 3 || $box->statut == 4) {
                
                if($box->token != null) {
                    return $box->token; 
                }
                $token = bin2hex(random_bytes(16)); 
                $box->token = $token;
                Box::where('id', $box_id)->update(['token' => $token]);
                return $token;
            }
            throw new BoxNotPaidException($box_id);
        } catch (\Exception $e) {
            throw new EntityNotFoundException("Box", $box_id);
        }
    }

    public function getBoxByToken(string $token): array{
        try {
            return Box::with('prestations')->where('token', $token)->firstOrFail()->toArray();   
        } catch (\Exception $e) {
            throw new EntityNotFoundException("Box", $token);
        }
    }

    public function findBoxById(string $box_id): Box{
        try {
            return Box::findOrFail($box_id);
        } catch (\Exception $e) {
            throw new EntityNotFoundException("Box", $box_id);
        }
    }

    public function validateBox(string $box_id): void {
        $box = $this->findBoxById($box_id);

        if ($box->statut !== 1) {
            throw new BoxAlreadyValidatedException($box_id);
        }

        try {
            $nbPrestations = Box::with('prestations')
                ->where('id', $box_id)
                ->firstOrFail()
                ->prestations
                ->count();
        } catch (\Exception $e) {
            throw new EntityNotFoundException("Box", $box_id); 
        }

        if ($nbPrestations < 2) {
            throw new BoxNotEnoughPrestationsException($box_id);
        }

        try {
            Box::where('id', $box_id)->update(['statut' => 2]);
        } catch (\Exception $e) {
            throw new \RuntimeException("Erreur lors de la validation", 0, $e); 
        }
    }
}