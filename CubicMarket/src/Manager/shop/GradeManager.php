<?php

namespace src\Manager\shop;

class GradeManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createGrade(Grade $grade, Utilisateur  $utilisateur) {
        if ($utilisateur->getRole() === 'ROLE_ADMIN') {
            $request = "INSERT INTO Rank VALUES (:name, :Privilege, :idProduit)";
            $stmt = $this->db->prepare($request);
            $stmt->execute([
                "name" => $grade->getNom(),
                "privilege" => $grade->getPrivilege(),
                "idProduit" => $grade->getId()
            ]);
        } else {
            echo "commande non autorisé";
        }
    }

    public function getGrades() {
        $grades = [];
        $request = "SELECT * FROM Rank";
        $stmt = $this->db->prepare($request);
        $dataAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dataAll as $dataOne) {
            $grade = new Grade();
            $grade->setId($dataOne['RankID']);
            $grade->setNom($dataOne['RankName']);
            $grade->setPrix($dataOne['Privileges']);
            $grades[] = $grade;
        }

    }

    public function updateGrade(Grade $grade, Utilisateur $utilisateur) {
        if ($utilisateur->getRole() === 'ROLE_ADMIN') {
            $request = "UPDATE Rank SET RankName = :name, privilege = :privilege WHERE id = :idRank";
            $stmt = $this->db->prepare($request);
            $stmt->execute([
                "name" => $grade->getNomGrade(),
                "privilege" => $grade->getPrivilege(),
                "idRank" => $grade->getIdGrade()
            ]);
        }
    }

    public function deleteGrade(Grade $grade, Utilisateur $utilisateur) {
        if ($utilisateur->getRole() === 'ROLE_ADMIN') {
            $request = "DELETE FROM Rank WHERE id = :idRank";
            $stmt = $this->db->prepare($request);
            $stmt->execute([
                "idRank" => $grade->getIdGrade()
            ]);
        }
    }


}