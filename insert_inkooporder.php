<?php
include 'classes/InkoopOrders.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Inkooporder toevoegen</title>
</head>
<body>

    <h1>Inkooporder toevoegen</h1>
    <form method="post" action="">
        <label>Inkooporder ID:</label>
        <input type="text" name="inkordid" required><br><br>

        <label>Artikel ID:</label>
        <input type="text" name="artid" required><br><br>

        <label>Leverancier:</label>
        <select name="levid">
            <option value="">Selecteer leverancier</option>
            <?php foreach ($leveranciers as $levid => $levnaam) { ?>
                <option value="<?php echo $levid; ?>"><?php echo $levnaam; ?></option>
            <?php } ?>
        </select><br><br>

        <label>Inkooporder datum:</label>
        <input type="date" name="inkorddatum" required><br><br>

        <label>Inkooporder bestaantal:</label>
        <input type="text" name="inkordbestaantal" required><br><br>

        <label>Inkooporder status:</label>
        <input type="text" name="inkordstatus" required><br><br>

        <input type="submit" name="insert" value="Toevoegen">
    </form>
</body>
</html>
