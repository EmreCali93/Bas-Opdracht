<!DOCTYPE html>
<html>
<head>
    <title>Leverancier toevoegen</title>
</head>
<body>
    <h1>Leverancier toevoegen</h1>
    <form method="post" action="leverancierinsert.php">
        <label for="levid">Leverancier ID:</label>
        <input type="text" id="levid" name="levid" placeholder="Leverancier ID" required/><br><br>
        <label for="levnaam">Leverancier naam:</label>
        <input type="text" id="levnaam" name="levnaam" placeholder="Leverancier naam" required/><br><br>
    
        <label for="levcontact">Leverancier contactpersoon:</label>
        <input type="text" id="levcontact" name="levcontact" placeholder="Leverancier contactpersoon" required/><br><br>
    
        <label for="levemail">Leverancier E-mail:</label>
        <input type="email" id="levemail" name="levemail" placeholder="Leverancier E-mail" required/><br><br>
    
        <label for="levadres">Leverancier Adres:</label>
        <input type="text" id="levadres" name="levadres" placeholder="Leverancier Adres" required/><br><br>
    
        <label for="levpostcode">Leverancier Postcode:</label>
        <input type="text" id="levpostcode" name="levpostcode" placeholder="Leverancier Postcode" required/><br><br>
    
        <label for="levwoonplaats">Leverancier Woonplaats:</label>
        <input type="text" id="levwoonplaats" name="levwoonplaats" placeholder="Leverancier Woonplaats" required/><br><br>
    
        <input type="submit" name="insert" value="Toevoegen">
    </form>
    <a href="index.php">Homepage</a>
</body>
</html>    