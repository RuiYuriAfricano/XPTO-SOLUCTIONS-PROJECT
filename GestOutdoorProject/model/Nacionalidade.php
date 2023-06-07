<?php
/**
 * Description of Nacionalidade
 *
 * @author Rui Malemba
 */
class Nacionalidade {
    //Atributos
    private $codnacionalidade;
    private $nacionalidade;
    
    //construtor
    public function __construct($nacionalidade, $codnacionalidade) {
        $this->nacionalidade = $nacionalidade;
        $this->codnacionalidade = $codnacionalidade;
    }
    
    //getters e setters
    public function getNacionalidade() {
        return $this->nacionalidade;
    }

    public function setNacionalidade($nacionalidade): void {
        $this->nacionalidade = $nacionalidade;
    }

    public function getCodnacionalidade() {
        return $this->codnacionalidade;
    }

    public function setCodnacionalidade($codnacionalidade): void {
        $this->codnacionalidade = $codnacionalidade;
    }


    
}
