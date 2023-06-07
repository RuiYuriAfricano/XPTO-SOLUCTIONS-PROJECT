<?php

/**
 * Description of ClienteRepositories
 *
 * @author Rui Malemba
 */
include_once '../dbconfig/Conexao.php';
require_once 'IClienteRepositories.php';

class ClienteRepositories implements IClienteRepositories {

    private $con;

    public function __construct() {
        $this->con = new Conexao(); // Corrigido para atribuir valor a $this->con
    }

    //logar com cliente
    public function logar($cliente) {
        // Consulta SQL para selecionar o usuário pelo nome de usuário e senha
        if ($this->con->conecta()) { // Corrigido para usar $this->con
            $con = $this->con->conecta(); // Atribui o valor retornado por $this->con->conecta() a $con
            $query = "SELECT u.*, c.* FROM tbuser u, tbcliente c WHERE c.coduser = u.coduser and  username = :username AND password_ = :password and estado = 'activado'";
            $stmt = $con->prepare($query); // Corrigido para usar $con
            $username = $cliente->getUsername();
            $password = $cliente->getPassword_();
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            // Verifica se o usuário existe no banco de dados
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $nome = $user['nomecompleto'];
                $cliente->setNomeCompleto($nome); // Retorna o nome do cliente
                $cliente->setFotografia($user['fotografia']);
                $cliente->setEmail($user['coduser']);
                return true; // Login bem-sucedido
            } else {
                return false; // Login falhou
            }
        }

        return false; // Login falhou na conexão com a BD
    }

    //Inserir cliente
    public function inserirCliente($cliente) {
        $con = $this->con->conecta();
        try {

            // Inicia uma transação
            $con->beginTransaction();

            // Insere os dados do usuário na tabela tbuser
            $stmt = $con->prepare("INSERT INTO tbuser (username, password_, telemovel, email, fkcomuna, morada, fotografia) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $username = $cliente->getUserName();
            $password = $cliente->getPassword_();
            $telemovel = $cliente->getTelemovel();
            $email = $cliente->getEmail();
            $fkcomuna = $cliente->getFkcomuna();
            $morada = $cliente->getMorada();
            $foto = $cliente->getFotografia();
            $stmt->execute([$username, $password, $telemovel, $email, $fkcomuna, $morada, $foto]);

            // Obtém o código do usuário inserido
            $coduser = $con->lastInsertId();
            $tipocliente = $cliente->getTipoDeCliente();
            $actividadedaempresa = $cliente->getAtividadeDaEmpresa();
            $fknacionalidade = $cliente->getFkNacionalidade();
            $estado = $cliente->getEstado();
            $fkadmin = $cliente->getFkAdmin();
            $nomeCompleto = $cliente->getNomeCompleto();

            // Insere os dados do cliente na tabela tbcliente
            $stmt = $con->prepare("INSERT INTO tbcliente (coduser, nomeCompleto, tipodecliente, actividadedaempresa, fknacionalidade, estado, fkadmin) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$coduser, $nomeCompleto, $tipocliente, $actividadedaempresa, $fknacionalidade, $estado, $fkadmin]);

            // Confirma a transação
            $con->commit();

            return true;
        } catch (PDOException $e) {
            // Caso ocorra algum erro, desfaz a transação
            $con->rollback();
            echo "Erro ao inserir cliente: " . $e->getMessage();
            return false;
        }
    }

    //Atualizar os dados de um cliente
    public function atualizarCliente($cliente) {
        $con = $this->con->conecta();
        try {

            // Inicia uma transação
            $con->beginTransaction();

            //pega o coduser
            // Consulta para obter o coduser com base no username
            $stmt = $con->prepare("SELECT coduser FROM tbuser WHERE username = ?");
            $username = $cliente->getUserName();
            $stmt->execute([$username]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $codUser = $result['coduser'];

            // Atualiza os dados do usuário na tabela tbuser
            $stmt = $con->prepare("UPDATE tbuser SET password_ = ?, telemovel = ?, email = ?, fkcomuna = ?, morada = ?, fotografia = ? WHERE username = ?");
            
            $password = $cliente->getPassword_();
            $telemovel = $cliente->getTelemovel();
            $email = $cliente->getEmail();
            $fkcomuna = $cliente->getFkcomuna();
            $morada = $cliente->getMorada();
            $foto = $cliente->getFotografia();

            $stmt->execute([$password, $telemovel, $email, $fkcomuna, $morada, $foto, $username]);

            // Atualiza os dados do cliente na tabela tbcliente
            $stmt = $con->prepare("UPDATE tbcliente SET nomeCompleto = ?, tipodecliente = ?, actividadedaempresa = ?, fknacionalidade = ?, estado = ?, fkadmin = ? "
                    . "WHERE coduser = ?");
            $nomeCompleto = $cliente->getNomeCompleto();
            $tipocliente = $cliente->getTipoDeCliente();
            $actividadedaempresa = $cliente->getAtividadeDaEmpresa();
            $fknacionalidade = $cliente->getFkNacionalidade();
            $estado = $cliente->getEstado();
            $fkadmin = $cliente->getFkAdmin();

            $stmt->execute([$nomeCompleto, $tipocliente, $actividadedaempresa, $fknacionalidade, $estado, $fkadmin, $codUser]);

            // Confirma a transação
            $con->commit();

            return true;
        } catch (PDOException $e) {
            // Caso ocorra algum erro, desfaz a transação
            $con->rollback();
            echo "Erro ao atualizar cliente: " . $e->getMessage();
            return false;
        }
    }

    //Eliminar um cliente
    public function eliminarCliente($username) {
        $con = $this->con->conecta();
        try {
            // Inicia uma transação
            $con->beginTransaction();

            // Exclui o cliente da tabela tbcliente
            $stmt = $con->prepare("DELETE FROM tbcliente WHERE coduser in (SELECT coduser FROM tbuser WHERE username = ?)");
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
            echo "Erro ao excluir cliente: " . $e->getMessage();
            return false;
        }
    }

    //Listar os clientes
    public function listarClientes() {
        try {
            $con = $this->con->conecta();
            $stmt = $con->prepare("SELECT u.coduser, u.username, u.password_, u.telemovel, u.email, u.fkcomuna, u.fotografia, u.morada, c.nomeCompleto,"
                    . " c.tipodecliente, c.actividadedaempresa, c.fknacionalidade, c.estado, a.nomecompleto as nomeAdmin, "
                    . "c.fkadmin, cm.nome as nomeComuna, nac.nacionalidade "
                    . "FROM tbuser u, tbcliente c, tbadministrador a, tbcomuna cm, tbnacionalidade nac where"
                    . " u.coduser = c.coduser and c.fkadmin = a.codadmin and u.fkcomuna = cm.codcomuna and "
                    . "c.fknacionalidade = nac.codnacionalidade and c.estado = 'activado'");
            $stmt->execute();
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clientes;
        } catch (PDOException $e) {
            echo "Erro ao listar clientes: " . $e->getMessage();
            return false;
        }
    }

    //Listar os clientes
    public function listarClientesNaoAtivados() {
        try {
            $con = $this->con->conecta();
            $stmt = $con->prepare("SELECT u.username, u.password_, u.telemovel, u.email, u.fkcomuna, u.fotografia, u.morada, c.nomeCompleto,"
                    . " c.tipodecliente, c.actividadedaempresa, c.fknacionalidade, c.estado, "
                    . "c.fkadmin, cm.nome as nomeComuna, nac.nacionalidade "
                    . "FROM tbuser u, tbcliente c, tbcomuna cm, tbnacionalidade nac where"
                    . " u.coduser = c.coduser and u.fkcomuna = cm.codcomuna and "
                    . "c.fknacionalidade = nac.codnacionalidade and c.estado = 'desativado'");
            $stmt->execute();
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clientes;
        } catch (PDOException $e) {
            echo "Erro ao listar clientes não activados: " . $e->getMessage();
            return false;
        }
    }
}
