<?php

/**
 * Description of Gestor
 *
 * @author Rui Malemba
 */
require_once 'User.php';
class Gestor extends User{
    //Atributos
    private $nomeCompleto;
    private $fkadmin;
    
    //Construtor
    public function __construct($username, $password_, $telemovel, $email, $fkcomuna, $morada, $foto, $nomeCompleto, $fkadmin) {
        parent::__construct($username, $password_, $telemovel, $email, $fkcomuna, $morada, $foto);
        $this->nomeCompleto = $nomeCompleto;
        $this->fkadmin = $fkadmin;
    }

    //Getters e setters
    public function getNomeCompleto() {
        return $this->nomeCompleto;
    }

    public function getFkadmin() {
        return $this->fkadmin;
    }

    public function setNomeCompleto($nomeCompleto): void {
        $this->nomeCompleto = $nomeCompleto;
    }

    public function setFkadmin($fkadmin): void {
        $this->fkadmin = $fkadmin;
    }


}
