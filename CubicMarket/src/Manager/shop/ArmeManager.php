<?php

namespace src\Manager\shop;

use src\Entities\user\Utilisateur;

class ArmeManager {
    private $db;
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    public function add(Arme $arme, Utilisateur  $utilisateur)
    {
        if ($utilisateur->getRole() === 'ROLE_ADMIN') {

            $request = "INSERT INTO Weapons (ProductID, Damage, Range) VALUES (:id, :damage, :range)";
            $stmt = $this->db->prepare($request);
            $stmt->execute([
                "id" => $arme->getId(),
                "damage" => $arme->getDegat(),
                "range" => $arme->getDistance()
            ]);
        } else {
            echo "vous n'avez pas les droits";
        }
    }
    public function update(Arme $arme, Utilisateur $utilisateur){
        if ($utilisateur->getRole() === 'ROLE_ADMIN') {
            $request = "UPDATE Products SET ProductID = :idProduct, Damage = :damage, Range = :range WHERE id = :id";
            $stmt = $this->db->prepare($request);
            $stmt->execute([
                "idProduct" => $arme->getId(),
                "damage" => $arme->getDegat(),
                "range" => $arme->getDistance(),
                "id" => $arme->getIdArme()
            ]);
        }
    }
    public function delete(Arme $arme, Utilisateur $utilisateur){
        if ($utilisateur->getRole() === 'ROLE_ADMIN') {
            $request = "DELETE FROM Products WHERE id = :id";
            $stmt = $this->db->prepare($request);
            $stmt->execute([
                "id" => $arme->getIdArme()
            ]);
        } else {
            echo "vous n'avez pas les droits";
        }
    }
    public function getAll(){
        $armes = [];
        $request = "SELECT * FROM Weapons";
        $stmt = $this->db->query($request);
        $dataAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dataAll as $dataOne){
            $arme = new Arme();
            $arme->setIdArme($dataOne['WeaponID']);
            $arme->setDegat($dataOne['Damage']);
            $arme->setRange($dataOne['Range']);
            $armes[] = $arme;
        }
    }
    }


