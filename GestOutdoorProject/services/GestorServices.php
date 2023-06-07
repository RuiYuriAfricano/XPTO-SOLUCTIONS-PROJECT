<?php

/**
 * Description of GestorServices
 *
 * @author Rui Malemba
 */
include_once '../repositories/GestorRepositories.php';
require_once 'IGestorServices.php';

include_once 'EmailServices.php';

class GestorServices implements IGestorServices{
    
    public function logar($gestor) {
        // Verifica se os campos de entrada estão vazios
        if (!empty($gestor->getUsername()) && !empty($gestor->getPassword_())) {

            $gestorRepositories = new GestorRepositories();
            // Verifica o login
            $result = $gestorRepositories->logar($gestor);

            if ($result) {
                // Iniciar a sessão
                session_start();

                $_SESSION['nomegestor'] = $gestor->getNomeCompleto(); // Armazenar o nome de usuário na sessão
                $_SESSION['fotografia'] = $gestor->getFotografia();
                header('Location: ../view/HomeCliente.php'); // Redirecionar para a página do Gestor
                exit();
                return 1; //sucesso no login
            } else {
                return -1; //senha ou usario errado.
            }
        } else {
            return 0; //campos vazios
        }
    }

    //Inserir gestor
    public function inserirGestor($gestor) {
        $camposPreenchidos = true;

        if (empty($gestor->getUserName()) || empty($gestor->getPassword_()) || empty($gestor->getTelemovel()) ||
                empty($gestor->getEmail()) || empty($gestor->getFkcomuna()) || empty($gestor->getMorada()) ||
                empty($gestor->getNomeCompleto())) {
            $camposPreenchidos = false;
        }
        // Verifica se os campos de entrada estão vazios
        if ($camposPreenchidos) {
            $foto = $gestor->getFotografia();
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
                    $caminhoFoto = $directory . '/' . $gestor->getUsername() . '.jpg';

                    // Move o arquivo para a pasta "userprofile"
                    move_uploaded_file($foto['tmp_name'], $caminhoFoto);
                }
                $gestor->setFotografia($caminhoFoto);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            $gestorRepositories = new GestorRepositories();
            // Verifica o insert
            $result = $gestorRepositories->inserirGestor($gestor);

            if ($result) {
                echo "inserido com sucesso";
                $emailService = new EmailServices();
                $emailService->enviarEmail($gestor, $gestor->getEmail(), 3);//email do gestor
                return 1; //inseriu com sucesso o gestor
            } else {
                echo "não foi inserido com sucesso";
                return -1; //erro de base de dados ao inserir
            }
        } else {
            return 0; //campos vazios
        }
    }

    //atualizar gestor
    public function atualizarGestor($gestor) {
        $camposPreenchidos = true;

        if (empty($gestor->getUserName()) || empty($gestor->getPassword_()) || empty($gestor->getTelemovel()) ||
                empty($gestor->getEmail()) || empty($gestor->getFkcomuna()) || empty($gestor->getMorada()) ||
                empty($gestor->getNomeCompleto()) || empty($gestor->getFotografia())) {
            $camposPreenchidos = false;
        }
        // Verifica se os campos de entrada estão vazios
        if ($camposPreenchidos) {

            $gestorRepositories = new GestorRepositories();
            // Verifica o update
            $result = $gestorRepositories->atualizarGestor($gestor);

            if ($result) {
                header('Location: ../view/HomeAdmin.php');
                return 1; //atualizou com sucesso o gestor
            } else {
                return -1; //erro de base de dados ao atualizar
            }
        } else {
            return 0; //campos vazios
        }
    }

    //atualizar gestor
    public function eliminarGestor($gestor) {
        $camposPreenchidos = true;

        if (empty($gestor->getUserName()) || empty($gestor->getPassword_()) || empty($gestor->getTelemovel()) ||
                empty($gestor->getEmail()) || empty($gestor->getFkcomuna()) || empty($gestor->getMorada()) ||
                empty($gestor->getNomeCompleto())) {
            $camposPreenchidos = false;
        }
        // Verifica se os campos de entrada estão vazios
        if ($camposPreenchidos) {

            $gestorRepositories = new GestorRepositories();
            // Verifica o delete
            $result = $gestorRepositories->eliminarGestor($gestor->getUsername());

            if ($result) {
                header('Location: ../view/HomeAdmin.php');
                return 1; //eliminou com sucesso o gestor
            } else {
                return -1; //erro de base de dados ao eliminar
            }
        } else {
            return 0; //campos vazios
        }
    }

    //listar gestor
    public function listarGestores() {

        $gestorRepositories = new GestorRepositories();
        // Verifica o select
        $result = $gestorRepositories->listarGestores();

        if (count($result) > 0) {
            return $result; //tem clientes registrados
        } else {
            return -1; //Não tem clientes
        }
    }
}
