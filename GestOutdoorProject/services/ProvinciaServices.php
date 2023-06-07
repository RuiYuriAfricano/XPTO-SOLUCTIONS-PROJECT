<?php

/**
 * Description of ProvinciaServices
 *
 * @author Rui Malemba
 */
require_once 'IProvinciaServices.php';
require_once '../repositories/ProvinciaRepositories.php';
class ProvinciaServices implements IProvinciaServices{
    //listar provincias
    public function listarProvincias() {

        $provinciaRepositories = new ProvinciaRepositories();
        // Verifica o select
        $result = $provinciaRepositories->listarProvincias();

        if (count($result) > 0) {
            return $result; //tem provincia registrados
        } else {
            return -1; //Não tem provincia
        }
    }
}
