<?php
include 'Config.php';
include 'conn.php';

class Verkooporder {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getVerkoopordersByCriteria($klantid, $artikelid) {
        try {
            $query = "SELECT v.verkordid, v.artid, v.klantid, v.verkorddatum, v.verkordbestaantal, v.verkordstatus, a.artikelenomschrijving
                      FROM verkooporders v
                      INNER JOIN artikelen a ON v.artid = a.artId
                      WHERE (:klantid IS NULL OR v.klantid = :klantid)
                      AND (:artikelid IS NULL OR v.artid = :artikelid)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':klantid', $klantid);
            $stmt->bindParam(':artikelid', $artikelid);
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

    public function getArtikelen() {
        try {
            $query = "SELECT artId, artikelenomschrijving FROM artikelen";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de artikelen: " . $e->getMessage();
        }
    }

}

$verkooporder = new Verkooporder($conn);

// Zoekbalk logica
if (isset($_POST['search'])) {
    $klantid = $_POST['klantid'] ?? null;
    $artikelid = $_POST['artikelid'] ?? null;
    $verkooporders = $verkooporder->getVerkoopordersByCriteria($klantid, $artikelid);

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
        echo "Geen verkooporders gevonden voor de geselecteerde criteria.";
    }
}

// Klanten en artikelen ophalen voor de dropdown-menu's
$klanten = $verkooporder->getKlanten();
$artikelen = $verkooporder->getArtikelen();
?>

<!DOCTYPE html>
<html>
<body>
    <form method="POST" action="">
        <label for="klantid">Klant:</label>
        <select name="klantid" id="klantid">
            <option value="">Alle klanten</option>
            <?php foreach ($klanten as $klant) { ?>
                <option value="<?php echo $klant['klantId']; ?>"><?php echo $klant['klantNaam']; ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="artikelid">Artikel:</label>
        <select name="artikelid" id="artikelid">
            <option value="">Alle artikelen</option>
            <?php foreach ($artikelen as $artikel) { ?>
                <option value="<?php echo $artikel['artId']; ?>"><?php echo $artikel['artikelenomschrijving']; ?></option>
            <?php } ?>
        </select>
        <br>
        <input type="submit" name="search" value="Zoeken">
    </form>
</body>
</html>
