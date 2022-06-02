<?php

include "Verkiesbaren.php";
include "connect.php";
include 'menu.html';

$verkiesbare = new Verkiesbaren;
//Toon Verkooporders
$ZoekVerkiesbaren = $verkiesbare->Verkiesbaren_Zoeken();


echo "<div class='parent'>
    <h1>Verkiesbaren verwijderen</h1>
    <p>" . $_POST['Naam'] . " verwijderen?</p>
    <form action='index.php'>
        <input type='submit' value='terug'>
    </form>
    <form action='verkiesbaren_verwijderen.php' method='post'>
        <input type='submit' name='verwijder' value='verwijder'>
        <input type='hidden' name='VerkiesbareID' value='" . $_POST['VerkiesbareID'] . "'>
    </form>
    </div>
";

if(isset($_POST['verwijder']))
{
    $verkiesbare->Verkiesbaren_verwijderen($ZoekVerkiesbaren);
    echo "<script>alert('Verkiesbaren verwijderd')
        window.location.replace('verkiesbaren_Zoek.php');
        </script>";
}
?>