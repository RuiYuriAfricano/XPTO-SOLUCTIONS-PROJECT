<?php

/**
 * Description of MunicipioControllers
 *
 * @author Rui Malemba
 */

include_once '../model/Municipio.php';
include_once '../services/MunicipioServices.php';

class MunicipioControllers {
    
    //
    public function listarMunicipio() {
        //Objecto service
        $municipioService = new MunicipioServices();
        $result = $municipioService->listarMunicipios();

        return $result;
    }
    
}
