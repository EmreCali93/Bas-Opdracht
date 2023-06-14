<?php
include 'conn.php';
include 'Config.php';

class Inkooporder extends Config {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertInkooporder($inkordid, $artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus) {
        $sql = "INSERT INTO inkooporders (inkordid, artid, levid, inkorddatum, inkordbestaantal, inkordstatus)
                VALUES (:inkordid, :artid, :levid, :inkorddatum, :inkordbestaantal, :inkordstatus)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':inkordid', $inkordid);
        $stmt->bindParam(':artid', $artid);
        $stmt->bindParam(':levid', $levid);
        $stmt->bindParam(':inkorddatum', $inkorddatum);
        $stmt->bindParam(':inkordbestaantal', $inkordbestaantal);
        $stmt->bindParam(':inkordstatus', $inkordstatus);

        $stmt->execute();
    }

    public function getLeveranciers() {
        $sql = "SELECT l.levid, l.levnaam FROM leveranciers AS l";
        $result = $this->conn->query($sql);

        $leveranciers = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $leveranciers[$row['levid']] = $row['levnaam'];
        }

        return $leveranciers;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $inkooporder = new Inkooporder($conn);

    $inkordid = $_POST['inkordid'];
    $artid = $_POST['artid'];
    $levid = isset($_POST['levid']) ? $_POST['levid'] : '';
    $inkorddatum = $_POST['inkorddatum'];
    $inkordbestaantal = $_POST['inkordbestaantal'];
    $inkordstatus = $_POST['inkordstatus'];

    $inkooporder->insertInkooporder($inkordid, $artid, $levid, $inkorddatum, $inkordbestaantal, $inkordstatus);

    echo "<script>alert('Inkooporder met ID: " . $_POST['inkordid'] . " is toegevoegd')</script>";
    echo "<script> location.replace('select.php'); </script>";
}

$inkooporder = new Inkooporder($conn);
$leveranciers = $inkooporder->getLeveranciers();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Inkooporder toevoegen</title>
</head>
<body>

    <h1>Inkooporder toevoegen</h1>
    <form method="post" action="">
        <label>Inkooporder ID:</label>
        <input type="text" name="inkordid" required><br><br>

        <label>Artikel ID:</label>
        <input type="text" name="artid" required><br><br>

        <label>Leverancier:</label>
        <select name="levid">
            <option value="">Selecteer leverancier</option>
            <?php foreach ($leveranciers as $levid => $levnaam) { ?>
                <option value="<?php echo $levid; ?>"><?php echo $levnaam; ?></option>
            <?php } ?>
        </select><br><br>

        <label>Inkooporder datum:</label>
        <input type="date" name="inkorddatum" required><br><br>

        <label>Inkooporder bestaantal:</label>
        <input type="text" name="inkordbestaantal" required><br><br>

        <label>Inkooporder status:</label>
        <input type="text" name="inkordstatus" required><br><br>

        <input type="submit" name="insert" value="Toevoegen">
    </form>
</body>
</html>
