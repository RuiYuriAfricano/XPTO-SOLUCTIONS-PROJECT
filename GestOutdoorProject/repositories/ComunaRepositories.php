<?php

/**
 * Description of ComunaRepositories
 *
 * @author Rui Malemba
 */

include_once '../dbconfig/Conexao.php';
require_once 'IComunaRepositories.php';


class ComunaRepositories implements IComunaRepositories{
    
     private $con;

    public function __construct() {
        $this->con = new Conexao(); // Corrigido para atribuir valor a $this->con
    }

    public function listarComunas() {
        
         try {
            $con = $this->con->conecta();
            $stmt = $con->prepare("SELECT * FROM tbcomuna");
            $stmt->execute();
            $comunas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comunas;
        } catch (PDOException $e) {
            echo "Erro ao listar municipios: " . $e->getMessage();
            return false;
        }
    }
}
