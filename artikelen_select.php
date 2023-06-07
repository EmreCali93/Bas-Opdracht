<?php
include 'Config.php';
include 'conn.php';

class Artikelen {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getArtikelen() {
        try {
            $query = "SELECT artid, artikelenomschrijving, artinkoop, artverkoop, artvoorraad, artminvoorraad, artmaxvoorraad, levid, artlocatie FROM artikelen";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de artikelen: " . $e->getMessage();
        }
    }

}

$artikelen = new Artikelen($conn);

$artikelData = $artikelen->getArtikelen();

echo "<table>
        <tr>
            <th>Artikel ID</th>
            <th>Artikelomschrijving</th>
            <th>Inkoopprijs</th>
            <th>Verkoopprijs</th>
            <th>Voorraad</th>
            <th>Minimale Voorraad</th>
            <th>Maximale Voorraad</th>
            <th>Leverancier ID</th>
            <th>Locatie</th>
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
            <td>" . $artikel['levid'] . "</td>
            <td>" . $artikel['artlocatie'] . "</td>
        </tr>";
}

echo "</table>";
?>
