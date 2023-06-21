<?php
// Verbinding maken met de database en andere vereiste initialisaties

// Databasegegevens
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basdatabase";

// Verbinding maken met de database
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Query om de klanten uit de database op te halen
$query = "SELECT klantId, klantNaam FROM klanten";
$stmt = $conn->query($query);

// Het formulier weergeven
echo "<form method='post' action='verkooporder_toevoegen.php'>";
echo "Klant: ";
echo "<select name='klantId'>";

// Opties voor de dropdown genereren op basis van de databasegegevens
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $klantId = $row['klantId'];
    $klantNaam = $row['klantNaam'];
    echo "<option value='$klantId'>$klantNaam</option>";
}

echo "</select><br>";
echo "Aantal: ";
echo "<input type='number' name='aantal'><br>";
echo "Product: ";
echo "<input type='text' name='product'><br>";
echo "<input type='submit' value='Verzenden'>";
echo "</form>";

// Verbinding met de database sluiten
$conn = null;
?>