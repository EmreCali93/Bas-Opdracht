<?php
include 'Config.php';
include 'conn.php';
include 'classes/artikelen.php';

$artikelen = new Artikelen($conn);

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
        </tr>";
}

echo "</table>";
?>