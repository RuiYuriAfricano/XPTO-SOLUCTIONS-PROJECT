<?php

/**
 * Description of GestorRepositories
 *
 * @author Rui Malemba
 */
include_once '../dbconfig/Conexao.php';
require_once 'IGestorRepositories.php';


class GestorRepositories implements IGestorRepositories {

    private $con;

    public function __construct() {
        $this->con = new Conexao(); // Corrigido para atribuir valor a $this->con
    }

    //logar com gestor
    public function logar($gestor) {
        // Consulta SQL para selecionar o usuário pelo nome de usuário e senha
        if ($this->con->conecta()) { // Corrigido para usar $this->con
            $con = $this->con->conecta(); // Atribui o valor retornado por $this->con->conecta() a $con
            $query = "SELECT u.*, g.* FROM tbuser u, tbgestor g WHERE g.coduser = u.coduser and  username = :username AND password_ = :password";
            $stmt = $con->prepare($query); // Corrigido para usar $con
            $username = $gestor->getUsername();
            $password = $gestor->getPassword_();
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            // Verifica se o usuário existe no banco de dados
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $nome = $user['nomecompleto'];
                $gestor->setNomeCompleto($nome); // Retorna o nome do gestor
                $gestor->setFotografia($user['fotografia']);
                return true; // Login bem-sucedido
            } else {
                return false; // Login falhou
            }
        }

        return false; // Login falhou na conexão com a BD
    }

    //Inserir gestor
    public function inserirGestor($gestor) {
        $con = $this->con->conecta();
        try {

            // Inicia uma transação
            $con->beginTransaction();

            // Insere os dados do usuário na tabela tbuser
            $stmt = $con->prepare("INSERT INTO tbuser (username, password_, telemovel, email, fkcomuna, morada, fotografia) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $username = $gestor->getUserName();
            $password = $gestor->getPassword_();
            $telemovel = $gestor->getTelemovel();
            $email = $gestor->getEmail();
            $fkcomuna = $gestor->getFkcomuna();
            $morada = $gestor->getMorada();
            $foto = $gestor->getFotografia();
            $stmt->execute([$username, $password, $telemovel, $email, $fkcomuna, $morada, $foto]);

            // Obtém o código do usuário inserido
            $coduser = $con->lastInsertId();
            $nomeCompleto = $gestor->getNomeCompleto();
            $fkadmin = $gestor->getFkadmin();
            
            // Insere os dados do gestor na tabela tbcliente
            $stmt = $con->prepare("INSERT INTO tbgestor (coduser, nomeCompleto, fkadmin) VALUES (?, ?, ?)");
            $stmt->execute([$coduser, $nomeCompleto, $fkadmin]);

            // Confirma a transação
            $con->commit();

            return true;
        } catch (PDOException $e) {
            // Caso ocorra algum erro, desfaz a transação
            $con->rollback();
            echo "Erro ao inserir gestor: " . $e->getMessage();
            return false;
        }
    }

    //Atualizar os dados de um gestor
    public function atualizarGestor($gestor) {
        $con = $this->con->conecta();
        try {

            // Inicia uma transação
            $con->beginTransaction();

            // Atualiza os dados do usuário na tabela tbuser
            $stmt = $con->prepare("UPDATE tbuser SET password_ = ?, telemovel = ?, email = ?, fkcomuna = ?, morada = ?, fotografia = ? WHERE username = ?");
            $username = $gestor->getUserName();
            $password = $gestor->getPassword_();
            $telemovel = $gestor->getTelemovel();
            $email = $gestor->getEmail();
            $fkcomuna = $gestor->getFkcomuna();
            $morada = $gestor->getMorada();
            $foto = $gestor->getFotografia();

            $stmt->execute([$password, $telemovel, $email, $fkcomuna, $morada, $username, $foto]);

            // Atualiza os dados do gestor na tabela tbcliente
            $stmt = $con->prepare("UPDATE tbgestor SET nomeCompleto = ? "
                    . "WHERE coduser = (SELECT coduser FROM tbuser WHERE username = (select username from delected) )");
            $nomeCompleto = $gestor->getNomeCompleto();

            $stmt->execute([$nomeCompleto]);

            // Confirma a transação
            $con->commit();

            return true;
        } catch (PDOException $e) {
            // Caso ocorra algum erro, desfaz a transação
            $con->rollback();
            echo "Erro ao atualizar gestor: " . $e->getMessage();
            return false;
        }
    }

    //Eliminar um gestor
    public function eliminarGestor($username) {
        $con = $this->con->conecta();
        try {
            // Inicia uma transação
            $con->beginTransaction();

            // Exclui o gestor da tabela tbgestor
            $stmt = $con->prepare("DELETE FROM tbgestor WHERE coduser in (SELECT coduser FROM tbuser WHERE username = ?)");
            $stmt->execute([$username]);

            // Exclui o usuário da tabela tbuser
            $stmt = $con->prepare("DELETE FROM tbuser WHERE username = ?");
            $stmt->execute([$username]);

            // Confirma a transação
            $con->commit();

            return true;
        } catch (PDOException $e) {
            // Caso ocorra algum erro, desfaz a transação
            $con->rollback();
            echo "Erro ao excluir gestor: " . $e->getMessage();
            return false;
        }
    }

    //Listar os gestores
    public function listarGestores() {
        try {
            $con = $this->con->conecta();
            $stmt = $con->prepare("SELECT u.username, u.password_, u.telemovel, u.email, u.fkcomuna, u.fotografia, u.morada, "
                    . "c.nomeCompleto, a.nomecompleto as nomeAdmin, "
                    . "c.fkadmin, cm.nome as nomeComuna "
                    . "FROM tbuser u, tbgestor c, tbadministrador a, tbcomuna cm where"
                    . " u.coduser = c.coduser and c.fkadmin = a.codadmin and u.fkcomuna = cm.codcomuna");
            $stmt->execute();
            $gestores = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $gestores;
        } catch (PDOException $e) {
            echo "Erro ao listar gestores: " . $e->getMessage();
            return false;
        }
    }
}
