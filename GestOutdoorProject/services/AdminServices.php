<?php

/**
 * Description of AdminServices
 *
 * @author Rui Malemba
 */
include_once '../repositories/AdminRepositories.php';
require_once 'IAdminServices.php';

class AdminServices implements IAdminServices {

    public function logar($admin) {
        // Verifica se os campos de entrada estão vazios
        if (!empty($admin->getUsername()) && !empty($admin->getPassword_())) {

            $adminRepositories = new AdminRepositories();
            // Verifica o login
            $result = $adminRepositories->logar($admin);

            if ($result) {
                // Iniciar a sessão
                session_start();

                $_SESSION['nomeadmin'] = $admin->getNomeCompleto(); // Armazenar o nome de usuário na sessão
                $_SESSION['fotografia'] = $admin->getFotografia();
                $_SESSION['codadmin'] = $admin->getEmail();
                header('Location: ../view/HomeAdmin.php'); // Redirecionar para a página de administração
                exit();
                return 1; //sucesso no login
            } else {
                return -1; //senha ou usario errado.
            }
        } else {
            return 0; //campos vazios
        }
    }
}
