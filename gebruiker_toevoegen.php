<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gebruiker toevoegen</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

    include 'menu.html';

if (isset($_POST['opslaan'])) {
    include 'connect.php';
    $conn = DbConnect();

    $gebruikerNaam = $_POST['Gebruikersnaam'];
    $wachtwoord = $_POST['Wachtwoord'];
    $gebruikerEmail = $_POST['Email'];
    $leeftijd = $_POST['Leeftijd'];
    $indentiteit = $_POST['Indentiteit'];
    $macht = $_POST['Macht'];

    if($gebruikerNaam != "" && $wachtwoord != "" && $gebruikerEmail != "" && $leeftijd != "" && $indentiteit != "" && $macht != "") {
        try {
            $query = "INSERT INTO `gebruiker`(`Gebruikersnaam`, `Wachtwoord`, `Email`, `Leeftijd`, `Indentiteit`, `Macht`) 
                        VALUES (:Gebruikersnaam, :Wachtwoord, :Email, :Leeftijd, :Indentiteit, :Macht)";

            if ($stmt = $conn->prepare($query)){
                $gegevens = [
                    ':Gebruikersnaam'=> $gebruikerNaam,
                    ':Wachtwoord'=> $wachtwoord,
                    ':Email'=> $gebruikerEmail,
                    ':Leeftijd'=> $leeftijd,
                    ':Indentiteit'=> $indentiteit,
                    ':Macht'=> $macht,
                ];
                if ($stmt->execute($gegevens)){
                    echo "Toegevoegd";
                    ?>
                    <script>
                        window.alert("Een Gebruiker is toegevoegd!");
                        window.location = "index.php";
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        window.alert("Fout bij Gebruiker toevoegen! Probeer het nog een keer!");
                        window.location = "gebruiker_index.php";
                    </script>
                    <?php
                }
            }else{
                    ?>
                    <script>
                        window.alert("Er is een fout opgetreden!");
                        window.location = "gebruiker_index.php";
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
                window.location = "gebruiker_index.php";
            </script>
            <?php
    }
}
?>


<div class="parent">
    <h2>Gebruiker Toevoegen:</h2>
    <form action="gebruiker_toevoegen.php" method="post" name="form1">
        <table border="0">
            <tr>
                <td>Gebruikersnaam:</td>
                <td><input type="text" name="Gebruikersnaam"></td>
            </tr>
            <tr>
                <td>Wachtwoord:</td>
                <td><input type="text" name="Wachtwoord"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="Email"></td>
            </tr>
            <tr>
                <td>Leeftijd:</td>
                <td><input type="number" name="Leeftijd"></td>
            </tr>
            <tr>
                <td>Indentiteit:</td>
                <td><input type="number" name="Indentiteit"></td>
            </tr>
            <tr>
                <td>Macht:</td>
                <td>
                    <select name="Macht">
                        <option value="stemgerechtigden">stemgerechtigden</option>
                        <option value="Verkiesbaren">Verkiesbaren</option>
                        <option value="Minister">Minister</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>&nbsp</td>
                <td><input type="submit" value="Opslaan" name="opslaan"/></td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>