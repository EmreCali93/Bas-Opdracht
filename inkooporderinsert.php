<?php
include 'conn.php';
include 'Config.php';

class InkoopOrder extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertInkoopOrder($inkordid, $artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus) {
        $sql = "INSERT INTO inkooporders (inkordid, artid, levid, inkorddatum, inkordbestaantal, inkordstatus)
                VALUES (:inkordid, :artid, :levid, :inkorddatum, :inkordbestaantal, :inkordstatus)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':inkordid', $inkordid);
        $stmt->bindParam(':artid', $artid);
        $stmt->bindParam(':levid', $levid);
        $stmt->bindParam(':inkorddatum', $inkorddatum);
        $stmt->bindParam(':inkordbestaantal', $inkordbestaantal);
        $stmt->bindParam(':inkordstatus', $inkordstatus, PDO::PARAM_INT);
        
        $stmt->execute();
    }
}

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $inkooporder = new InkoopOrder($conn);

    $inkordid = $_POST['inkordid'];
    $artid = $_POST['artid'];
    $levid = $_POST['levid'];
    $inkorddatum = date('Y-m-d');
    $inkordbestaantal = $_POST['inkordbestaantal'];
    $inkordstatus = 1; // Assuming "1" represents "Nieuw" in the database
    
    $inkooporder->insertInkoopOrder($inkordid, $artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus);
    
    echo "<script>alert('Inkooporder: " . $_POST['inkordid'] . " is toegevoegd')</script>";
    echo "<script> location.replace('select.php'); </script>";
}
?>
