<?php

/**
 *
 * @author Rui Malemba
 */

interface IClienteServices {

    public function logar($cliente);

    public function inserirCliente($cliente);

    public function atualizarCliente($cliente);

    public function eliminarCliente($cliente);
    
    public function listarClientes();
    
    public function listarClientesNaoAtivados();
}
