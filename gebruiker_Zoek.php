<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stemgerechtigden Zoeken</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php

include "Gebruiker.php";
include "connect.php";
include 'menu.html';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['Zoeken']))
{

    $gebruiker = new Gebruiker;
    $ZoekGebruiker = $gebruiker->Gebruiker_Zoeken();

    $gebruiker->toonGebruiker($ZoekGebruiker);

}else{
    $conn = new PDO("mysql:host=localhost;dbname=elektronisch_stemmen", "root", "");
    $Stemgerechtigden = $conn->prepare("SELECT * from gebruiker");
    $Stemgerechtigden->execute();

    ?>

    <div class="parent">

        <h2>Stemgerechtigden Opzoeken:</h2>
        <form action="gebruiker_Zoek.php" method="post" name="form1">
            <table border="0">
                <tr>
                    <td>Stemgerechtigden:</td>
                    <td><select name="GebruikerID">
                            <?php
                            while($row = $Stemgerechtigden->fetch()) {
                                $gebruikerID = $row['GebruikerID'];
                                $gebruikerNaam = $row['Gebruikersnaam'];
                                echo "<option value=".$gebruikerID.">ID:".$gebruikerID." | ".$gebruikerNaam."</option>";
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