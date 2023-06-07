<?php

/**
 * Description of Cliente
 *
 * @author Rui Malemba
 */
require_once 'User.php';
class Cliente extends User{
    
    //Atributos
    private  $nomeCompleto;
    private $tipoDeCliente;
    private $atividadeDaEmpresa;
    private $fkNacionalidade;
    private $estado;
    private $fkAdmin;
    
    //Construtor
    public function __construct($username, $password_, $telemovel, $email, $fkcomuna, $morada, $fotografia, $nomeCompleto, $tipoDeCliente, $atividadeDaEmpresa, $fkNacionalidade, $estado, $fkAdmin) {
        parent:: __construct($username, $password_, $telemovel, $email, $fkcomuna, $morada, $fotografia);
        $this->nomeCompleto = $nomeCompleto;
        $this->tipoDeCliente = $tipoDeCliente;
        $this->atividadeDaEmpresa = $atividadeDaEmpresa;
        $this->fkNacionalidade = $fkNacionalidade;
        $this->estado = $estado;
        $this->fkAdmin = $fkAdmin;
    }

        
    //getters e setters
    public function getNomeCompleto() {
        return $this->nomeCompleto;
    }

    public function getTipoDeCliente() {
        return $this->tipoDeCliente;
    }

    public function getAtividadeDaEmpresa() {
        return $this->atividadeDaEmpresa;
    }

    public function getFkNacionalidade() {
        return $this->fkNacionalidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFkAdmin() {
        return $this->fkAdmin;
    }

    public function setNomeCompleto($nomeCompleto){
        $this->nomeCompleto = $nomeCompleto;
    }

    public function setTipoDeCliente($tipoDeCliente){
        $this->tipoDeCliente = $tipoDeCliente;
    }

    public function setAtividadeDaEmpresa($atividadeDaEmpresa){
        $this->atividadeDaEmpresa = $atividadeDaEmpresa;
    }

    public function setFkNacionalidade($fkNacionalidade){
        $this->fkNacionalidade = $fkNacionalidade;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function setFkAdmin($fkAdmin){
        $this->fkAdmin = $fkAdmin;
    }


}
