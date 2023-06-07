<?php

/**
 * Description of SolicitaAluguer
 *
 * @author Rui Malemba
 */
class SolicitaAluguer {
    
    //Atributos
    private $fkcliente;
    private $fkoutdoor;
    private $comprovativopagamento;
    private $datainicio;
    private $datafim;
    private $imagemoutdoor;
    private $estado;
    private $fkgestor;
    
    //Construtor
    public function __construct($fkcliente, $fkoutdoor, $comprovativopagamento, $datainicio, $datafim, $imagemoutdoor, $estado, $fkgestor) {
        $this->fkcliente = $fkcliente;
        $this->fkoutdoor = $fkoutdoor;
        $this->comprovativopagamento = $comprovativopagamento;
        $this->datainicio = $datainicio;
        $this->datafim = $datafim;
        $this->imagemoutdoor = $imagemoutdoor;
        $this->estado = $estado;
        $this->fkgestor = $fkgestor;
    }
    
    //Getters e setters
    public function getFkcliente() {
        return $this->fkcliente;
    }

    public function getFkoutdoor() {
        return $this->fkoutdoor;
    }

    public function getComprovativopagamento() {
        return $this->comprovativopagamento;
    }

    public function getDatainicio() {
        return $this->datainicio;
    }

    public function getDatafim() {
        return $this->datafim;
    }

    public function getImagemoutdoor() {
        return $this->imagemoutdoor;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFkgestor() {
        return $this->fkgestor;
    }

    public function setFkcliente($fkcliente): void {
        $this->fkcliente = $fkcliente;
    }

    public function setFkoutdoor($fkoutdoor): void {
        $this->fkoutdoor = $fkoutdoor;
    }

    public function setComprovativopagamento($comprovativopagamento): void {
        $this->comprovativopagamento = $comprovativopagamento;
    }

    public function setDatainicio($datainicio): void {
        $this->datainicio = $datainicio;
    }

    public function setDatafim($datafim): void {
        $this->datafim = $datafim;
    }

    public function setImagemoutdoor($imagemoutdoor): void {
        $this->imagemoutdoor = $imagemoutdoor;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function setFkgestor($fkgestor): void {
        $this->fkgestor = $fkgestor;
    }



}
