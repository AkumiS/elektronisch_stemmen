<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verkiezingsoorten Zoeken</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php

include "Verkiezingsoorten.php";
include "connect.php";
include 'menu.html';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['Zoeken']))
{

    $verkiezing = new Verkiezingsoorten;
    $ZoekVerkiezingsoorten = $verkiezing->Verkiezingsoorten_Zoeken();

    $verkiezing->toonVerkiezingsoorten($ZoekVerkiezingsoorten);

}else{
    $conn = new PDO("mysql:host=localhost;dbname=elektronisch_stemmen", "root", "");
    $Verkiezingsoorten = $conn->prepare("SELECT * from verkiezingsoorten");
    $Verkiezingsoorten->execute();

    ?>

    <div class="parent">

        <h2>Verkiezingsoorten Opzoeken:</h2>
        <form action="verkiezingsoorten_Zoek.php" method="post" name="form1">
            <table border="0">
                <tr>
                    <td>Verkiezingsoorten:</td>
                    <td><select name="VerkiezingID">
                            <?php
                            while($row = $Verkiezingsoorten->fetch()) {
                                $verkiezingID = $row['VerkiezingID'];
                                $bestuursniveau = $row['Bestuursniveau'];
                                echo "<option value=".$verkiezingID.">ID:".$verkiezingID." | ".$bestuursniveau."</option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <td>&nbsp</td>
                <td><input type="submit" value="Zoeken" name="Zoeken"/></td>
                </tr>
            </table>
        </form>
    </div>
    <?php

}


?>

</body>
</html>