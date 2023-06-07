<?php

/**
 * Description of GestorControllers
 *
 * @author Rui Malemba
 */
include_once '../model/Gestor.php';
include_once '../services/GestorServices.php';

if (isset($_POST['inserirGestor'])) {
    $gestorcontroller = new GestorControllers();
    $gestorcontroller->inserirGestor();
} else if (isset($_GET['atualizarGestor'])) {
    $gestorcontroller = new GestorControllers();
    $gestorcontroller->atualizarGestor();
} else if (isset($_GET['eliminarGestor'])) {
    $gestorcontroller = new GestorControllers();
    $gestorcontroller->eliminarGestor();
}

class GestorControllers {

    public function logar() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password_ = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        //Objecto gestor
        $gestor = new Gestor($username, $password_, "", "", "", "", "", "", "", "", "", "", "");

        //Objecto service
        $gestorService = new GestorServices();
        $result = $gestorService->logar($gestor);
        return $result;
    }

    //InserirGestor
    public function inserirGestor() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password_ = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $telemovel = filter_input(INPUT_POST, 'telemovel', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $fkcomuna = filter_input(INPUT_POST, 'comuna', FILTER_SANITIZE_STRING);
        $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_STRING);
        $nomeCompleto = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $fkAdmin = filter_input(INPUT_POST, 'fkadmin', FILTER_SANITIZE_STRING); // inicialmente é nulo, quando ser aprovado aí sim vai ter o valor do admin
        $foto = $_FILES['foto'];
        
        //Objecto gestor
        $gestor = new Gestor($username, $password_, $telemovel, $email, $fkcomuna, $morada, $foto, $nomeCompleto, $fkAdmin);

        //Objecto service
        $gestorService = new GestorServices();
        $result = $gestorService->inserirGestor($gestor);
        
        if ($result == -1) {
            session_start();
            $_SESSION['erro-inserir'] = "Ocorreu algum erro na inserção!";
            header('Location: ../view/InserirGestorAdmin.php'); // Redirecionar para a página de insercao do gestor 
            exit();
        }
        else if ($result == 1) {
            session_start();
            $_SESSION['sucesso-inserir'] = "Registro efectuado com sucesso!";
            header('Location: ../view/InserirGestorAdmin.php'); // Redirecionar para a página de insercao de gestor
            exit();
        }
    }

    //AtualizarGestor
    public function atualizarGestor() {

        if (isset($_POST['atualizarGestor'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password_ = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $telemovel = filter_input(INPUT_POST, 'telemovel', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $fkcomuna = filter_input(INPUT_POST, 'comuna', FILTER_SANITIZE_STRING);
            $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_STRING);
            $foto = filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_STRING); //do hidden
            $nomeCompleto = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $fkAdmin = filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_STRING);

            //Objecto gestor
            $gestor = new Gestor($username, $password_, $telemovel, $email, $fkcomuna, $morada, $foto, $fkAdmin);

            //Objecto service
            $gestorService = new GestorServices();
            $result = $gestorService->atualizarGestor($gestor);
        }
    }

    //EliminarGestor
    public function eliminarGestor() {
        if (isset($_GET['eliminarGestor'])) {
            // Obtém o valor do parâmetro
            $parametro = $_GET['eliminarGestor'];

            // Decodifica o valor
            $jsonObjeto = urldecode($parametro);

            // Converte o JSON de volta para objeto
            $objetoGestor = json_decode($jsonObjeto);

            $username = $objetoGestor->username;
            $password_ = $objetoGestor->password_;
            $telemovel = $objetoGestor->telemovel;
            $email = $objetoGestor->email;
            $fkcomuna = $objetoGestor->fkcomuna;
            $morada = $objetoGestor->morada;
            $foto = $objetoGestor->fotografia;
            $nomeCompleto = $objetoGestor->nomeCompleto;
            $fkAdmin = $objetoGestor->fkadmin;

            //Objecto gestor
            $gestor = new Gestor($username, $password_, $telemovel, $email, $fkcomuna, $morada, $foto, $nomeCompleto, $fkAdmin);

            //Objecto service
            $gestorService = new GestorServices();
            $result = $gestorService->eliminarGestor($gestor);
        }
    }

    //ListarGestor
    public function listarGestores() {
        //Objecto service
        $gestorService = new GestorServices();
        $result = $gestorService->listarGestores();

        return $result;
    }
}
