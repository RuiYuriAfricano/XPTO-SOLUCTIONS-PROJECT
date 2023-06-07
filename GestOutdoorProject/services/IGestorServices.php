<?php

/**
 *
 * @author Rui Malemba
 */
interface IGestorServices {
    
    //Método para logar
    public function logar($gestor);
    
    //Método para inserir gestor
    public function inserirGestor($gestor);
    
    //Método para atualizar gestor
    public function atualizarGestor($gestor);
    
     //Método para eliminar gestor
    public function eliminarGestor($gestor);
    
     //Método para listar gestores
    public function listarGestores();
}
