<?php
include 'Config.php';
include 'conn.php';

class Klanten {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getKlanten() {
        try {
            $query = "SELECT klantid, klantnaam, klantemail, klantadres, klantwoonplaats, klantpostcode FROM klanten";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de klanten: " . $e->getMessage();
            return null; // Return null to indicate an error occurred
        }
    }

    public function deleteKlant($klantid) {
        try {
            $query = "DELETE FROM klanten WHERE klantid = :klantid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':klantid', $klantid);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van de klant: " . $e->getMessage();
        }
    }
}

class Artikelen {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getArtikelen() {
        try {
            $query = "SELECT artid, artikelenomschrijving, artinkoop, artverkoop, artvoorraad, artminvoorraad, artmaxvoorraad, artlocatie, levid FROM artikelen";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de artikelen: " . $e->getMessage();
            return null; // Return null to indicate an error occurred
        }
    }

    public function deleteArtikel($artid) {
        try {
            $query = "DELETE FROM artikelen WHERE artid = :artid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':artid', $artid);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van het artikel: " . $e->getMessage();
        }
    }
}

class Leveranciers {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getLeveranciers() {
        try {
            $query = "SELECT levid, levnaam, levcontact, levemail, levadres, levwoonplaats, levpostcode FROM leveranciers";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de leveranciers: " . $e->getMessage();
            return null; // Return null to indicate an error occurred
        }
    }

    public function deleteLeverancier($levid) {
        try {
            $query = "DELETE FROM leveranciers WHERE levid = :levid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':levid', $levid);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van de leverancier: " . $e->getMessage();
        }
    }
}

$klanten = new Klanten($conn);
$klantData = $klanten->getKlanten();

if ($klantData !== null) {
    if (isset($_GET['delete'])) {
        $klantid = $_GET['delete'];
        $klanten->deleteKlant($klantid);
        echo "Klant met ID $klantid is succesvol verwijderd.";
    }

    echo "<h2>Klanten</h2>";
    echo "<table>
            <tr>
                <th>Klant ID</th>
                <th>Klantnaam</th>
                <th>Klant E-mail</th>
                <th>Klantadres</th>
                <th>Klantwoonplaats</th>
                <th>Klantpostcode</th>
                <th>Actie</th>
            </tr>";

    foreach ($klantData as $klant) {
        echo "<tr>
                <td>" . $klant['klantid'] . "</td>
                <td>" . $klant['klantnaam'] . "</td>
                <td>" . $klant['klantemail'] . "</td>
                <td>" . $klant['klantadres'] . "</td>
                <td>" . $klant['klantwoonplaats'] . "</td>
                <td>" . $klant['klantpostcode'] . "</td>
                <td><a href='?delete=" . $klant['klantid'] . "'>Verwijderen</a></td>
            </tr>";
    }

    echo "</table>";
}

$artikelen = new Artikelen($conn);
$artikelData = $artikelen->getArtikelen();

if ($artikelData !== null) {
    if (isset($_GET['delete_artikel'])) {
        $artid = $_GET['delete_artikel'];
        $artikelen->deleteArtikel($artid);
        echo "Artikel met ID $artid is succesvol verwijderd.";
    }

    echo "<h2>Artikelen</h2>";
    echo "<table>
            <tr>
                <th>Artikel ID</th>
                <th>Artikelenomschrijving</th>
                <th>Artinkoop</th>
                <th>Artverkoop</th>
                <th>Artvoorraad</th>
                <th>Artminvoorraad</th>
                <th>Artmaxvoorraad</th>
                <th>Artlocatie</th>
                <th>Leverancier ID</th>
                <th>Actie</th>
            </tr>";

    foreach ($artikelData as $artikel) {
        echo "<tr>
                <td>" . $artikel['artid'] . "</td>
                <td>" . $artikel['artikelenomschrijving'] . "</td>
                <td>" . $artikel['artinkoop'] . "</td>
                <td>" . $artikel['artverkoop'] . "</td>
                <td>" . $artikel['artvoorraad'] . "</td>
                <td>" . $artikel['artminvoorraad'] . "</td>
                <td>" . $artikel['artmaxvoorraad'] . "</td>
                <td>" . $artikel['artlocatie'] . "</td>
                <td>" . $artikel['levid'] . "</td>
                <td><a href='?delete_artikel=" . $artikel['artid'] . "'>Verwijderen</a></td>
            </tr>";
    }

    echo "</table>";
}

$leveranciers = new Leveranciers($conn);
$leverancierData = $leveranciers->getLeveranciers();

if ($leverancierData !== null) {
    if (isset($_GET['delete_leverancier'])) {
        $levid = $_GET['delete_leverancier'];
        $leveranciers->deleteLeverancier($levid);
        echo "Leverancier met ID $levid is succesvol verwijderd.";
    }

    echo "<h2>Leveranciers</h2>";
    echo "<table>
            <tr>
                <th>Leverancier ID</th>
                <th>Leverancier Naam</th>
                <th>Leverancier Contact</th>
                <th>Leverancier E-mail</th>
                <th>Leverancier Adres</th>
                <th>Leverancier Woonplaats</th>
                <th>Leverancier Postcode</th>
                <th>Actie</th>
            </tr>";

    foreach ($leverancierData as $leverancier) {
        echo "<tr>
                <td>" . $leverancier['levid'] . "</td>
                <td>" . $leverancier['levnaam'] . "</td>
                <td>" . $leverancier['levcontact'] . "</td>
                <td>" . $leverancier['levemail'] . "</td>
                <td>" . $leverancier['levadres'] . "</td>
                <td>" . $leverancier['levwoonplaats'] . "</td>
                <td>" . $leverancier['levpostcode'] . "</td>
                <td><a href='?delete_leverancier=" . $leverancier['levid'] . "'>Verwijderen</a></td>
            </tr>";
    }

    echo "</table>";
}
?>
