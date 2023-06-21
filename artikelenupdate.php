<?php

include 'conn.php';
include 'Config.php';

class Artikel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getArtikelen() {
        try {
            $query = "SELECT * FROM artikelen";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de artikelen: " . $e->getMessage();
            return false;
        }
    }

    public function updateArtikel($artid, $omschrijving, $inkoop, $verkoop, $voorraad, $minVoorraad, $maxVoorraad, $locatie, $leverancierId) {
        try {
            $query = "UPDATE artikelen SET
                        artikelenomschrijving = :omschrijving,
                        artinkoop = :inkoop,
                        artverkoop = :verkoop,
                        artvoorraad = :voorraad,
                        artminvoorraad = :minVoorraad,
                        artmaxvoorraad = :maxVoorraad,
                        artlocatie = :locatie,
                        levid = :leverancierId
                    WHERE artid = :artid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':omschrijving', $omschrijving);
            $stmt->bindParam(':inkoop', $inkoop);
            $stmt->bindParam(':verkoop', $verkoop);
            $stmt->bindParam(':voorraad', $voorraad);
            $stmt->bindParam(':minVoorraad', $minVoorraad);
            $stmt->bindParam(':maxVoorraad', $maxVoorraad);
            $stmt->bindParam(':locatie', $locatie);
            $stmt->bindParam(':leverancierId', $leverancierId);
            $stmt->bindParam(':artid', $artid);
            $stmt->execute();

            echo "Artikel is bijgewerkt.";
            return true;
        } catch(PDOException $e) {
            echo "Fout bij het bijwerken van het artikel: " . $e->getMessage();
            return false;
        }
    }
}

try {
    $artikel = new Artikel($conn);

    // Artikelen ophalen
    $artikelen = $artikel->getArtikelen();

    // Artikel bijwerken
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_all'])) {
        $artids = isset($_POST['artid']) ? $_POST['artid'] : [];
        $omschrijving = isset($_POST['artikelenomschrijving']) ? $_POST['artikelenomschrijving'] : [];
        $inkoop = isset($_POST['artinkoop']) ? $_POST['artinkoop'] : [];
        $verkoop = isset($_POST['artverkoop']) ? $_POST['artverkoop'] : [];
        $voorraad = isset($_POST['artvoorraad']) ? $_POST['artvoorraad'] : [];
        $minVoorraad = isset($_POST['artminvoorraad']) ? $_POST['artminvoorraad'] : [];
        $maxVoorraad = isset($_POST['artmaxvoorraad']) ? $_POST['artmaxvoorraad'] : [];
        $locatie = isset($_POST['artlocatie']) ? $_POST['artlocatie'] : [];
        $leverancierId = isset($_POST['levid']) ? $_POST['levid'] : [];

        for ($i = 0; $i < count($artids); $i++) {
            $artid = $artids[$i];
            $omschr = $omschrijving[$i];
            $ink = $inkoop[$i];
            $verk = $verkoop[$i];
            $vorr = $voorraad[$i];
            $minVorr = $minVoorraad[$i];
            $maxVorr = $maxVoorraad[$i];
            $loc = $locatie[$i];
            $levId = $leverancierId[$i];

            $updated = $artikel->updateArtikel($artid, $omschr, $ink, $verk, $vorr, $minVorr, $maxVorr, $loc, $levId);
            if ($updated) {
                // Toon een succesbericht of voer andere acties uit
            }
        }
    }
} catch(Exception $e) {
    echo "Er is een fout opgetreden: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Artikelen beheren</title>
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
    <h1>Artikelen beheren</h1>
    <form method="post" action="">
        <table>
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
            </tr>
            <?php foreach ($artikelen as $artikel) { ?>
                <tr>
                    <td><?php echo $artikel['artid']; ?></td>
                    <td>
                        <input type="text" name="artikelenomschrijving[]" value="<?php echo $artikel['artikelenomschrijving']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artinkoop[]" value="<?php echo $artikel['artinkoop']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artverkoop[]" value="<?php echo $artikel['artverkoop']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artvoorraad[]" value="<?php echo $artikel['artvoorraad']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artminvoorraad[]" value="<?php echo $artikel['artminvoorraad']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artmaxvoorraad[]" value="<?php echo $artikel['artmaxvoorraad']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artlocatie[]" value="<?php echo $artikel['artlocatie']; ?>">
                    </td>
                    <td>
                        <input type="text" name="levid[]" value="<?php echo $artikel['levid']; ?>">
                    </td>
                    <td>
                        <input type="hidden" name="artid[]" value="<?php echo $artikel['artid']; ?>">
                    </td>
                </tr>
            <?php } ?>
        </table>
        <input type="submit" name="update_all" value="Alle gegevens bijwerken">
    </form>
    <a href="index.php">Homepage</a>
</body>
</html>
