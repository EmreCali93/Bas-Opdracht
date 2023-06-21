<?php

include 'conn.php';
include 'Config.php';
include 'classes/inkooporderclass.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Inkooporders beheren</title>
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
    <h1>Inkooporders beheren</h1>
    <form method="post" action="">
        <table>
            <tr>
                <th>Inkooporder ID</th>
                <th>Artikel ID</th>
                <th>Leverancier ID</th>
                <th>Inkooporder datum</th>
                <th>Inkooporder bestaantal</th>
                <th>Inkooporder status</th>
                <th>Actie</th>
            </tr>
            <?php foreach ($inkoopOrders as $inkoopOrder) { ?>
                <tr>
                    <td><?php echo $inkoopOrder['inkordid']; ?></td>
                    <td>
                        <input type="text" name="artid[]" value="<?php echo $inkoopOrder['artid']; ?>">
                    </td>
                    <td>
                        <input type="text" name="levid[]" value="<?php echo $inkoopOrder['levid']; ?>">
                    </td>
                    <td>
                        <input type="date" name="inkorddatum[]" value="<?php echo $inkoopOrder['inkorddatum']; ?>">
                    </td>
                    <td>
                        <input type="text" name="inkordbestaantal[]" value="<?php echo $inkoopOrder['inkordbestaantal']; ?>">
                    </td>
                    <td>
                        <input type="text" name="inkordstatus[]" value="<?php echo $inkoopOrder['inkordstatus']; ?>">
                    </td>
                    <td>
                        <input type="hidden" name="inkordid[]" value="<?php echo $inkoopOrder['inkordid']; ?>">
                    </td>
                </tr>
            <?php } ?>
        </table>
        <input type="submit" name="update_all" value="Alle gegevens bijwerken">
    </form>
    <a href="index.php">Homepage</a>
</body>
</html>
