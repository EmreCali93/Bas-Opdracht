<?php
include 'Config.php';
include 'conn.php';

class Klanten {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getKlanten($searchTerm = '') {
        try {
            $query = "SELECT klantid, klantnaam, klantemail, klantadres, klantwoonplaats, klantpostcode FROM klanten WHERE klantid = :searchTerm";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':searchTerm', $searchTerm);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de klanten: " . $e->getMessage();
            return null; // Return null to indicate an error occurred
        }
    }
}

$klanten = new Klanten($conn);
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$klantData = $klanten->getKlanten($searchTerm);

if ($klantData !== null) {
    echo "<form method='GET' action=''>
            <input type='text' name='search' placeholder='Zoek klant ID' value='$searchTerm' />
            <button type='submit'>Zoeken</button>
        </form>";

    echo "<table>
            <tr>
                <th>Klant ID</th>
                <th>Klantnaam</th>
                <th>Klant E-mail</th>
                <th>Klantadres</th>
                <th>Klantwoonplaats</th>
                <th>Klantpostcode</th>
            </tr>";

    foreach ($klantData as $klant) {
        echo "<tr>
                <td>" . $klant['klantid'] . "</td>
                <td>" . $klant['klantnaam'] . "</td>
                <td>" . $klant['klantemail'] . "</td>
                <td>" . $klant['klantadres'] . "</td>
                <td>" . $klant['klantwoonplaats'] . "</td>
                <td>" . $klant['klantpostcode'] . "</td>
            </tr>";
    }

    echo "</table>";
}
?>
<!DOCTYPE html>
<html>
<body>
    <a href="index.php">Homepage</a>
</body>
</html>