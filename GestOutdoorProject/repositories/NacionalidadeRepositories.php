<?php

/**
 * Description of NacionalidadeRepositories
 *
 * @author Rui Malemba
 */
include_once '../dbconfig/Conexao.php';
require_once 'INacionalidadeRepositories.php';

class NacionalidadeRepositories implements INacionalidadeRepositories {

    private $con;

    public function __construct() {
        $this->con = new Conexao(); // Corrigido para atribuir valor a $this->con
    }

    public function listarNacionalidades() {
        
         try {
            $con = $this->con->conecta();
            $stmt = $con->prepare("SELECT * FROM tbnacionalidade");
            $stmt->execute();
            $nacionalidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $nacionalidades;
        } catch (PDOException $e) {
            echo "Erro ao listar nacionalidades: " . $e->getMessage();
            return false;
        }
    }
}
