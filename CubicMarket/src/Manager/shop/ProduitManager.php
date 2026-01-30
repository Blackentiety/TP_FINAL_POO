<?php

namespace src\Manager\shop;

use src\Entities\shop\Produit;

class ProduitManager {
    private $db;
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    public function add(Produit $produit, Utilisateur  $utilisateur)
    {
        if ($utilisateur->getRole() === 'ROLE_ADMIN') {

            $request = "INSERT INTO Products (ProductName, Description, Image, Price, Stock) VALUES (:name, :desc, :image, :price, :stock)";
            $stmt = $this->db->prepare($request);
            $stmt->execute([
                "name" => $produit->getNom(),
                "desc" => $produit->getDescription(),
                "image" => $produit->getImage(),
                "price" => $produit->getPrix(),
                "stock" => $produit->getQuantite()
            ]);

        } else {
            echo "vous n'avez pas les droits";
        }
    }
    public function update(Produit $produit, Utilisateur $utilisateur){
        if ($utilisateur->getRole() === 'ROLE_ADMIN') {
            $request = "UPDATE Products SET ProductName = :name, Description = :desc, Image = :image, Price = :prix, Stock = :stock WHERE id = :id";
            $stmt = $this->db->prepare($request);
            $stmt->execute([
                "name" => $produit->getNom(),
                "desc" => $produit->getDescription(),
                "image" => $produit->getImage(),
                "price" => $produit->getPrix(),
                "stock" => $produit->getQuantite(),
                "id" => $produit->getId()
            ]);
        }
    }
    public function delete(Produit $produit){
        $request = "DELETE FROM Products WHERE id = :id";
        $stmt = $this->db->prepare($request);
        $stmt->execute([
            "id" => $produit->getId()
        ]);
    }
    public function getAll(){
        $produits = [];
        $request = "SELECT * FROM Products";
        $stmt = $this->db->query($request);
        $dataAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dataAll as $dataOne){
            $produit = new Produit();
            $produit->setId($dataOne['id']);
            $produit->setNom($dataOne['ProductName']);
            $produit->setDescription($dataOne['Description']);
            $produit->setImage($dataOne['Image']);
            $produit->setPrix($dataOne['Price']);
            $produit->setQuantite($dataOne['Stock']);
            $produits[] = $produit;
        }
    }
    }


