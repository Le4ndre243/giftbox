<?php

namespace gift\appli\application_core\application\useCases;
use gift\appli\application_core\application\useCases\BoxInterface;
use gift\appli\application_core\domain\entities\Box;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use gift\appli\application_core\application\exceptions\BoxNotPaidException;

class BoxService implements BoxInterface {

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

    public function findBoxById(string $box_id): BoxInterface{
        try {
            return Box::findOrFail($box_id);
        } catch (\Exception $e) {
            throw new EntityNotFoundException("Box", $box_id);
        }
    }
}