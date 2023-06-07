<?php

/**
 *
 * @author Total Energies
 */
require_once 'IUserRepositories.php';
interface IClienteRepositories extends IUserRepositories {
    
    //Método para inserir cliente
    public function inserirCliente($cliente);
    
    //Método para atualizar cliente
    public function atualizarCliente($cliente);
    
    //Método para eliminar cliente
    public function eliminarCliente($cliente);
    
    //Método para listar clientes
    public function listarClientes();
    
    //Método para listar clientes
    public function listarClientesNaoAtivados();
}
