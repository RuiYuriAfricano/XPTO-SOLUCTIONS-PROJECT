<?php

/**
 *
 * @author Rui Malemba
 */
interface ISolicitaAluguerRepositories {
    
    //Método para solicitar
    public function solicitarAlguer($solicitaAlguer);
    
    //Método para atualizar solicitação
    public function atualizarSolicitacao($solicitaAlguer);
    
    //Método para eliminar solicitação
    public function eliminarSolicitacao($solicitaAlguer);
    
    //Método para listar solicitações
    public function listarSolicitacoes();
}
