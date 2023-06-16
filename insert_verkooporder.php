<?php
include 'conn.php';
include 'Config.php';
include 'classes/VerkoopOrders.php.';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder toevoegen</title>
</head>
<body>

    <h1>Verkooporder toevoegen</h1>
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

        <input type="submit" name="insert" value="Toevoegen">
    </form>
</body>
</html>