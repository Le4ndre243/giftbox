<?php

namespace gift\appli\application_core\application\useCases;
use gift\appli\application_core\application\useCases\BoxInterface;

class BoxService implements BoxInterface {

    public function generateToken(string $box_id): string{
        try {
            $box = BoxService::findBoxById($box_id);
            if($box->statut == 3 || $box->statut == 4) {
                
                if($box->token != null) {
                    return $box->token; 
                }
                $token = bin2hex(random_bytes(16)); e
                $box->token = $token;
                $box->save();
                return $token;
            }
        } catch (\Exception $e) {
            throw new EntityNotFoundException("Box introuvable pour l'ID fourni");
        }
    }

    public function getBoxByToken(string $token): array{
        try {
            return Box::where('token', $token)->firstOrFail()->toArray();   
        } catch (\Exception $e) {
            throw new EntityNotFoundException("Box introuvable pour le token fourni");
        }
    }

    public function findBoxById(string $box_id): BoxInterface{
        try {
            return Box::findOrFail($box_id);
        } catch (\Exception $e) {
            throw new EntityNotFoundException("Box introuvable pour l'ID fourni");
        }
    }
}