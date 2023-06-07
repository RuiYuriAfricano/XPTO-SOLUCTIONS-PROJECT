<?php

/**
 * Description of AdminRepositories
 *
 * @author Rui Malemba
 */
include_once '../dbconfig/Conexao.php';
require_once 'IAdminRepositories.php';

class AdminRepositories implements IAdminRepositories {
    private $con;

    public function __construct() {
        $this->con = new Conexao(); // Corrigido para atribuir valor a $this->con
    }

    public function logar($admin) {
        // Consulta SQL para selecionar o usuário pelo nome de usuário e senha
        if ($this->con->conecta()) { // Corrigido para usar $this->con
            $con = $this->con->conecta(); // Atribui o valor retornado por $this->con->conecta() a $con
            $query = "SELECT u.*, a.* FROM tbuser u, tbadministrador a WHERE a.codadmin = u.coduser and username = :username AND password_ = :password";
            $stmt = $con->prepare($query); // Corrigido para usar $con
            $username = $admin->getUsername();
            $password = $admin->getPassword_();
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            // Verifica se o usuário existe no banco de dados
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $nome = $user['nomecompleto'];
                $admin->setNomeCompleto($nome); // Retorna o nome do usuário
                $admin->setFotografia($user['fotografia']);
                $admin->setEmail($user['codadmin']);
                return true; // Login bem-sucedido
            } else {
                return false; // Login falhou
            }
        }

        return false; // Login falhou
    }
}
