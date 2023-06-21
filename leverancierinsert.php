<?php
include 'conn.php';
include 'Config.php';

class Leverancier extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats) {
        $sql = "INSERT INTO leveranciers (levid, levnaam, levcontact, levemail, levadres, levpostcode, levwoonplaats)
                VALUES (:levid, :levnaam, :levcontact, :levemail, :levadres, :levpostcode, :levwoonplaats)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':levid', $levid);
        $stmt->bindParam(':levnaam', $levnaam);
        $stmt->bindParam(':levcontact', $levcontact);
        $stmt->bindParam(':levemail', $levemail);
        $stmt->bindParam(':levadres', $levadres);
        $stmt->bindParam(':levpostcode', $levpostcode);
        $stmt->bindParam(':levwoonplaats', $levwoonplaats);
        
        $stmt->execute();
    }
}

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $leverancier = new Leverancier($conn);

    $levid = $_POST['levid'];
    $levnaam = $_POST['levnaam'];
    $levcontact = $_POST['levcontact'];
    $levemail = $_POST['levemail'];
    $levadres = $_POST['levadres'];
    $levpostcode = $_POST['levpostcode'];
    $levwoonplaats = $_POST['levwoonplaats'];
    
    $leverancier->insertLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats);
    
    echo "<script>alert('Leverancier: " . $_POST['levnaam'] . " is toegevoegd')</script>";
    echo "<script> location.replace('select.php'); </script>";
}
?>
