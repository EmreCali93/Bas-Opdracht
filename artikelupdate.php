<?php

include 'classes/artikelen.php';

// Controleer of het formulier is ingediend en verwerk de gegevens
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_all'])) {
    $artikelenToUpdate = $_POST['artid'];
    $artikelenomschrijving = $_POST['artikelenomschrijving'];
    $artinkoop = $_POST['artinkoop'];
    $artverkoop = $_POST['artverkoop'];
    $artvoorraad = $_POST['artvoorraad'];
    $artminvoorraad = $_POST['artminvoorraad'];
    $artmaxvoorraad = $_POST['artmaxvoorraad'];
    $artlocatie = $_POST['artlocatie'];
    $levid = $_POST['levid'];

    // Maak een instantie van de Artikel-klasse
    $artikel = new Artikel($conn);

    // Loop door de te updaten artikelen
    foreach ($artikelenToUpdate as $index => $artikelId) {
        // Verkrijg de bijbehorende waarden voor de huidige artikelrij
        $omschrijving = $artikelenomschrijving[$index];
        $inkoop = $artinkoop[$index];
        $verkoop = $artverkoop[$index];
        $voorraad = $artvoorraad[$index];
        $minVoorraad = $artminvoorraad[$index];
        $maxVoorraad = $artmaxvoorraad[$index];
        $locatie = $artlocatie[$index];
        $leverancierId = $levid[$index];

        // Voer de update uit voor de huidige artikelrij
        $artikel->updateArtikel($artikelId, $omschrijving, $inkoop, $verkoop, $voorraad, $minVoorraad, $maxVoorraad, $locatie, $leverancierId);
    }

    // Redirect naar de pagina of voer een andere gewenste actie uit
    header("Location: success.php");
    exit();
}

// Haal de artikelen op
$artikel = new Artikel($conn);
$artikelen = $artikel->getArtikelen();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Artikelen beheren</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Artikelen beheren</h1>
    <form method="post" action="">
        <table>
            <tr>
                <th>Artikel ID</th>
                <th>Artikelenomschrijving</th>
                <th>Artinkoop</th>
                <th>Artverkoop</th>
                <th>Artvoorraad</th>
                <th>Artminvoorraad</th>
                <th>Artmaxvoorraad</th>
                <th>Artlocatie</th>
                <th>Leverancier ID</th>
                <th>Actie</th>
            </tr>
            <?php foreach ($artikelen as $artikel) { ?>
                <tr>
                    <td><?php echo $artikel['artid']; ?></td>
                    <td>
                        <input type="text" name="artikelenomschrijving[]" value="<?php echo $artikel['artikelenomschrijving']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artinkoop[]" value="<?php echo $artikel['artinkoop']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artverkoop[]" value="<?php echo $artikel['artverkoop']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artvoorraad[]" value="<?php echo $artikel['artvoorraad']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artminvoorraad[]" value="<?php echo $artikel['artminvoorraad']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artmaxvoorraad[]" value="<?php echo $artikel['artmaxvoorraad']; ?>">
                    </td>
                    <td>
                        <input type="text" name="artlocatie[]" value="<?php echo $artikel['artlocatie']; ?>">
                    </td>
                    <td>
                        <input type="text" name="levid[]" value="<?php echo $artikel['levid']; ?>">
                    </td>
                    <td>
                        <input type="hidden" name="artid[]" value="<?php echo $artikel['artid']; ?>">
                    </td>
                </tr>
            <?php } ?>
        </table>
        <input type="submit" name="update_all" value="Alle gegevens bijwerken">
    </form>
</body>
</html>
