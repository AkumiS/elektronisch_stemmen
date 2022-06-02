<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verkiesbaren toevoegen</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php

include 'menu.html';
include 'connect.php';
if (isset($_POST['Opslaan'])) {

    include "Verkiesbaren.php";
    $conn = DbConnect();

    $gebruikerID = $_POST['GebruikerID'];
    $Naam = $_POST['Naam'];
    $partijMacht = $_POST['partijMacht'];
    $partijID = $_POST['partijID'];

    if($gebruikerID != "" && $Naam != "" && $partijMacht != "" && $partijID != "") {
    try {
        $query = "INSERT INTO `verkiesbaren`(`GebruikerID`, `Naam`, `partijMacht`, `partijID`) 
                        VALUES (:GebruikerID, :Naam, :partijMacht, :partijID)";

    if ($stmt = $conn->prepare($query)){
        $gegevens = [
            ':GebruikerID'=> $gebruikerID,
            ':Naam'=> $Naam,
            ':partijMacht'=> $partijMacht,
            ':partijID'=> $partijID,
        ];
    if ($stmt->execute($gegevens)){
        ?>
        <script>
            window.alert("Verkiesbaren aangemaakt!");
            window.location = "index.php";
        </script>
    <?php
    }else{
    ?>
        <script>
            window.alert("Fout! Probeer het nog een keer.");
            window.location = "verkiesbaren_toevoegen.php";
        </script>
    <?php
    }
    }else{
    ?>
        <script>
            window.alert("Er is een fout opgetreden!");
            window.location = "verkiesbaren_toevoegen.php";
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
            window.location = "verkiesbaren_toevoegen.php";
        </script>
        <?php
    }
}
try {

    $conn = new PDO("mysql:host=localhost;dbname=elektronisch_stemmen", "root", "");
    $gebruiker = $conn->prepare("SELECT * from gebruiker");
    $gebruiker->execute();

    $parij = $conn->prepare("SELECT * from parijenperverkiezingen");
    $parij->execute();

    $resultaat =  $gebruiker->setFetchMode(PDO::FETCH_ASSOC);
    $resultaat2 = $parij->setFetchMode(PDO::FETCH_ASSOC);

    ?>

    <div class="parent">

        <h2>Verkiesbaren Toevoegen:</h2>
        <form action="verkiesbaren_toevoegen.php" method="post" name="form1">
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