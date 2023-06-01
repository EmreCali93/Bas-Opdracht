<?php
include 'conn.php';
include 'Config.php';

class Verkooporder extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertVerkooporder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus) {
        $sql = "INSERT INTO verkooporders (verkordid, artid, klantid, verkorddatum, verkordbestaantal, verkordstatus)
                VALUES (:verkordid, :artid, :klantid, :verkorddatum, :verkordbestaantal, :verkordstatus)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':verkordid', $verkordid);
        $stmt->bindParam(':artid', $artid);
        $stmt->bindParam(':klantid', $klantid);
        $stmt->bindParam(':verkorddatum', $verkorddatum);
        $stmt->bindParam(':verkordbestaantal', $verkordbestaantal);
        $stmt->bindParam(':verkordstatus', $verkordstatus);

        $stmt->execute();
    }
}

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $verkooporder = new Verkooporder($conn);

    $verkordid = $_POST['verkordid'];
    $artid = $_POST['artid'];
    $klantid = $_POST['klantid'];
    $verkorddatum = $_POST['verkorddatum'];
    $verkordbestaantal = $_POST['verkordbestaantal'];
    $verkordstatus = $_POST['verkordstatus'];

    $verkooporder->insertVerkooporder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus);

    echo "<script>alert('Verkooporder met ID: " . $_POST['verkordid'] . " is toegevoegd')</script>";
    echo "<script> location.replace('select.php'); </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder toevoegen</title>
</head>
<body>

    <h1>Verkooporder toevoegen</h1>
    <form method="post" action="">
        <label>Verkooporder ID:</label>
        <input type="text" name="verkordid" required><br><br>

        <label>Artikel ID:</label>
        <input type="text" name="artid" required><br><br>

        <label>Klant ID:</label>
        <input type="text" name="klantid" required><br><br>

        <label>Verkooporder datum:</label>
        <input type="text" name="verkorddatum" required><br><br>

        <label>Verkooporder bestaantal:</label>
        <input type="text" name="verkordbestaantal" required><br><br>

        <label>Verkooporder status:</label>
        <input type="text" name="verkordstatus" required><br><br>

        <input type="submit" name="insert" value="Toevoegen">
    </form>
</body>
</html>
