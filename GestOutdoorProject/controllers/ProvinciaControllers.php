<?php

/**
 * Description of ProvinciaControllers
 *
 * @author Rui Malemba
 */

include_once '../model/Provincia.php';
include_once '../services/ProvinciaServices.php';

class ProvinciaControllers {
    
    //
    public function listarProvincias() {
        //Objecto service
        $provinciaService = new ProvinciaServices();
        $result = $provinciaService->listarProvincias();

        return $result;
    }
    
}
