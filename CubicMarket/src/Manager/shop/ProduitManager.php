<?php

class ProduitManager {
    private $db;
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    public function add(Produit $produit)
    {
        $request = "INSERT INTO Products () VALUES (:desc)";
        $stmt = $this->db->prepare($request);
        $stmt->execute([
            "desc" => $produit->getDescription()
        ]);
    }


