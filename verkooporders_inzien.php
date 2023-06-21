<?php
// Databasegegevens
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basdatabase";

try {
    // Verbinding maken met de database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query voor het selecteren van verkooporders
    $query = "SELECT * FROM verkooporders";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Controleren of er resultaten zijn
    if ($stmt->rowCount() > 0) {
        // Resultaten ophalen en weergeven
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orderID = $_POST['orderID'] ?? null;
            $klantID = $_POST['klantID'] ?? null;
            $product = $_POST['product'] ?? null;
            $aantal = $_POST['aantal'] ?? null;

            // Verdere verwerking of weergave van de verkoopordergegevens
            echo "Order ID: " . $orderID . "<br>";
            echo "Klant ID: " . $klantID . "<br>";
            echo "Product: " . $product . "<br>";
            echo "Aantal: " . $aantal . "<br>";
            echo "<br>";
        }
    } else {
        echo "Geen verkooporders gevonden.";
    }
} catch(PDOException $e) {
    echo "Fout bij het ophalen van verkooporders: " . $e->getMessage();
}

// Verbinding verbreken
$conn = null;
?>