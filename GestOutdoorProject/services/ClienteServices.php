<?php

/**
 * Description of ClienteServices
 *
 * @author Rui Malemba
 */
include_once '../repositories/ClienteRepositories.php';
require_once 'IClienteServices.php';

include_once 'EmailServices.php';

class ClienteServices implements IClienteServices {

    public function logar($cliente) {
        // Verifica se os campos de entrada estão vazios
        if (!empty($cliente->getUsername()) && !empty($cliente->getPassword_())) {

            $clienteRepositories = new ClienteRepositories();
            // Verifica o login
            $result = $clienteRepositories->logar($cliente);

            if ($result) {
                // Iniciar a sessão
                session_start();

                $_SESSION['nomecliente'] = $cliente->getNomeCompleto(); // Armazenar o nome de usuário na sessão
                $_SESSION['fotografia'] = $cliente->getFotografia();
                $_SESSION['coduser'] = $cliente->getEmail();
                header('Location: ../view/HomeCliente.php'); // Redirecionar para a página do Cliente
                exit();
                return 1; //sucesso no login
            } else {
                return -1; //senha ou usario errado.
            }
        } else {
            return 0; //campos vazios
        }
    }

    //Inserir cliente
    public function inserirCliente($cliente) {
        $camposPreenchidos = true;

        if (empty($cliente->getUserName()) || empty($cliente->getPassword_()) || empty($cliente->getTelemovel()) ||
                empty($cliente->getEmail()) || empty($cliente->getFkcomuna()) || empty($cliente->getMorada()) ||
                empty($cliente->getNomeCompleto()) || empty($cliente->getTipoDeCliente()) || empty($cliente->getAtividadeDaEmpresa()) ||
                empty($cliente->getFkNacionalidade()) || empty($cliente->getEstado())) {
            $camposPreenchidos = false;
        }
        // Verifica se os campos de entrada estão vazios
        if ($camposPreenchidos) {
            $foto = $cliente->getFotografia();
            //Tratamento da fotografia
            try {
                // Verifica se o diretório "userprofile" existe
                $directory = '../content/images/profilephoto';
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                if ($foto['error'] === UPLOAD_ERR_NO_FILE) {
                    $foto = "fotoAnonimo";
                    $caminhoFoto = $directory . '/' . $foto . '.jpg';
                } else {
                    // Define o caminho e nome do arquivo
                    $caminhoFoto = $directory . '/' . $cliente->getUsername() . '.jpg';

                    // Move o arquivo para a pasta "userprofile"
                    move_uploaded_file($foto['tmp_name'], $caminhoFoto);
                }
                $cliente->setFotografia($caminhoFoto);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }

            $clienteRepositories = new ClienteRepositories();
            // Verifica o insert
            $result = $clienteRepositories->inserirCliente($cliente);

            if ($result) {
                echo "inserido com sucesso";
                $emailService = new EmailServices();
                $emailService->enviarEmail($cliente, 'yuriafricano03@gmail.com', 1); //email do sistema para o admin
                return 1; //inseriu com sucesso o cliente
            } else {
                echo "não foi inserido com sucesso";
                return -1; //erro de base de dados ao inserir
            }
        } else {
            return 0; //campos vazios
        }
    }

    //atualizar cliente
    public function atualizarCliente($cliente) {
        $camposPreenchidos = true;

        if (empty($cliente->getUserName()) || empty($cliente->getPassword_()) || empty($cliente->getTelemovel()) ||
                empty($cliente->getEmail()) || empty($cliente->getFkcomuna()) || empty($cliente->getMorada()) ||
                empty($cliente->getNomeCompleto()) || empty($cliente->getTipoDeCliente()) || empty($cliente->getAtividadeDaEmpresa()) ||
                empty($cliente->getFkNacionalidade()) || empty($cliente->getEstado()) || empty($cliente->getFotografia())) {
            $camposPreenchidos = false;
        }
        // Verifica se os campos de entrada estão vazios
        if ($camposPreenchidos) {

            $foto = $cliente->getFotografia();
            //Tratamento da fotografia
            try {
                // Verifica se o diretório "userprofile" existe
                $directory = '../content/images/profilephoto';
                $caminhoFoto = '';
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                if ($foto['error'] === UPLOAD_ERR_NO_FILE) {
                    $foto = "fotoAnonimo";
                    $caminhoFoto = $directory . '/' . $foto . '.jpg';
                } else {
                    // Define o caminho e nome do arquivo
                    $caminhoFoto = $directory . '/' . $cliente->getUsername() . '.jpg';

                    // Move o arquivo para a pasta "userprofile"
                    move_uploaded_file($foto['tmp_name'], $caminhoFoto);
                }
                $cliente->setFotografia($caminhoFoto);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }


            $clienteRepositories = new ClienteRepositories();
            // Verifica o update
            $result = $clienteRepositories->atualizarCliente($cliente);

            if ($result && isset($_SESSION['codadmin'])) {//admin ativou a conta de um cliente
                $emailService = new EmailServices();
                $emailService->enviarEmail($cliente, $cliente->getEmail(), 2); //email do admin para o utilizador
                header('Location: ../view/HomeAdmin.php');
                return 1; //atualizou com sucesso o cliente
            } else if ($result) { //cliente atualizou os seus dados
                return 1; //atualizou com sucesso o cliente
            } else {
                return -1; //erro de base de dados ao atualizar
            }
        } else {
            return 0; //campos vazios
        }
    }

    //atualizar cliente
    public function eliminarCliente($cliente) {
        $camposPreenchidos = true;

        if (empty($cliente->getUserName()) || empty($cliente->getPassword_()) || empty($cliente->getTelemovel()) ||
                empty($cliente->getEmail()) || empty($cliente->getFkcomuna()) || empty($cliente->getMorada()) ||
                empty($cliente->getNomeCompleto()) || empty($cliente->getTipoDeCliente()) || empty($cliente->getAtividadeDaEmpresa()) ||
                empty($cliente->getFkNacionalidade()) || empty($cliente->getEstado())) {
            $camposPreenchidos = false;
        }
        // Verifica se os campos de entrada estão vazios
        if ($camposPreenchidos) {

            $clienteRepositories = new ClienteRepositories();
            // Verifica o delete
            $result = $clienteRepositories->eliminarCliente($cliente->getUsername());

            if ($result) {
                header('Location: ../view/HomeAdmin.php');
                return 1; //eliminou com sucesso o cliente
            } else {
                return -1; //erro de base de dados ao eliminar
            }
        } else {
            return 0; //campos vazios
        }
    }

    //listar cliente
    public function listarClientes() {

        $clienteRepositories = new ClienteRepositories();
        // Verifica o select
        $result = $clienteRepositories->listarClientes();

        if (count($result) > 0) {
            return $result; //tem clientes registrados
        } else {
            return -1; //Não tem clientes
        }
    }

    //listar cliente
    public function listarClientesNaoAtivados() {

        $clienteRepositories = new ClienteRepositories();
        // Verifica o select
        $result = $clienteRepositories->listarClientesNaoAtivados();

        if (count($result) > 0) {
            return $result; //tem clientes registrados
        } else {
            return -1; //Não tem clientes
        }
    }
}
