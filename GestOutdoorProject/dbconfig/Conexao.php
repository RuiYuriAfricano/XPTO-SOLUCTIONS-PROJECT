<?php

/**
 * Description of Conexao
 *
 * @author Rui Malemba
 */
class Conexao {

    private $host;
    private $user;
    private $password;
    private $db;

    public function Conexao() {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->db = "dbgestoutdoorxpto";
    }

    public function conecta() {
        try {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Ocorreu algum erro na conexão com o database: " . $e->getMessage();
        }
    }
}
