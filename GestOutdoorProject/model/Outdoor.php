<?php
/**
 * Description of Outdoor
 *
 * @author Rui Malemba
 */
class Outdoor {
    //Atributes
    private $tipo;
    private $preco;
    private $fkcomuna;
    private $fkgestor;
    
    //construtor
    public function __construct($tipo, $preco, $fkcomuna, $fkgestor) {
        $this->tipo = $tipo;
        $this->preco = $preco;
        $this->fkcomuna = $fkcomuna;
        $this->fkgestor = $fkgestor;
    }

    
    //getters e setteres
    public function getTipo() {
        return $this->tipo;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getFkcomuna() {
        return $this->fkcomuna;
    }

    public function getFkgestor() {
        return $this->fkgestor;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    public function setPreco($preco): void {
        $this->preco = $preco;
    }

    public function setFkcomuna($fkcomuna): void {
        $this->fkcomuna = $fkcomuna;
    }

    public function setFkgestor($fkgestor): void {
        $this->fkgestor = $fkgestor;
    }


}
