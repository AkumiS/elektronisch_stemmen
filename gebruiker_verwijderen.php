<?php

include "Gebruiker.php";
include "connect.php";
include 'menu.html';

$gebruiker = new Gebruiker;
//Toon Verkooporders
$ZoekGebruiker = $gebruiker->Gebruiker_Zoeken();
//
//echo $klant->toonKlant($ZoekKlant);
//

echo "<div class='parent'>
    <h1>Stemgerechtigden verwijderen</h1>
    <p>" . $_POST['Gebruikersnaam'] . " verwijderen?</p>
    <form action='index.php'>
        <input type='submit' value='terug'>
    </form>
    <form action='gebruiker_verwijderen.php' method='post'>
        <input type='submit' name='verwijder' value='verwijder'>
        <input type='hidden' name='GebruikerID' value='" . $_POST['GebruikerID'] . "'>
    </form>
    </div>
";

if(isset($_POST['verwijder']))
{
    $gebruiker->Gebruiker_verwijderen($ZoekGebruiker);
    echo "<script>alert('Gebruiker verwijderd')
        window.location.replace('gebruiker_index.php');
        </script>";
}
?>