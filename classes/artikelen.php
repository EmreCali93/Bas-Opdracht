<?php

class Artikelen {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getArtikelen() {
        try {
            $query = "SELECT artid, artikelenomschrijving, artinkoop, artverkoop, artvoorraad, artminvoorraad, artmaxvoorraad, levid, artlocatie FROM artikelen";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de artikelen: " . $e->getMessage();
        }
    }

}

?>