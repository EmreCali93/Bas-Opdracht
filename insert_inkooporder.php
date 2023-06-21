<!DOCTYPE html>
<html>
<head>
    <title>Inkooporder toevoegen</title>
</head>
<body>

    <h1>Inkooporder toevoegen</h1>
    <form method="post" action="inkooporderinsert.php">
        <label>Inkooporder ID:</label>
        <input type="text" name="inkordid" required><br><br>

        <label>Artikel ID:</label>
        <input type="text" name="artid" required><br><br>

        <label>Leverancier ID:</label>
        <input type="text" name="levid" required><br><br>

        <label>Inkooporder datum:</label>
        <input type="text" name="inkorddatum" required><br><br>

        <label>Inkooporder bestaantal:</label>
        <input type="text" name="inkordbestaantal" required><br><br>

        <label>Inkooporder status:</label>
        <input type="text" name="inkordstatus" required><br><br>

        <input type="submit" name="insert" value="Toevoegen">
    </form>
    <a href="index.php">Homepage</a>
</body>
</html>
