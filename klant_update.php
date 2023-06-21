<?php

class Klant {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getKlanten() {
        try {
            $query = "SELECT * FROM klanten";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de klanten: " . $e->getMessage();
            return false;
        }
    }

    public function updateKlant($klantid, $klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats) {
        try {
            $query = "UPDATE klanten SET
                        klantnaam = :klantnaam,
                        klantemail = :klantemail,
                        klantadres = :klantadres,
                        klantpostcode = :klantpostcode,
                        klantwoonplaats = :klantwoonplaats
                    WHERE klantid = :klantid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':klantnaam', $klantnaam);
            $stmt->bindParam(':klantemail', $klantemail);
            $stmt->bindParam(':klantadres', $klantadres);
            $stmt->bindParam(':klantpostcode', $klantpostcode);
            $stmt->bindParam(':klantwoonplaats', $klantwoonplaats);
            $stmt->bindParam(':klantid', $klantid);
            $stmt->execute();

            echo "Klant is bijgewerkt.";
            return true;
        } catch(PDOException $e) {
            echo "Fout bij het bijwerken van de klant: " . $e->getMessage();
            return false;
        }
    }
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basdatabase";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $klant = new Klant($conn);

    // Klanten ophalen
    $klanten = $klant->getKlanten();

    // Klant bijwerken
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_all'])) {
        $klantidArray = isset($_POST['klantid']) ? $_POST['klantid'] : [];
        $klantnaamArray = isset($_POST['klantnaam']) ? $_POST['klantnaam'] : [];
        $klantemailArray = isset($_POST['klantemail']) ? $_POST['klantemail'] : [];
        $klantadresArray = isset($_POST['klantadres']) ? $_POST['klantadres'] : [];
        $klantpostcodeArray = isset($_POST['klantpostcode']) ? $_POST['klantpostcode'] : [];
        $klantwoonplaatsArray = isset($_POST['klantwoonplaats']) ? $_POST['klantwoonplaats'] : [];

        foreach ($klantidArray as $index => $klantid) {
            $klantnaam = $klantnaamArray[$index];
            $klantemail = $klantemailArray[$index];
            $klantadres = $klantadresArray[$index];
            $klantpostcode = $klantpostcodeArray[$index];
            $klantwoonplaats = $klantwoonplaatsArray[$index];

            $updated = $klant->updateKlant($klantid, $klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats);
            if ($updated) {
                // Toon een succesbericht of voer andere acties uit
            }
        }
    }
} catch(PDOException $e) {
    echo "Er is een fout opgetreden: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Klanten beheren</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Klanten beheren</h1>
    <form method="post" action="">
        <table>
            <tr>
                <th>Klant ID</th>
                <th>Klantnaam</th>
                <th>Klantemail</th>
                <th>Klantadres</th>
                <th>Klantpostcode</th>
                <th>Klantwoonplaats</th>
                <th>Actie</th>
            </tr>
            <?php foreach ($klanten as $klant) { ?>
                <tr>
                    <td><?php echo $klant['klantid']; ?></td>
                    <td>
                        <input type="text" name="klantnaam[]" value="<?php echo $klant['klantnaam']; ?>">
                    </td>
                    <td>
                        <input type="text" name="klantemail[]" value="<?php echo $klant['klantemail']; ?>">
                    </td>
                    <td>
                        <input type="text" name="klantadres[]" value="<?php echo $klant['klantadres']; ?>">
                    </td>
                    <td>
                        <input type="text" name="klantpostcode[]" value="<?php echo $klant['klantpostcode']; ?>">
                    </td>
                    <td>
                        <input type="text" name="klantwoonplaats[]" value="<?php echo $klant['klantwoonplaats']; ?>">
                    </td>
                    <td>
                        <input type="hidden" name="klantid[]" value="<?php echo $klant['klantid']; ?>">
                    </td>
                </tr>
            <?php } ?>
        </table>
        <input type="submit" name="update_all" value="Alle gegevens bijwerken">
    </form>
    <a href="index.php">Homepage</a>
</body>
</html>
