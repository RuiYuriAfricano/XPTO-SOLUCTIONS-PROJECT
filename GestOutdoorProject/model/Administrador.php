<?php

/**
 * Description of Administrador
 *
 * @author Rui Malemba
 */
require_once 'User.php';
class Administrador extends User{
    //Atributos
    private $nomeCompleto;
    
    //construtor
    public function __construct($username, $password_, $telemovel, $email, $fkcomuna, $morada, $fotografia, $nomeCompleto) {
        parent:: __construct($username, $password_, $telemovel, $email, $fkcomuna, $morada, $fotografia);
        $this->nomeCompleto = $nomeCompleto;
    }

        
    //getters e setters
    public function getNomeCompleto() {
        return $this->nomeCompleto;
    }


    public function setNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }


}
