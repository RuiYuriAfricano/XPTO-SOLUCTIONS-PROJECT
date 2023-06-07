<?php

/**
 * Description of MunicipioRepositories
 *
 * @author Rui Malemba
 */
include_once '../dbconfig/Conexao.php';
require_once 'IMunicipioRepositories.php';

class MunicipioRepositories implements IMunicipioRepositories{
    
    private $con;

    public function __construct() {
        $this->con = new Conexao(); // Corrigido para atribuir valor a $this->con
    }

    public function listarMunicipios() {
        
         try {
            $con = $this->con->conecta();
            $stmt = $con->prepare("SELECT * FROM tbmunicipio");
            $stmt->execute();
            $municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $municipios;
        } catch (PDOException $e) {
            echo "Erro ao listar municipios: " . $e->getMessage();
            return false;
        }
    }
}
