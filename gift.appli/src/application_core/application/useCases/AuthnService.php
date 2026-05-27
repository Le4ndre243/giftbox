<?php
namespace gift\appli\application_core\application\useCases;
use gift\appli\application_core\domain\entities\User;
use gift\appli\application_core\application\exceptions\EmailAlreadyUsedException;
use gift\appli\application_core\application\exceptions\BadEmailOrPasswordException;

class AuthnService {

    public function sInscrire(string $email, string $password): User{
        $userEmail = User::where('email', $email)->first();
        if(!empty($userEmail)){
            throw new EmailAlreadyUsedException("Email déjà utilisé");
        }
        $model = new User();
        $model->email    = $email;
        $model->password = password_hash($password, PASSWORD_DEFAULT);
        $model->role     = 1;
        $model->save();
  
        return $model;
    
    }
    public function seConnecter(string $email, string $password): ?User{
        $userEmail = User::where("email", $email)->first();

        if(empty($userEmail)){
            throw new BadEmailOrPasswordException();
        }

        if(password_verify($password, $userEmail->password)){
            return $userEmail;
        }

        throw new BadEmailOrPasswordException();

        return null;    
    }
}