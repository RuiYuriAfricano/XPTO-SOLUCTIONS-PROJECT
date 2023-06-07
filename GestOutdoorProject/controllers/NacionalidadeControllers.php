<?php

/**
 * Description of NacionalidadeControllers
 *
 * @author Rui Malemba
 */

include_once '../model/Nacionalidade.php';
include_once '../services/NacionalidadeServices.php';
class NacionalidadeControllers {
    
    //
    public function listarNacionalidades() {
        //Objecto service
        $nacionalidadeService = new NacionalidadeServices();
        $result = $nacionalidadeService->listarNacionalidades();

        return $result;
    }
    
}
