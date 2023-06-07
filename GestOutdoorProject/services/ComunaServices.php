<?php

/**
 * Description of ComunaServices
 *
 * @author Rui Malemba
 */
require_once 'IComunaServices.php';
require_once '../repositories/ComunaRepositories.php';
class ComunaServices implements IComunaServices{
    
    //listar comunas
    public function listarComunas() {

        $comunaRepositories = new ComunaRepositories();
        // Verifica o select
        $result = $comunaRepositories->listarComunas();

        if (count($result) > 0) {
            return $result; //tem comunas registrados
        } else {
            return -1; //Não tem comunas
        }
    }
    
}
