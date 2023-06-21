<?php

class Leverancier {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getLeveranciers() {
        try {
            $query = "SELECT * FROM leveranciers";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de leveranciers: " . $e->getMessage();
            return false;
        }
    }

    public function updateLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats) {
        try {
            $query = "UPDATE leveranciers SET
                        levnaam = :levnaam,
                        levcontact = :levcontact,
                        levemail = :levemail,
                        levadres = :levadres,
                        levpostcode = :levpostcode,
                        levwoonplaats = :levwoonplaats
                    WHERE levid = :levid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':levnaam', $levnaam);
            $stmt->bindParam(':levcontact', $levcontact);
            $stmt->bindParam(':levemail', $levemail);
            $stmt->bindParam(':levadres', $levadres);
            $stmt->bindParam(':levpostcode', $levpostcode);
            $stmt->bindParam(':levwoonplaats', $levwoonplaats);
            $stmt->bindParam(':levid', $levid);
            $stmt->execute();

            echo "Leverancier is bijgewerkt.";
            return true;
        } catch(PDOException $e) {
            echo "Fout bij het bijwerken van de leverancier: " . $e->getMessage();
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

    $leverancier = new Leverancier($conn);

    // Leveranciers ophalen
    $leveranciers = $leverancier->getLeveranciers();

    // Leverancier bijwerken
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_all'])) {
        $levidArray = isset($_POST['levid']) ? $_POST['levid'] : [];
        $levnaamArray = isset($_POST['levnaam']) ? $_POST['levnaam'] : [];
        $levcontactArray = isset($_POST['levcontact']) ? $_POST['levcontact'] : [];
        $levemailArray = isset($_POST['levemail']) ? $_POST['levemail'] : [];
        $levadresArray = isset($_POST['levadres']) ? $_POST['levadres'] : [];
        $levpostcodeArray = isset($_POST['levpostcode']) ? $_POST['levpostcode'] : [];
        $levwoonplaatsArray = isset($_POST['levwoonplaats']) ? $_POST['levwoonplaats'] : [];

        foreach ($levidArray as $index => $levid) {
            $levnaam = $levnaamArray[$index];
            $levcontact = $levcontactArray[$index];
            $levemail = $levemailArray[$index];
            $levadres = $levadresArray[$index];
            $levpostcode = $levpostcodeArray[$index];
            $levwoonplaats = $levwoonplaatsArray[$index];

            $updated = $leverancier->updateLeverancier($levid, $levnaam, $levcontact, $levemail, $levadres, $levpostcode, $levwoonplaats);
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
    <title>Leveranciers beheren</title>
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
    <h1>Leveranciers beheren</h1>
    <form method="post" action="">
        <table>
            <tr>
                <th>Leverancier ID</th>
                <th>Leverancier naam</th>
                <th>Leverancier contact</th>
                <th>Leverancier email</th>
                <th>Leverancier adres</th>
                <th>Leverancier postcode</th>
                <th>Leverancier woonplaats</th>
                <th>Actie</th>
            </tr>
            <?php foreach ($leveranciers as $leverancier) { ?>
                <tr>
                    <td><?php echo $leverancier['levid']; ?></td>
                    <td>
                        <input type="text" name="levnaam[]" value="<?php echo $leverancier['levnaam']; ?>">
                    </td>
                    <td>
                        <input type="text" name="levcontact[]" value="<?php echo $leverancier['levcontact']; ?>">
                    </td>
                    <td>
                        <input type="text" name="levemail[]" value="<?php echo $leverancier['levemail']; ?>">
                    </td>
                    <td>
                        <input type="text" name="levadres[]" value="<?php echo $leverancier['levadres']; ?>">
                    </td>
                    <td>
                        <input type="text" name="levpostcode[]" value="<?php echo $leverancier['levpostcode']; ?>">
                    </td>
                    <td>
                        <input type="text" name="levwoonplaats[]" value="<?php echo $leverancier['levwoonplaats']; ?>">
                    </td>
                    <td>
                        <input type="hidden" name="levid[]" value="<?php echo $leverancier['levid']; ?>">
                    </td>
                </tr>
            <?php } ?>
        </table>
        <input type="submit" name="update_all" value="Alle gegevens bijwerken">
    </form>
    <a href="index.php">Homepage</a>
</body>
</html>
