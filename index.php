<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Homepagina - Dirk Supermarkt</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <style>
        /* CSS-styling voor de homepagina */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        h1 {
            color: #e60000;
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e60000;
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #c40000;
        }

        .logo {
            display: block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welkom op de Homepagina</h1>
        <p>Dit is de startpagina van de website van Dirk Supermarkt.</p>
        <ul>
            <li><a href="artikelenupdate.php">Artikelel beheren</a></li>
            <li><a href="insert_artikel.php">Artikelen toevoegen</a></li>
            <li><a href="insert_inkooporder.php">Inkooporder toevoegen</a></li>
            <li><a href="inkooporder.php">Inkooporders beheren</a></li>
            <li><a href="insert_verkooporder.php">Verkooporder toevoegen</a></li>
            <li><a href="verkooporder_update.php">Verkooporders update</a></li>
            <li><a href="select_verkooporder.php">Verkooporder selecteren</a></li>
            <li><a href="update_orderstatus.php">Orderstatus bijwerken</a></li>
            <li><a href="delete.php">Verwijderen</a></li>
            <li><a href="delete_orders.php">Verwijder Orders</a></li>
            <li><a href="leverancier.php">Leveranciers</a></li>
            <li><a href="leverancierupdate.php">Leverancier beheren</a></li>           
            <li><a href="klantformulier.php">Klantformulier</a></li>
            <li><a href="klant_update.php">Klant updaten</a></li>
            <li><a href="klant_select.php">Klant selecteren</a></li>
        </ul>
    </div>
</body>
</html>
