<?php

/**
 * Description of NacionalidadeServices
 *
 * @author Rui Malemba
 */
require_once 'INacionalidadeServices.php';
require_once '../repositories/NacionalidadeRepositories.php';
class NacionalidadeServices implements INacionalidadeServices {
    
    //listar nacionalidades
    public function listarNacionalidades() {

        $nacionalidadeRepositories = new NacionalidadeRepositories();
        // Verifica o select
        $result = $nacionalidadeRepositories->listarNacionalidades();

        if (count($result) > 0) {
            return $result; //tem nacionalidades registrados
        } else {
            return -1; //Não tem provincia
        }
    }
    
}
