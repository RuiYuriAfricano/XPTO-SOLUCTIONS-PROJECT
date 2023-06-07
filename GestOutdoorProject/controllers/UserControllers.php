<?php

/**
 * Description of UserControllers
 *
 * @author Rui Malemba
 */
include_once 'AdminControllers.php';
include_once 'ClienteControllers.php';
$usercontrollers = new UserControllers();

class UserControllers {

    public function __construct() {

        //Verifica se o formulário de login foi enviado
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['loginbtn'])) {

            $user = new AdminControllers();
            $result = $user->logar();

            if ($result == -1) {
                $user = new ClienteControllers();
                $result = $user->logar();

                if ($result == -1) {
                    session_start();
                    $_SESSION['erro'] = "Dados de autenticação estão incorretos!";
                    header('Location: ../view/Login.php'); // Redirecionar para a página de administração
                    exit();
                }
            }
        }
    }
}
