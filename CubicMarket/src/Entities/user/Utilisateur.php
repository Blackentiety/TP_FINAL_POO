<?php

namespace src\Entities\user;
class Utilisateur {
    private $id;
    private $username;
    private $password;
    private $email;
    private $rank;
    private $role;

//    Getters
    public function getId(){
        return $this->id;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getRank(){
        return $this->rank;
    }
    public function getRole(){
        return $this->role;
    }

//    Setters
    public function setId($id){
        $this->id = $id;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function setPassword($password){
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setRank($rank){
        $this->rank = $rank;
    }
    public function setRole($role){
        $this->role = $role;
    }
}