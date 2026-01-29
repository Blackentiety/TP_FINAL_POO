<?php
namespace src\Entities\shop;

class Arme extends Produit
{
    private $idArme;
    private $nomArme;
    private $degat;
    private $distance;


    public function getIdArme()
    {
        return $this->idArme;
    }
    public function getNomArme(){
        return $this->nomArme;
    }
    public function getDegat(){
        return $this->degat;
    }
    public function getDistance(){
        return $this->distance;
    }
    public function setIdArme($idArme){
        $this->idArme = $idArme;
    }
    public function setNomArme($nomArme){
        $this->nomArme = $nomArme;
    }
    public function setDegat($degat){
        $this->degat = $degat;
    }
    public function setDistance($distance){
        $this->distance = $distance;
    }

}
