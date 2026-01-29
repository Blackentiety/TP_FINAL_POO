<?php

class UtilisateurManager{
    private $db;
    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function addUtilisateur($utilisateur){
        $request = "INSERT INTO Users (Username, PasswordHash, email) VALUES (:pseudo, :password, :email)";
        $stmt = $this->db->prepare($request);
        $stmt->execute([
            'pseudo'=> $utilisateur->getUsername(),
            'password' => $utilisateur->getPassword(),
            'email' => $utilisateur->getEmail()
        ]);
    }

    public function getAll(){
        $utilisateurAll = [];
        $request = "SELECT * FROM Users";
        $stmt = $this->db->query($request);
        $dataAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dataAll as $dataOne){
            $utilisateur = new Utilisateur();
            $utilisateur->setId($dataOne['UserId']);
            $utilisateur->setUsername($dataOne['Username']);
            $utilisateur->setEmail($dataOne['Email']);
            $utilisateur->setRole($dataOne['Rank']);

        }

    }


}