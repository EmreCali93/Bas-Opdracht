<!DOCTYPE html>
<html>
<head>
    <title>Artikel toevoegen</title>
</head>
<body>
    <h1>Artikel toevoegen</h1>
    <form method="post" action="insertartikel.php">
        <label for="artid">Artikel ID:</label>
        <input type="text" id="artid" name="artid" placeholder="Artikel ID" required/><br><br>

        <label for="artomschrijving">Artikelomschrijving:</label>
        <input type="text" id="artomschrijving" name="artomschrijving" placeholder="Artikelomschrijving" required/><br><br>

        <label for="artinkoop">Inkoopprijs:</label>
        <input type="text" id="artinkoop" name="artinkoop" placeholder="Inkoopprijs" required/><br><br>

        <label for="artverkoop">Verkoopprijs:</label>
        <input type="text" id="artverkoop" name="artverkoop" placeholder="Verkoopprijs" required/><br><br>

        <label for="artvoorraad">Voorraad:</label>
        <input type="text" id="artvoorraad" name="artvoorraad" placeholder="Voorraad" required/><br><br>

        <label for="artminvoorraad">Minimale voorraad:</label>
        <input type="text" id="artminvoorraad" name="artminvoorraad" placeholder="Minimale voorraad" required/><br><br>

        <label for="artmaxvoorraad">Maximale voorraad:</label>
        <input type="text" id="artmaxvoorraad" name="artmaxvoorraad" placeholder="Maximale voorraad" required/><br><br>

        <label for="artlocatie">Locatie:</label>
        <input type="text" id="artlocatie" name="artlocatie" placeholder="Locatie" required/><br><br>

        <label for="levid">Leverancier ID:</label>
        <input type="text" id="levid" name="levid" placeholder="Leverancier ID" required/><br><br>

        <input type="submit" name="insert" value="Toevoegen">
    </form>
    <a href="index.php">Homepage</a>
</body>
</html>
