<?php
include 'conn.php';
include 'Config.php';
include 'classes/VerkoopOrders.php';

// Controleer of het formulier voor het bijwerken van de verkooporder is ingediend
if (isset($_POST['update'])) {
    // Haal de bijgewerkte waarden op uit het formulier
    $verkordid = $_POST['verkordid'];
    $artid = $_POST['artid'];
    $klantid = $_POST['klantid'];
    $verkorddatum = $_POST['verkorddatum'];
    $verkordbestaantal = $_POST['verkordbestaantal'];
    $verkordstatus = $_POST['verkordstatus'];

    // Voer de bijwerkingsbewerking uit in de database
    $verkoopOrder = new Verkooporder($conn);
    $verkoopOrder->updateVerkooporder($verkordid, $artid, $klantid, $verkorddatum, $verkordbestaantal, $verkordstatus);

    // Voer andere gewenste acties uit, zoals het tonen van een succesbericht aan de gebruiker
    echo "<script>alert('Verkooporder met ID: " . $verkordid . " is bijgewerkt')</script>";
    echo "<script> location.replace('select.php'); </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder bijwerken</title>
</head>
<body>
    <h1>Verkooporder bijwerken</h1>
    <form method="post" action="">
        <label>Verkooporder ID:</label>
        <input type="text" name="verkordid" required><br><br>

        <label>Artikel ID:</label>
        <input type="text" name="artid" required><br><br>

        <label>Klant ID:</label>
        <input type="text" name="klantid" required><br><br>

        <label>Verkooporder datum:</label>
        <input type="text" name="verkorddatum" required><br><br>

        <label>Verkooporder bestaantal:</label>
        <input type="text" name="verkordbestaantal" required><br><br>

        <label>Verkooporder status:</label>
        <input type="text" name="verkordstatus" required><br><br>

        <input type="submit" name="update" value="Bijwerken">
    </form>
</body>
</html>
