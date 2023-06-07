<?php

/**
 * Description of Comuna
 *
 * @author Rui Malemba
 */
class Comuna {

    //Atributos
    private $codcomuna;
    private $nome;
    private $fkMunicipio;

    //construtor
    public function __construct($codcomuna, $nome, $fkMunicipio) {
        $this->codcomuna = $codcomuna;
        $this->nome = $nome;
        $this->fkMunicipio = $fkMunicipio;
    }

        //getters e setters
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function getFkMunicipio() {
        return $this->fkMunicipio;
    }

    public function setFkMunicipio($fkMunicipio): void {
        $this->fkMunicipio = $fkMunicipio;
    }
    
    public function getCodcomuna() {
        return $this->codcomuna;
    }

    public function setCodcomuna($codcomuna): void {
        $this->codcomuna = $codcomuna;
    }


    
}
