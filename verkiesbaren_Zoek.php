<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verkiesbaren Zoeken</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php

include "Verkiesbaren.php";
include "connect.php";
include 'menu.html';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['Zoeken']))
{

    $verkiesbare = new Verkiesbaren;
    $ZoekVerkiesbaren = $verkiesbare->Verkiesbaren_Zoeken();

    $verkiesbare->toonVerkiesbaren($ZoekVerkiesbaren);

}else{
    $conn = new PDO("mysql:host=localhost;dbname=elektronisch_stemmen", "root", "");
    $Verkiesbaren = $conn->prepare("SELECT * from verkiesbaren");
    $Verkiesbaren->execute();

    ?>

    <div class="parent">

        <h2>Verkiesbaren Opzoeken:</h2>
        <form action="verkiesbaren_Zoek.php" method="post" name="form1">
            <table border="0">
                <tr>
                    <td>Verkiesbaren:</td>
                    <td><select name="VerkiesbareID">
                            <?php
                            while($row = $Verkiesbaren->fetch()) {
                                $verkiesbarenID = $row['VerkiesbareID'];
                                $Naam = $row['Naam'];
                                echo "<option value=".$verkiesbarenID.">ID:".$verkiesbarenID." | ".$Naam."</option>";
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