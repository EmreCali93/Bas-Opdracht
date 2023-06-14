<?php
include 'Config.php';
include 'conn.php';

class InkoopOrders {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getInkoopOrders() {
        try {
            $query = "SELECT inkordid, artid, levid, inkorddatum, inkordbestaantal, inkordstatus FROM inkooporders";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de inkooporders: " . $e->getMessage();
            return null; // Return null to indicate an error occurred
        }
    }

    public function deleteInkoopOrder($inkordid) {
        try {
            $query = "DELETE FROM inkooporders WHERE inkordid = :inkordid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':inkordid', $inkordid);
            $stmt->execute();
            return true; // Deletion successful
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van de inkooporder: " . $e->getMessage();
            return false; // Deletion failed
        }
    }
}

class VerkoopOrders {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getVerkoopOrders() {
        try {
            $query = "SELECT verkordid, artid, klantid, verkorddatum, verkordbestaantal, verkordstatus FROM verkooporders";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Fout bij het ophalen van de verkooporders: " . $e->getMessage();
            return null; // Return null to indicate an error occurred
        }
    }

    public function deleteVerkoopOrder($verkordid) {
        try {
            $query = "DELETE FROM verkooporders WHERE verkordid = :verkordid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':verkordid', $verkordid);
            $stmt->execute();
            return true; // Deletion successful
        } catch(PDOException $e) {
            echo "Fout bij het verwijderen van de verkooporder: " . $e->getMessage();
            return false; // Deletion failed
        }
    }
}

$inkoopOrders = new InkoopOrders($conn);
$verkoopOrders = new VerkoopOrders($conn);

$inkoopOrderData = $inkoopOrders->getInkoopOrders();
$verkoopOrderData = $verkoopOrders->getVerkoopOrders();

if ($inkoopOrderData !== null) {
    echo "<h3>Inkooporders</h3>";

    echo "<table>
            <tr>
                <th>Inkooporder ID</th>
                <th>Artikel ID</th>
                <th>Leverancier ID</th>
                <th>Inkoopdatum</th>
                <th>Inkoopbestelling Aantal</th>
                <th>Inkooporder Status</th>
                <th>Actie</th>
            </tr>";

    foreach ($inkoopOrderData as $inkoopOrder) {
        echo "<tr>
                <td>" . $inkoopOrder['inkordid'] . "</td>
                <td>" . $inkoopOrder['artid'] . "</td>
                <td>" . $inkoopOrder['levid'] . "</td>
                <td>" . $inkoopOrder['inkorddatum'] . "</td>
                <td>" . $inkoopOrder['inkordbestaantal'] . "</td>
                <td>" . $inkoopOrder['inkordstatus'] . "</td>
                <td>
                    <form method='POST' action=''>
                        <input type='hidden' name='inkordid' value='" . $inkoopOrder['inkordid'] . "'>
                        <button type='submit' name='deleteInkoopOrder'>Verwijderen</button>
                    </form>
                </td>
            </tr>";
    }

    echo "</table>";
}

if ($verkoopOrderData !== null) {
    echo "<h3>Verkooporders</h3>";

    echo "<table>
            <tr>
                <th>Verkooporder ID</th>
                <th>Artikel ID</th>
                <th>Klant ID</th>
                <th>Verkoopdatum</th>
                <th>Verkoopbestelling Aantal</th>
                <th>Verkooporder Status</th>
                <th>Actie</th>
            </tr>";

    foreach ($verkoopOrderData as $verkoopOrder) {
        echo "<tr>
                <td>" . $verkoopOrder['verkordid'] . "</td>
                <td>" . $verkoopOrder['artid'] . "</td>
                <td>" . $verkoopOrder['klantid'] . "</td>
                <td>" . $verkoopOrder['verkorddatum'] . "</td>
                <td>" . $verkoopOrder['verkordbestaantal'] . "</td>
                <td>" . $verkoopOrder['verkordstatus'] . "</td>
                <td>
                    <form method='POST' action=''>
                        <input type='hidden' name='verkordid' value='" . $verkoopOrder['verkordid'] . "'>
                        <button type='submit' name='deleteVerkoopOrder'>Verwijderen</button>
                    </form>
                </td>
            </tr>";
    }

    echo "</table>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteInkoopOrder'])) {
        $inkordid = $_POST['inkordid'];
        $deleted = $inkoopOrders->deleteInkoopOrder($inkordid);
        if ($deleted) {
            echo "Inkooporder met ID $inkordid is succesvol verwijderd.";
        }
    } elseif (isset($_POST['deleteVerkoopOrder'])) {
        $verkordid = $_POST['verkordid'];
        $deleted = $verkoopOrders->deleteVerkoopOrder($verkordid);
        if ($deleted) {
            echo "Verkooporder met ID $verkordid is succesvol verwijderd.";
        }
    }
}
?>
