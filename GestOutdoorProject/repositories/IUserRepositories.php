<?php

/**
 *
 * @author Rui Malemba
 */

interface IUserRepositories {
    
    //Método para entrar no sistema como cliente ou gestor
    public function logar($user);
    
}
