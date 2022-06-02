<?php

include "Partijen.php";
include "connect.php";
include 'menu.html';

$partijen = new Partijen;
//Toon Partijen
$ZoekPartijen = $partijen->Partijen_Zoeken();


echo "<div class='parent'>
    <h1>Partijen verwijderen</h1>
    <p>" . $_POST['PartijNaam'] . " verwijderen?</p>
    <form action='index.php'>
        <input type='submit' value='terug'>
    </form>
    <form action='partijen_verwijderen.php' method='post'>
        <input type='submit' name='verwijder' value='verwijder'>
        <input type='hidden' name='partijID' value='" . $_POST['partijID'] . "'>
    </form>
    </div>
";

if(isset($_POST['verwijder']))
{
    $partijen->Partijen_verwijderen($ZoekPartijen);
    echo "<script>alert('Partijen verwijderd')
        window.location.replace('partijen_Zoek.php');
        </script>";
}
?>