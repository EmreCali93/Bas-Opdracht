<?php
include 'Config.php';
include 'conn.php';

class Verkooporder {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getVerkoopordersByKlantId($klantid) {
        try {
            $query = "SELECT v.verkordid, v.artid, v.klantid, v.verkorddatum, v.verkordbestaantal, v.verkordstatus, a.artikelenomschrijving
                      FROM verkooporders v
                      INNER JOIN artikelen a ON v.artid = a.artId
                      WHERE v.klantid = :klantid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':klantid', $klantid);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de verkooporders: " . $e->getMessage();
        }
    }

    public function getKlanten() {
        try {
            $query = "SELECT klantId, klantNaam FROM klanten";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de klanten: " . $e->getMessage();
        }
    }

}

$verkooporder = new Verkooporder($conn);

// Zoekbalk logica
if (isset($_POST['search'])) {
    $klantid = $_POST['klantid'] ?? '';
    $verkooporders = $verkooporder->getVerkoopordersByKlantId($klantid);

    if (!empty($verkooporders)) {
        echo "<table>
                <tr>
                    <th>Verkooporder ID</th>
                    <th>Artikel ID</th>
                    <th>Klant ID</th>
                    <th>Verkoopdatum</th>
                    <th>Besteld aantal</th>
                    <th>Status</th>
                    <th>Artikelomschrijving</th>
                </tr>";
       
        foreach ($verkooporders as $verkooporderData) {
            echo "<tr>
                    <td>" . $verkooporderData['verkordid'] . "</td>
                    <td>" . $verkooporderData['artid'] . "</td>
                    <td>" . $verkooporderData['klantid'] . "</td>
                    <td>" . $verkooporderData['verkorddatum'] . "</td>
                    <td>" . $verkooporderData['verkordbestaantal'] . "</td>
                    <td>" . $verkooporderData['verkordstatus'] . "</td>
                    <td>" . $verkooporderData['artikelenomschrijving'] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Geen verkooporders gevonden voor de geselecteerde klant.";
    }
}

// Klanten ophalen voor het dropdown-menu
$klanten = $verkooporder->getKlanten();
?>

<!DOCTYPE html>
<html>
<body>
    <form method="POST" action="">
        <label for="klantid">Klant:</label>
        <select name="klantid" id="klantid" required>
            <?php foreach ($klanten as $klant) { ?>
                <option value="<?php echo $klant['klantId']; ?>"><?php echo $klant['klantNaam']; ?></option>
            <?php } ?>
        </select>
        <br>
        <input type="submit" name="search" value="Zoeken">
    </form>
</body>
</html>