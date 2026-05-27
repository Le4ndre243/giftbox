<?php
namespace gift\appli\application_core\application\providers;
class CsrfTokenProvider{

public static function generate(){
     $token = bin2hex(random_bytes(32));
     $_SESSION['csrf_token'] = $token;
     return $token; 
}

public static function check(String $token){
    if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        unset($_SESSION['csrf_token']);
        throw new \Exception('Token CSRF invalide');
    }
}

}

?>