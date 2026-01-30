<?php

namespace src\Entities\shop;



class Produit{

    private $id;
    private $nom;
    private $prix;
    private $description;
    private $image;
    private $quantite;


    //Getters
    public function getId()
    { return $this->id; }
    public function getNom()
    { return $this->nom; }
    public function getPrix()
    { return $this->prix; }
    public function getDescription()
    { return $this->description; }
    public function getImage()
    { return $this->image; }
    public function getQuantite()
    { return $this->quantite; }

    // Setters

    public function setId($id) {
        $this->id = $id;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function setPrix($prix) {
        $this->prix = $prix;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }


}
