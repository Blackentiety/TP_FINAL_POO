<?php
namespace src\Entities\shop;
class Grade extends Produit {
    private $idGrade;
    private $nomGrade;
    private $privilege;

    public function getIdGrade() {
        return $this->idGrade;
    }
    public function getNomGrade() {
        return $this->nomGrade;
    }
    public function getPrivilege() {
        return $this->privilege;
    }
    public function setIdGrade($idGrade) {
        $this->idGrade = $idGrade;
    }
    public function setNomGrade($nomGrade) {
        $this->nomGrade = $nomGrade;
    }
    public function setPrivilege($privilege) {
        $this->privilege = $privilege;
    }
}