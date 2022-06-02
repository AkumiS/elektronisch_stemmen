<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Partijen Zoeken</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php

include "Partijen.php";
include "connect.php";
include 'menu.html';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['Zoeken']))
{

    $partijen = new Partijen;
    $ZoekPartijen = $partijen->Partijen_Zoeken();

    $partijen->toonPartijen($ZoekPartijen);

}else{
    $conn = new PDO("mysql:host=localhost;dbname=elektronisch_stemmen", "root", "");
    $Partijen = $conn->prepare("SELECT * from parijenperverkiezingen");
    $Partijen->execute();

    ?>

    <div class="parent">

        <h2>Partijen Opzoeken:</h2>
        <form action="partijen_Zoek.php" method="post" name="form1">
            <table border="0">
                <tr>
                    <td>Partijen:</td>
                    <td><select name="partijID">
                            <?php
                            while($row = $Partijen->fetch()) {
                                $partijID = $row['partijID'];
                                $partijNaam = $row['PartijNaam'];
                                echo "<option value=".$partijID.">ID:".$partijID." | ".$partijNaam."</option>";
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