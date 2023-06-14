<?php

include 'conn.php';
include 'Config.php';

class Order {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getVerkoopOrders() {
        try {
            $query = "SELECT * FROM verkooporders";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de verkooporders: " . $e->getMessage();
            return false;
        }
    }

    public function updateOrder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus) {
        try {
            $query = "UPDATE verkooporders SET
                        artid = :artid,
                        klantid = :klantid,
                        verkorddatum = :verkorddatum,
                        verkordbestaantal = :verkordbestaantal,
                        verkordstatus = :verkordstatus
                    WHERE verkordid = :verkordid";
            $stmt = $this->conn->prepare($query);

            // Loop through the arrays and bind the values
            for ($i = 0; $i < count($verkordid); $i++) {
                $stmt->bindParam(':artid', $artid[$i]);
                $stmt->bindParam(':klantid', $klantid[$i]);
                $stmt->bindParam(':verkorddatum', $verkorddatum[$i]);
                $stmt->bindParam(':verkordbestaantal', $verkordbestaantal[$i]);
                $stmt->bindParam(':verkordstatus', $verkordstatus[$i]);
                $stmt->bindParam(':verkordid', $verkordid[$i]);
                $stmt->execute();
            }

            echo "Order(s) is bijgewerkt.";
            return true;
        } catch(PDOException $e) {
            echo "Fout bij het bijwerken van de order: " . $e->getMessage();
            return false;
        }
    }
}

try {
    $order = new Order($conn);

    // Verkooporders ophalen
    $verkoopOrders = $order->getVerkoopOrders();

    // Order bijwerken
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_all'])) {
        $verkordid = isset($_POST['verkordid']) ? $_POST['verkordid'] : [];
        $artid = isset($_POST['artid']) ? $_POST['artid'] : [];
        $klantid = isset($_POST['klantid']) ? $_POST['klantid'] : [];
        $verkorddatum = isset($_POST['verkorddatum']) ? $_POST['verkorddatum'] : [];
        $verkordbestaantal = isset($_POST['verkordbestaantal']) ? $_POST['verkordbestaantal'] : [];
        $verkordstatus = isset($_POST['verkordstatus']) ? $_POST['verkordstatus'] : [];

        $updated = $order->updateOrder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus);
        if ($updated) {
            // Toon een succesbericht of voer andere acties uit
        }
    }
} catch(Exception $e) {
    echo "Er is een fout opgetreden: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporders beheren</title>
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
    <h1>Verkooporders beheren</h1>
    <form method="post" action="">
        <table>
            <tr>
                <th>Verkooporder ID</th>
                <th>Artikel ID</th>
                <th>Klant ID</th>
                <th>Verkooporder datum</th>
                <th>Verkooporder bestaantal</th>
                <th>Verkooporder status</th>
                <th>Actie</th>
            </tr>
            <?php foreach ($verkoopOrders as $verkoopOrder) { ?>
                <tr>
                    <td><?php echo $verkoopOrder['verkordid']; ?></td>
                    <td>
                        <input type="text" name="artid[]" value="<?php echo $verkoopOrder['artid']; ?>">
                    </td>
                    <td>
                        <input type="text" name="klantid[]" value="<?php echo $verkoopOrder['klantid']; ?>">
                    </td>
                    <td>
                        <input type="date" name="verkorddatum[]" value="<?php echo $verkoopOrder['verkorddatum']; ?>">
                    </td>
                    <td>
                        <input type="text" name="verkordbestaantal[]" value="<?php echo $verkoopOrder['verkordbestaantal']; ?>">
                    </td>
                    <td>
                        <input type="text" name="verkordstatus[]" value="<?php echo $verkoopOrder['verkordstatus']; ?>">
                    </td>
                    <td>
                        <input type="hidden" name="verkordid[]" value="<?php echo $verkoopOrder['verkordid']; ?>">
                    </td>
                </tr>
            <?php } ?>
        </table>
        <input type="submit" name="update_all" value="Alle gegevens bijwerken">
    </form>
</body>
</html>
