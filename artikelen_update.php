<?php
include 'Config.php';
include 'conn.php';
include 'classes/artikelen.php';

$artikelen = new Artikelen($conn);

// Controleer of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ontvang de bijgewerkte gegevens van het formulier
    $artikelId = $_POST['artikel_id'];
    $artikelomschrijving = $_POST['artikel_omschrijving'];
    $inkoopprijs = $_POST['inkoopprijs'];
    $verkoopprijs = $_POST['verkoopprijs'];
    $voorraad = $_POST['voorraad'];
    $minimaleVoorraad = $_POST['minimale_voorraad'];
    $maximaleVoorraad = $_POST['maximale_voorraad'];
    $leverancierId = $_POST['leverancier_id'];
    $locatie = $_POST['locatie'];

    // Voer de bijwerkingslogica uit
    $artikelen->updateArtikel($artikelId, $artikelomschrijving, $inkoopprijs, $verkoopprijs, $voorraad, $minimaleVoorraad, $maximaleVoorraad, $leverancierId, $locatie);

    // Redirect naar de pagina met de bijgewerkte gegevens
    header("Location: index.php");
    exit;
}

$artikelData = $artikelen->getArtikelen();

echo "<table>
        <tr>
            <th>Artikel ID</th>
            <th>Artikelomschrijving</th>
            <th>Inkoopprijs</th>
            <th>Verkoopprijs</th>
            <th>Voorraad</th>
            <th>Minimale Voorraad</th>
            <th>Maximale Voorraad</th>
            <th>Leverancier ID</th>
            <th>Locatie</th>
            <th>Bewerken</th>
        </tr>";

foreach ($artikelData as $artikel) {
    echo "<tr>
            <td>" . $artikel['artid'] . "</td>
            <td>" . $artikel['artikelenomschrijving'] . "</td>
            <td>" . $artikel['artinkoop'] . "</td>
            <td>" . $artikel['artverkoop'] . "</td>
            <td>" . $artikel['artvoorraad'] . "</td>
            <td>" . $artikel['artminvoorraad'] . "</td>
            <td>" . $artikel['artmaxvoorraad'] . "</td>
            <td>" . $artikel['levid'] . "</td>
            <td>" . $artikel['artlocatie'] . "</td>
            <td>
                <form method='post' action=''>
                    <input type='hidden' name='artikel_id' value='" . $artikel['artid'] . "'>
                    <input type='text' name='artikel_omschrijving' value='" . $artikel['artikelenomschrijving'] . "'>
                    <input type='text' name='inkoopprijs' value='" . $artikel['artinkoop'] . "'>
                    <input type='text' name='verkoopprijs' value='" . $artikel['artverkoop'] . "'>
                    <input type='text' name='voorraad' value='" . $artikel['artvoorraad'] . "'>
                    <input type='text' name='minimale_voorraad' value='" . $artikel['artminvoorraad'] . "'>
                    <input type='text' name='maximale_voorraad' value='" . $artikel['artmaxvoorraad'] . "'>
                    <input type='text' name='leverancier_id' value='" . $artikel['levid'] . "'>
                    <input type='text' name='locatie' value='" . $artikel['artlocatie'] . "'>
                    <input type='submit' value='Bijwerken'>
                </form>
            </td>
        </tr>";
}

echo "</table>";
?>
