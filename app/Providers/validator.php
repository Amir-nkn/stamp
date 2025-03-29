<?php
namespace App\Providers;
use App\Models;

// Classe de validation pour les formulaires
class Validator{

    // Tableau contenant les messages d'erreur
    private $errors = array();

    // Clé, valeur et nom du champ en cours de validation
    private $key;
    private $value;
    private $name;

    // Définit le champ à valider
    public function field($key, $value, $name = null){
        $this->key = $key;
        $this->value = $value;

        // Si aucun nom personnalisé n'est donné, on utilise le nom du champ avec majuscule
        if($name == null){
            $this->name = ucfirst($key);
        }else{
            $this->name = ucfirst($name);
        }
        return $this;
    }

    // Vérifie que la valeur n'est pas vide
    public function required(){
        if(empty($this->value)){
            $this->errors[$this->key]="$this->name is required!";
        }
        return $this;
    }

    // Vérifie que la longueur ne dépasse pas la limite
    public function max($length){
        if(strlen($this->value) > $length ){
            $this->errors[$this->key]="$this->name must be less than $length characters!";
        }
        return $this;
    }

    // Vérifie que la longueur est suffisante
    public function min($length){
        if(strlen($this->value) < $length ){
            $this->errors[$this->key]="$this->name must be more than $length characters!";
        }
        return $this;
    }

    // Vérifie que la valeur est supérieure ou égale à une valeur minimale
    public function minValue($minValue) {
        if ($this->value < $minValue) {
            $this->errors[$this->key] = "⚠️ {$this->name} must be at least $minValue.";
        }
        return $this;
    }

    // Vérifie que la valeur est numérique
    public function number(){
        if(!empty($this->value) && !is_numeric($this->value)){
            $this->errors[$this->key]="$this->name must be a number!";
        }
        return $this;	    
    }

    // Vérifie que le champ contient un email valide
    public function email(){
        if(!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)){  
            $this->errors[$this->key]="$this->name invalid!";
        }
        return $this;	    
    }

    // Vérifie que la valeur est un nombre positif
    public function positiveNumber() {
        if (!is_numeric($this->value) || $this->value < 0) {
            $this->errors[$this->key] = "⚠️ {$this->name} must be a positive number.";
        }
        return $this;
    }

    // Vérifie que la valeur est unique dans la base (via modèle donné)
    public function unique($model){
        $model = 'App\\Models\\'.$model;
        $model = new $model;
        $unique = $model->unique($this->key, $this->value);
        if($unique){
            $this->errors[$this->key]="$this->name must be unique!";
        }
        return $this;
    }

    // Retourne vrai si aucune erreur de validation
    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

    // Retourne les erreurs de validation
    public function getErrors(){
        if(!$this->isSuccess()) return $this->errors;
    }

}
