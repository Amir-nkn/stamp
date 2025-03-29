<?php
namespace App\Providers;
use App\Providers\View;

class Auth {

    // Vérifie si la session est valide en comparant l'empreinte (fingerPrint)
    static public function session(){
        if(isset($_SESSION['fingerPrint']) && $_SESSION['fingerPrint'] == md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'])){
            return TRUE; // Session valide
        }else{
            return view::redirect('login'); // Redirection vers la page de connexion
            exit();
        }
    }

    // Vérifie si l'utilisateur a le privilège requis
    static public function privilege($id){
        if($_SESSION['privilege_id'] == $id){
            return TRUE; // L'utilisateur a le privilège nécessaire
        }else{
            return view::redirect('login'); // Sinon, redirection vers la connexion
            exit();
        }
    }

}
