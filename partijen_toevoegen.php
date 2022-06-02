<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Partijen toevoegen</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php

include 'menu.html';
include 'connect.php';
if (isset($_POST['Opslaan'])) {

    include "Partijen.php";
    $conn = DbConnect();

    $partijNaam = $_POST['PartijNaam'];
    $Afkorting = $_POST['Afkorting'];
    $goedkeuren = $_POST['Goedkeuren'];
    $verkiezingID = $_POST['VerkiezingID'];

    if($partijNaam != "" && $Afkorting != "" && $goedkeuren != "" && $verkiezingID != "") {
    try {
        $query = "INSERT INTO `parijenperverkiezingen`(`PartijNaam`, `Afkorting`, `Goedkeuren`, `VerkiezingID`) 
                        VALUES (:PartijNaam, :Afkorting, :Goedkeuren, :VerkiezingID)";

    if ($stmt = $conn->prepare($query)){
        $gegevens = [
            ':PartijNaam'=> $partijNaam,
            ':Afkorting'=> $Afkorting,
            ':Goedkeuren'=> $goedkeuren,
            ':VerkiezingID'=> $verkiezingID,
        ];
    if ($stmt->execute($gegevens)){
        ?>
        <script>
            window.alert("Partijen aangemaakt!");
            window.location = "index.php";
        </script>
    <?php
    }else{
    ?>
        <script>
            window.alert("Fout! Probeer het nog een keer.");
            window.location = "partijen_toevoegen.php";
        </script>
    <?php
    }
    }else{
    ?>
        <script>
            window.alert("Er is een fout opgetreden!");
            window.location = "partijen_toevoegen.php";
        </script>
    <?php
    }
    } catch (PDOException $e) {
        echo "Error : ".$e->getMessage();
    }
    }else {
    ?>
        <script>
            window.alert("Alle velden zijn verplicht!");
            window.location = "partijen_toevoegen.php";
        </script>
        <?php
    }
}
try {

    $conn = new PDO("mysql:host=localhost;dbname=elektronisch_stemmen", "root", "");
    $verkiezingsoorten = $conn->prepare("SELECT * from verkiezingsoorten");
    $verkiezingsoorten->execute();

    $resultaat =  $verkiezingsoorten->setFetchMode(PDO::FETCH_ASSOC);

    ?>

    <div class="parent">

        <h2>Partijen Toevoegen:</h2>
        <form action="partijen_toevoegen.php" method="post" name="form1">
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
                    <td><input type="submit" value="Opslaan" name="Opslaan"/></td>
                </tr>
            </table>
        </form>
    </div>
    <?php

}catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

</body>
</html>