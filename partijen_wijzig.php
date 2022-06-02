<?php

include "Partijen.php";
include "connect.php";
include 'menu.html';

$partijen = new Partijen;
//Toon Partijen
$ZoekPartijen = $partijen->Partijen_Zoeken();

try {

    $partijID = $_POST['partijID'];

    $conn = new PDO("mysql:host=localhost;dbname=elektronisch_stemmen", "root", "");
    $verkiezingsoorten = $conn->prepare("SELECT * from verkiezingsoorten");
    $verkiezingsoorten->execute();

    $resultaat =  $verkiezingsoorten->setFetchMode(PDO::FETCH_ASSOC);

    ?>

    <div class="parent">

        <h2>Partijen Bijwerken:</h2>
        <form action="partijen_wijzig.php" method="post" name="form1">
            <table border="0">
                <tr>
                    <td>Bestuursniveau:</td>
                    <td><select name="VerkiezingID">
                            <?php
                            while($row = $verkiezingsoorten->fetch()) {
                                $verkiezingID = $row['VerkiezingID'];
                                $bestuursniveau = $row['Bestuursniveau'];
                                echo "<option value=".$verkiezingID.">ID:".$verkiezingID." | ".$bestuursniveau."</option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>PartijNaam:</td>
                    <td><input type="text" name="PartijNaam"></td>
                </tr>
                <tr>
                    <td>Afkorting:</td>
                    <td><input type="text" name="Afkorting"></td>
                </tr>
                <tr>
                    <td>Goedgekeurd?</td>
                    <td><select name="Goedkeuren">
                            <option value="Ja">Ja</option>
                            <option value="Nee">Nee</option>
                        </select></td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                    <td><input type="submit" value="update" name="update"/></td>
                    <input type='hidden' name='partijID' value ='<?php echo $partijID;?>'>
                </tr>
            </table>
        </form>
    </div>
    <?php

}catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if(isset($_POST['update']))
{
    $partijen->Partijen_bijwerken();

    echo "<script>alert('Partijen bijgewerkt')
            window.location.replace('partijen_Zoek.php');
            </script>";

}
?>