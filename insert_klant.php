<?php
include 'conn.php';
include 'Config.php';

class Klant extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertKlant($klantid, $klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        $sql = "INSERT INTO klanten (klantid, klantnaam, klantemail, klantadres, klantpostcode, klantwoonplaats)
                VALUES (:klantid, :klantnaam, :klantemail, :klantadres, :klantpostcode, :klantwoonplaats)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':klantid', $klantid);
        $stmt->bindParam(':klantnaam', $klantnaam);
        $stmt->bindParam(':klantemail', $klantemail);
        $stmt->bindParam(':klantadres', $klantadres);
        $stmt->bindParam(':klantpostcode', $klantpostcode);
        $stmt->bindParam(':klantwoonplaats', $klantwoonplaats);
        
        $stmt->execute();
    }
}

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $klant = new Klant($conn);

    $id = $_POST['klantid'];
    $naam = $_POST['klantnaam'];
    $email = $_POST['klantemail'];
    $adres = $_POST['klantadres'];
    $postcode = $_POST['klantpostcode'];
    $woonplaats = $_POST['klantwoonplaats'];
    
    $klant->insertKlant($id, $naam, $email, $adres, $postcode, $woonplaats);
    
    echo "<script>alert('Klant: " . $_POST['klantnaam'] . " is toegevoegd')</script>";
    echo "<script> location.replace('select.php'); </script>";
}
?>
