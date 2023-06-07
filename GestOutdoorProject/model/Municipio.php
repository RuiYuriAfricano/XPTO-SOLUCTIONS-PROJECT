<?php
/**
 * Description of Municipio
 *
 * @author Rui Malemba
 */
class Municipio {
    //Atributos
    private $codmunicipio;
    private $nome;
    private $fkProvincia;
    
    //construtor
    public function __construct($codmunicipio, $nome, $fkProvincia) {
        $this->codmunicipio = $codmunicipio;
        $this->nome = $nome;
        $this->fkProvincia = $fkProvincia;
    }

    //getters e setters
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }
    
    public function getFkProvincia() {
        return $this->fkProvincia;
    }

    public function setFkProvincia($fkProvincia): void {
        $this->fkProvincia = $fkProvincia;
    }
    
    public function getCodmunicipio() {
        return $this->codmunicipio;
    }

    public function setCodmunicipio($codmunicipio): void {
        $this->codmunicipio = $codmunicipio;
    }





    
}
