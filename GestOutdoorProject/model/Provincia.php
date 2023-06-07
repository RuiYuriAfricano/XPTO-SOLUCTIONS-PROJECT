<?php
/**
 * Description of Provincia
 *
 * @author Rui Malemba
 */
class Provincia {
    //Atributos
    private $codprovincia;
    private $nome;
    
    //construtor
    public function __construct($nome, $codprovincia) {
        $this->nome = $nome;
        $this->codprovincia = $codprovincia;
    }
    
    //getters e setters
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }
    
    public function getCodprovincia() {
        return $this->codprovincia;
    }

    public function setCodprovincia($codprovincia): void {
        $this->codprovincia = $codprovincia;
    }


    
}
