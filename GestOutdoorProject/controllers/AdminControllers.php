<?php

/**
 * Description of AdminControllers
 *
 * @author Rui Malemba
 */
include_once '../model/Administrador.php';
include_once '../services/AdminServices.php';

// Verifica se o formulário de login foi enviado
/* if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['loginbtn'])) {
  $adminController = new AdminControllers();
  $adminController->logar();
  } */


class AdminControllers {

    public function logar() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password_ = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        //Objecto admin
        $admin = new Administrador($username, $password_, "", "", "", "", "", "");

        //Objecto service
        $adminService = new AdminServices();
        $result = $adminService->logar($admin);
        
        return $result;
    }
}
