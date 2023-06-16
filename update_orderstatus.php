<?php

include 'conn.php';
include 'Config.php';
include 'classes/Orderstatus.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporders beheren</title>
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
    <h1>Verkooporders beheren</h1>
    <form method="post" action="">
        <table>
            <tr>
                <th>Verkooporder ID</th>
                <th>Artikel ID</th>
                <th>Klant ID</th>
                <th>Verkooporder datum</th>
                <th>Verkooporder bestaantal</th>
                <th>Verkooporder status</th>
                <th>Actie</th>
            </tr>
            <?php foreach ($verkoopOrders as $verkoopOrder) { ?>
                <tr>
                    <td><?php echo $verkoopOrder['verkordid']; ?></td>
                    <td>
                        <input type="text" name="artid[]" value="<?php echo $verkoopOrder['artid']; ?>">
                    </td>
                    <td>
                        <input type="text" name="klantid[]" value="<?php echo $verkoopOrder['klantid']; ?>">
                    </td>
                    <td>
                        <input type="date" name="verkorddatum[]" value="<?php echo $verkoopOrder['verkorddatum']; ?>">
                    </td>
                    <td>
                        <input type="text" name="verkordbestaantal[]" value="<?php echo $verkoopOrder['verkordbestaantal']; ?>">
                    </td>
                    <td>
                        <input type="text" name="verkordstatus[]" value="<?php echo $verkoopOrder['verkordstatus']; ?>">
                    </td>
                    <td>
                        <input type="hidden" name="verkordid[]" value="<?php echo $verkoopOrder['verkordid']; ?>">
                    </td>
                </tr>
            <?php } ?>
        </table>
        <input type="submit" name="update_all" value="Alle gegevens bijwerken">
    </form>
</body>
</html>
