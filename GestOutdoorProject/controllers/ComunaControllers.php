<?php

/**
 * Description of ComunaControllers
 *
 * @author Rui Malemba
 */

include_once '../model/Comuna.php';
include_once '../services/ComunaServices.php';

class ComunaControllers {
    
    //
    public function listarComunas() {
        //Objecto service
        $comunaService = new ComunaServices();
        $result = $comunaService->listarComunas();

        return $result;
    }
    
}

