<?php

/**
 * Description of ClienteControllers
 *
 * @author Rui Malemba
 */
include_once '../model/Cliente.php';
include_once '../services/ClienteServices.php';

// Verifica se o formulário de login foi enviado

if (isset($_POST["inserirCliente"])) {

    $clientecontroller = new ClienteControllers();
    $clientecontroller->inserirCliente();
} else if (isset($_GET['atualizaEstado'])) {
    $clientecontroller = new ClienteControllers();
    $clientecontroller->atualizarCliente();
} else if (isset($_POST["fotoantiga"])) {//atualizar dados cliente, feito pelo cliente.
    $clientecontroller = new ClienteControllers();
    $clientecontroller->atualizarCliente();
} else if (isset($_GET['eliminar'])) {
    $clientecontroller = new ClienteControllers();
    $clientecontroller->eliminarCliente();
}

class ClienteControllers {

    public function logar() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password_ = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        //Objecto cliente
        $cliente = new Cliente($username, $password_, "", "", "", "", "", "", "", "", "", "", "");

        //Objecto service
        $clienteService = new ClienteServices();
        $result = $clienteService->logar($cliente);
        return $result;
    }

    //InserirCLiente
    public function inserirCliente() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password_ = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $telemovel = filter_input(INPUT_POST, 'telemovel', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $fkcomuna = filter_input(INPUT_POST, 'comuna', FILTER_SANITIZE_STRING);

        $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_STRING);
        $nomeCompleto = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $tipoDeCliente = filter_input(INPUT_POST, 'tipocliente', FILTER_SANITIZE_STRING);
        $atividadeDaEmpresa = filter_input(INPUT_POST, 'atividade', FILTER_SANITIZE_STRING);
        $fkNacionalidade = filter_input(INPUT_POST, 'nacionalidade', FILTER_SANITIZE_STRING);
        $estado = "desativado"; // valor por default.
        $fkAdmin = null; // inicialmente é nulo, quando ser aprovado aí sim vai ter o valor do admin
        $foto = $_FILES['foto'];

        //Objecto cliente
        $cliente = new Cliente($username, $password_, $telemovel, $email, $fkcomuna, $morada, $foto, $nomeCompleto, $tipoDeCliente,
                $atividadeDaEmpresa, $fkNacionalidade, $estado, $fkAdmin);

        //Objecto service
        $clieneService = new ClienteServices();
        $result = $clieneService->inserirCliente($cliente);
        if ($result == -1) {
            session_start();
            $_SESSION['erro-adesao'] = "Ocorreu algum erro na inserção!";
            header('Location: ../view/Adesao.php'); // Redirecionar para a página de administração
            exit();
        }
        else if ($result == 1) {
            session_start();
            $_SESSION['sucesso-adesao'] = "Cliente registrado com sucesso!";
            header('Location: ../view/Adesao.php'); // Redirecionar para a página de administração
            exit();
        }
    }

    //AtualizarCLiente
    public function atualizarCliente() {
        $caminhoFoto;
        if (isset($_GET['atualizaEstado'])) {
            // Obtém o valor do parâmetro
            $parametro = $_GET['atualizaEstado'];

            // Decodifica o valor
            $jsonObjeto = urldecode($parametro);

            // Converte o JSON de volta para objeto
            $objetoCliente = json_decode($jsonObjeto);

            $username = $objetoCliente->username;
            $password_ = $objetoCliente->password_;
            $telemovel = $objetoCliente->telemovel;
            $email = $objetoCliente->email;
            $fkcomuna = $objetoCliente->fkcomuna;
            $morada = $objetoCliente->morada;
            $caminhoFoto = $objetoCliente->fotografia;
            $nomeCompleto = $morada = $objetoCliente->nomeCompleto;
            $tipoDeCliente = $objetoCliente->tipodecliente;
            $atividadeDaEmpresa = $objetoCliente->actividadedaempresa;
            $fkNacionalidade = $objetoCliente->fknacionalidade;
            $estado = $objetoCliente->estado;
            $fkAdmin = $objetoCliente->fkadmin;
            
            
        } else {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password_ = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $telemovel = filter_input(INPUT_POST, 'telemovel', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $fkcomuna = filter_input(INPUT_POST, 'comuna', FILTER_SANITIZE_STRING);
            $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_STRING);

            $nomeCompleto = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $tipoDeCliente = filter_input(INPUT_POST, 'tipocliente', FILTER_SANITIZE_STRING);
            $atividadeDaEmpresa = filter_input(INPUT_POST, 'atividade', FILTER_SANITIZE_STRING);
            $fkNacionalidade = filter_input(INPUT_POST, 'nacionalidade', FILTER_SANITIZE_STRING);
            $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
            $fkAdmin = filter_input(INPUT_POST, 'fkadmin', FILTER_SANITIZE_STRING);

            $foto = $_FILES['foto'];
            $fotoAntiga = filter_input(INPUT_POST, 'fotoantiga', FILTER_SANITIZE_STRING); //do hidden
            // Verificar se uma nova foto foi carregada
            if ($foto['error'] !== UPLOAD_ERR_NO_FILE) {
                // Nova foto foi carregada
                $caminhoFoto = $foto;
            } else {
                // Nenhuma nova foto foi carregada, usar a foto antiga
                $caminhoFoto = $fotoAntiga;
            }
        }
        //Objecto cliente
        $cliente = new Cliente($username, $password_, $telemovel, $email, $fkcomuna, $morada, $caminhoFoto, $nomeCompleto, $tipoDeCliente,
                $atividadeDaEmpresa, $fkNacionalidade, $estado, $fkAdmin);

        //Objecto service
        $clieneService = new ClienteServices();
        $result = $clieneService->atualizarCliente($cliente);
        
        if ($result == -1 && !isset($_GET['atualizaEstado'])) {
            session_start();
            $_SESSION['erro-atualizacao'] = "Ocorreu algum erro na atualizacao!";
            header('Location: ../view/AtualizarDadosCliente.php'); // Redirecionar para a página de edição cliente
            exit();
        }
        else if ($result == 1 && !isset($_GET['atualizaEstado'])) {
            session_start();
            $_SESSION['sucesso-atualizacao'] = "Dados atualizado com sucesso!";
            header('Location: ../view/AtualizarDadosCliente.php'); // Redirecionar para a página de edição cliente
            exit();
        }
        else if ($result == -1 && isset($_GET['atualizaEstado'])) {
            session_start();
            $_SESSION['erro-ativado'] = "Ocorreu algum erro na ativação do cliente!";
            header('Location: ../view/HomeAdmin.php'); // Redirecionar para a página home do admin
            exit();
        }
        else if ($result == 1 && isset($_GET['atualizaEstado'])) {
            session_start();
            $_SESSION['sucesso-ativado'] = "Cliente ativado com sucesso, consulte a lista dos activados!";
            header('Location: ../view/HomeAdmin.php'); // Redirecionar para a página home do admin
            exit();
        }
    }

    //EliminarCLiente
    public function eliminarCliente() {
        if (isset($_GET['eliminar'])) {
            // Obtém o valor do parâmetro
            $parametro = $_GET['eliminar'];

            // Decodifica o valor
            $jsonObjeto = urldecode($parametro);

            // Converte o JSON de volta para objeto
            $objetoCliente = json_decode($jsonObjeto);

            $username = $objetoCliente->username;
            $password_ = $objetoCliente->password_;
            $telemovel = $objetoCliente->telemovel;
            $email = $objetoCliente->email;
            $fkcomuna = $objetoCliente->fkcomuna;
            $morada = $objetoCliente->morada;
            $foto = $objetoCliente->fotografia;
            $nomeCompleto = $objetoCliente->nomeCompleto;
            $tipoDeCliente = $objetoCliente->tipodecliente;
            $atividadeDaEmpresa = $objetoCliente->actividadedaempresa;
            $fkNacionalidade = $objetoCliente->fknacionalidade;
            $estado = $objetoCliente->estado;
            $fkAdmin = $objetoCliente->fkadmin;

            //Objecto cliente
            $cliente = new Cliente($username, $password_, $telemovel, $email, $fkcomuna, $morada, $foto, $nomeCompleto, $tipoDeCliente,
                    $atividadeDaEmpresa, $fkNacionalidade, $estado, $fkAdmin);

            //Objecto service
            $clieneService = new ClienteServices();
            $result = $clieneService->eliminarCliente($cliente);
        }
    }

    //ListarCLiente
    public function listarClientes() {
        //Objecto service
        $clienteService = new ClienteServices();
        $result = $clienteService->listarClientes();

        return $result;
    }

    //clientes desativados
    public function listarClientesNaoAtivados() {
        //Objecto service
        $clienteService = new ClienteServices();
        $result = $clienteService->listarClientesNaoAtivados();

        return $result;
    }
}
