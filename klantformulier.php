<!DOCTYPE html>
<html>
<head>
    <title>Klant toevoegen</title>
</head>
<body>
    <h1>Klant toevoegen</h1>
    <form method="post" action="insert_klant.php">
        <label for="klantid">Klant ID:</label>
        <input type="text" id="klantid" name="klantid" placeholder="Klant ID" required/><br><br>

        <label for="klantnaam">Klantnaam:</label>
        <input type="text" id="klantnaam" name="klantnaam" placeholder="Klantnaam" required/><br><br>

        <label for="klantemail">Klant E-mail:</label>
        <input type="email" id="klantemail" name="klantemail" placeholder="Klant E-mail" required/><br><br>

        <label for="klantadres">Klant Adres:</label>
        <input type="text" id="klantadres" name="klantadres" placeholder="Klant Adres" required/><br><br>

        <label for="klantpostcode">Klant Postcode:</label>
        <input type="text" id="klantpostcode" name="klantpostcode" placeholder="Klant Postcode" required/><br><br>

        <label for="klantwoonplaats">Klant Woonplaats:</label>
        <input type="text" id="klantwoonplaats" name="klantwoonplaats" placeholder="Klant Woonplaats" required/><br><br>

        <input type="submit" name="insert" value="Toevoegen">
    </form>
    <a href="index.php">Homepage</a>
</body>
</html>