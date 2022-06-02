<?php

include "Verkiezingsoorten.php";
include "connect.php";
include 'menu.html';

$verkiezing = new Verkiezingsoorten;
//Toon Verkiezingsoorten
$ZoekVerkiezingsoorten = $verkiezing->Verkiezingsoorten_Zoeken();

echo "<div class='parent'>
    <h1>Verkiezingsoorten " . $_POST['Bestuursniveau'] . " verwijderen</h1>
    <form action='verkiezingsoorten_Zoek.php'>
        <input type='submit' value='terug'>
    </form>
    <form action='verkiezingsoorten_verwijderen.php' method='post'>
        <input type='submit' name='verwijder' value='verwijder'>
        <input type='hidden' name='VerkiezingID' value='" . $_POST['VerkiezingID'] . "'>
    </form>
    </div>
";

if(isset($_POST['verwijder']))
{
    $verkiezing->Verkiezingsoorten_verwijderen($ZoekVerkiezingsoorten);
    echo "<script>alert('Verkiezingsoorten verwijderd')
        window.location.replace('verkiezingsoorten_Zoek.php');
        </script>";
}
?>