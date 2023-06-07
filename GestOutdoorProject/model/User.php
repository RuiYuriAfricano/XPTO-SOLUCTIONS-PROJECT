<?php

/**
 * Description of User
 *
 * @author Rui Malemba
 */
abstract class User {
    //Atributos
    private $username;
    private $password_;
    private $telemovel;
    private $email;
    private $fkcomuna;
    private $morada;
    private $fotografia;
    
    //Construtor
    public function __construct($username, $password_, $telemovel, $email, $fkcomuna, $morada, $fotografia) {
        $this->username = $username;
        $this->password_ = $password_;
        $this->telemovel = $telemovel;
        $this->email = $email;
        $this->fkcomuna = $fkcomuna;
        $this->morada = $morada;
        $this->fotografia = $fotografia;
    }

    
    //Getters e setters
    public function getUsername() {
        return $this->username;
    }

    public function getPassword_() {
        return $this->password_;
    }

    public function getTelemovel() {
        return $this->telemovel;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFkcomuna() {
        return $this->fkcomuna;
    }

    public function getMorada() {
        return $this->morada;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword_($password_){
        $this->password_ = $password_;
    }

    public function setTelemovel($telemovel){
        $this->telemovel = $telemovel;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setFkcomuna($fkcomuna){
        $this->fkcomuna = $fkcomuna;
    }

    public function setMorada($morada){
        $this->morada = $morada;
    }
    
    public function getFotografia() {
        return $this->fotografia;
    }

    public function setFotografia($fotografia){
        $this->fotografia = $fotografia;
    }



}
