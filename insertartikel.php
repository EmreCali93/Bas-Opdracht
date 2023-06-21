<?php
include 'conn.php';
include 'Config.php';

class Artikel extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertArtikel($artid, $omschrijving, $inkoop, $verkoop, $voorraad, $minvoorraad, $maxvoorraad, $locatie, $levid) {
        $sql = "INSERT INTO artikelen (artid, artikelenomschrijving, artinkoop, artverkoop, artvoorraad, artminvoorraad, artmaxvoorraad, artlocatie, levid)
                VALUES (:artid, :omschrijving, :inkoop, :verkoop, :voorraad, :minvoorraad, :maxvoorraad, :locatie, :levid)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':artid', $artid);
        $stmt->bindParam(':omschrijving', $omschrijving);
        $stmt->bindParam(':inkoop', $inkoop);
        $stmt->bindParam(':verkoop', $verkoop);
        $stmt->bindParam(':voorraad', $voorraad);
        $stmt->bindParam(':minvoorraad', $minvoorraad);
        $stmt->bindParam(':maxvoorraad', $maxvoorraad);
        $stmt->bindParam(':locatie', $locatie);
        $stmt->bindParam(':levid', $levid);
        
        $stmt->execute();
    }
}

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $artikel = new Artikel($conn);

    $id = $_POST['artid'];
    $omschrijving = $_POST['artomschrijving'];
    $inkoop = $_POST['artinkoop'];
    $verkoop = $_POST['artverkoop'];
    $voorraad = $_POST['artvoorraad'];
    $minvoorraad = $_POST['artminvoorraad'];
    $maxvoorraad = $_POST['artmaxvoorraad'];
    $locatie = $_POST['artlocatie'];
    $levid = $_POST['levid'];
    
    $artikel->insertArtikel($id, $omschrijving, $inkoop, $verkoop, $voorraad, $minvoorraad, $maxvoorraad, $locatie, $levid);
    
    echo "<script>alert('Artikel: " . $_POST['artomschrijving'] . " is toegevoegd')</script>";
    echo "<script> location.replace('select.php'); </script>";
}
?>
