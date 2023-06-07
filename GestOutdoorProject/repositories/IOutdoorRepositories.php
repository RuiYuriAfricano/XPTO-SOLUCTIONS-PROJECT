<?php

/**
 *
 * @author Rui Malemba
 */
interface IOutdoorRepositories {
    
    //Método para inserir outdoor
    public function inserirOutdoor($outdoor);
    
    //Método para atualizar outdoor
    public function atualizarOutdoor($outdoor);
    
    //Método para eliminar outdoor
    public function eliminarOutdoor($outdoor);
    
    //Método para listar outdoors
    public function listarOutdoors();
}
