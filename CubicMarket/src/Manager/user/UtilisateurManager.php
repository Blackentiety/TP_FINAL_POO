<?php

namespace src\Manager\user;
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
            $utilisateurAll[] = $utilisateur;

        }

    }

    public function deleteUtilisateur($id){
        $request = "DELETE FROM Users WHERE UserId = :id";
        $stmt = $this->db->prepare($request);
        $stmt->execute([
            'id' => $id
        ]);
    }

    public function updateUtilisateur(Utilisateur $utilisateur, $rank){
        $id = $utilisateur->getId();
        $request = "UPDATE Users SET Rank = :rank WHERE UserId = :id";
        $stmt = $this->db->prepare($request);
        $stmt->execute([
            'rank' => $rank,
        ]);

    }

    public function login(string $email, string $passwordSaisi)
    {
        $req = $this->db->prepare("SELECT * FROM Users WHERE email = :email");
        $req->execute(['email' => $email]);
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if ($data && password_verify($passwordSaisi, $data['PasswordHash'])) {
            return $data;
        } else {
            return false;
        }
    }


}