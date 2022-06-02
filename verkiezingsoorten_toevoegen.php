<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verkiezingsoorten toevoegen</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

    include 'menu.html';

if (isset($_POST['opslaan'])) {
    include 'connect.php';
    $conn = DbConnect();

    $bestuursniveau = $_POST['Bestuursniveau'];

    if($bestuursniveau != "") {
        try {
            $query = "INSERT INTO `verkiezingsoorten`(`Bestuursniveau`) 
                        VALUES (:Bestuursniveau)";

            if ($stmt = $conn->prepare($query)){
                $gegevens = [
                    ':Bestuursniveau'=> $bestuursniveau,
                ];
                if ($stmt->execute($gegevens)){
                    echo "Toegevoegd";
                    ?>
                    <script>
                        window.alert("Een Verkiezingsoorten is toegevoegd!");
                        window.location = "index.php";
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        window.alert("Fout bij Verkiezingsoorten toevoegen! Probeer het nog een keer!");
                        window.location = "verkiezingsoorten_index.php";
                    </script>
                    <?php
                }
            }else{
                    ?>
                    <script>
                        window.alert("Er is een fout opgetreden!");
                        window.location = "verkiezingsoorten_index.php";
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
                window.location = "verkiezingsoorten_index.php";
            </script>
            <?php
    }
}
?>


<div class="parent">
    <h2>Verkiezingsoorten Toevoegen:</h2>
    <form action="verkiezingsoorten_toevoegen.php" method="post" name="form1">
        <table border="0">
            <tr>
                <td>Bestuursniveau:</td>
                <td><input type="text" name="Bestuursniveau"></td>
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