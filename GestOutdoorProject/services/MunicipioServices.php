<?php

/**
 * Description of MunicipioServices
 *
 * @author Rui Malemba
 */
require_once 'IMunicipioServices.php';
require_once '../repositories/MunicipioRepositories.php';
class MunicipioServices implements IMunicipioServices{
    
    //listar municipios
    public function listarMunicipios() {

        $municipioRepositories = new MunicipioRepositories();
        // Verifica o select
        $result = $municipioRepositories->listarMunicipios();

        if (count($result) > 0) {
            return $result; //tem municipios registrados
        } else {
            return -1; //Não tem municipios
        }
    }
}
