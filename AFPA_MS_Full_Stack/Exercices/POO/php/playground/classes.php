<?php

namespace test;

echo __NAMESPACE__;

// ---------------------------------------------------------------------------------
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// ---------------------------------------------------------------------------------


// class Autoload{

  
//     static function register(){
//         spl_autoload_register(array(__CLASS__, 'autoload'));
//     }

//     static function autoload($class){

        // $class = str_replace('test\\', '' , $class);

        // require 'class/' . $class . '.php';
//     }

// }

// ---------------------------------------------------------------------------------
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// ---------------------------------------------------------------------------------


class Form {
    private $data;
    public $surround = 'p';

    public function __construct($data = array()) {
        $this->data = $data;
    }

    private function surround($html) { 
        return "<{$this->surround}> {$html} </{$this->surround}> ";
    }


    private function getValue($index){

        return isset($this->data[$index]) ? $this->data[ $index ] : null;
    }

    public function input($name) {
        return $this->surround('<input type="text" name="' . $name . '" value="' . $this->getValue($name) . '" />');
    }

    public function submit() {
        return $this->surround('<button type="submit">Envoyer</button>');
    }
}

// --

class Text{


    public static function withZero($chiffre) {
        if ($chiffre < 10) {
            return '0' . $chiffre;

    } else {
        return $chiffre;
    }
    }
}

;


// ---------------------------------------------------------------------------------
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// ---------------------------------------------------------------------------------

class Personnage{

    public $vie = 80;
    public $atk = 20;
    public $nom;

    public function __construct($nom){

    $this->nom = $nom;  
    return $nom;

    }

public function regenerer($add_hp = null) {


    if (!is_null($add_hp)) { 
    return $this->vie += $add_hp;
    } else {

     $this->vie = 100;

    }

}

public function mort() {

    if ($this->vie <= 0) {
        return true;
    } else {
        return false;
    }

}

}

// ---------------------------------------------------------------------------------
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// ---------------------------------------------------------------------------------