<?php

/**
 * Description of ProvinciaRepositories
 *
 * @author Rui Malemba
 */
include_once '../dbconfig/Conexao.php';
require_once 'IProvinciaRepositories.php';

class ProvinciaRepositories implements IProvinciaRepositories{
    
    private $con;

    public function __construct() {
        $this->con = new Conexao(); // Corrigido para atribuir valor a $this->con
    }

    public function listarProvincias() {
        
         try {
            $con = $this->con->conecta();
            $stmt = $con->prepare("SELECT * FROM tbprovincia");
            $stmt->execute();
            $provincias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $provincias;
        } catch (PDOException $e) {
            echo "Erro ao listar provincias: " . $e->getMessage();
            return false;
        }
    }
    
}
