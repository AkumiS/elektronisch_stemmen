<?php

include "Verkiesbaren.php";
include "connect.php";
include 'menu.html';

$verkiesbaren = new Verkiesbaren;
//Toon Verkooporders
$ZoekVerkiesbaren = $verkiesbaren->Verkiesbaren_Zoeken();

try {

    $verkiesbarenID = $_POST['VerkiesbareID'];

    $conn = new PDO("mysql:host=localhost;dbname=elektronisch_stemmen", "root", "");
    $gebruiker = $conn->prepare("SELECT * from gebruiker");
    $gebruiker->execute();

    $parij = $conn->prepare("SELECT * from parijenperverkiezingen");
    $parij->execute();

    $resultaat =  $gebruiker->setFetchMode(PDO::FETCH_ASSOC);
    $resultaat2 = $parij->setFetchMode(PDO::FETCH_ASSOC);

    ?>

    <div class="parent">

        <h2>Verkiesbaren Bijwerken:</h2>
        <form action="verkiesbaren_wijzig.php" method="post" name="form1">
            <table border="0">
                <tr>
                    <td>Jouw ID:</td>
                    <td><select name="GebruikerID">
                            <?php
                            while($row = $gebruiker->fetch()) {
                                $gebruikerID = $row['GebruikerID'];
                                $gebruikersnaam = $row['Gebruikersnaam'];
                                echo "<option value=".$gebruikerID.">ID:".$gebruikerID." | ".$gebruikersnaam."</option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Partij:</td>
                    <td><select name="partijID">
                            <option value="Geen">Geen</option>
                            <?php
                            while($row = $parij->fetch()) {
                                $partijID = $row['partijID'];
                                $partijNaam = $row['PartijNaam'];
                                $afkorting = $row['Afkorting'];
                                echo "<option value=".$partijID.">".$afkorting." | Naam: ".$partijNaam."</option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Naam:</td>
                    <td><input type="text" name="Naam"></td>
                </tr>
                <tr>
                    <td>Macht:</td>
                    <td><select name="partijMacht">
                            <option value="admin">admin</option>
                            <option value="Verkiesbare">Verkiesbare</option>
                        </select></td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                    <td><input type="submit" value="update" name="update"/></td>
                    <input type='hidden' name='VerkiesbareID' value ='<?php echo $verkiesbarenID;?>'>
                </tr>
            </table>
        </form>
    </div>
    <?php

}catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


//foreach ($ZoekVerkiesbaren as $row)
//{
//
//    $verkiesbarenID =  $row['VerkiesbareID'];
//    $gebruikerID =  $row['GebruikerID'];
//    $Naam = $row['Naam'];
//    $partijMacht = $row['partijMacht'];
//    $partijID = $row['partijID'];
//
//
//echo "<div class='parent'>
//        <h2>Verkiesbaren Bijwerken:</h2>
//            <form action=verkiesbaren_wijzig.php method='POST'>
//                <input type='text' name='Gebruikersnaam' value='" . $gebruikerNaam . "' placeholder='" . $gebruikerNaam . "' required>
//                <br /><br />
//                <input type='email' name='Email' value='" . $gebruikerEmail . "' placeholder='" . $gebruikerEmail . "' required>
//                <br /><br />
//                <input type='number' name='Leeftijd' value='" . $leeftijd . "' placeholder='" . $leeftijd . "' required>
//                <br /><br />
//                <input type='number' name='Indentiteit' value='" . $indentiteit . "' placeholder='" . $indentiteit . "' required>
//                <br /><br />
//                <input type='text' name='Macht' value='" . $macht . "' placeholder='" . $macht . "' required>
//                <br /><br />
//                <input type='submit' name='update' value='update'>
//
//                <input type='hidden' name='VerkiesbareID' value ='" .  $verkiesbarenID . "'>
//            </form>
//
//            <form action='index.php'>
//                <input type='submit' value='terug'>
//            </form>
//      </div>";
//}
if(isset($_POST['update']))
{
    $verkiesbaren->Verkiesbaren_bijwerken();

    echo "<script>alert('Verkiesbaren bijgewerkt')
            window.location.replace('verkiesbaren_Zoek.php');
            </script>";

}
?>