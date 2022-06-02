<?php

include "Gebruiker.php";
include "connect.php";
include 'menu.html';

$gebruiker = new Gebruiker;
//Toon Gebruiker
$ZoekGebruiker = $gebruiker->Gebruiker_Zoeken();

foreach ($ZoekGebruiker as $row)
{

    $gebruikerID =  $row['GebruikerID'];
    $gebruikerNaam = $row['Gebruikersnaam'];
    $gebruikerEmail = $row['Email'];
    $leeftijd = $row['Leeftijd'];
    $indentiteit = $row['Indentiteit'];
    $macht = $row['Macht'];


echo "<div class='parent'>
        <h2>Stemgerechtigden Bijwerken:</h2>
            <form action=gebruiker_wijzig.php method='POST'>                
                <input type='text' name='Gebruikersnaam' value='" . $gebruikerNaam . "' placeholder='" . $gebruikerNaam . "' required>
                <br /><br />
                <input type='email' name='Email' value='" . $gebruikerEmail . "' placeholder='" . $gebruikerEmail . "' required>
                <br /><br />
                <input type='number' name='Leeftijd' value='" . $leeftijd . "' placeholder='" . $leeftijd . "' required>
                <br /><br />
                <input type='number' name='Indentiteit' value='" . $indentiteit . "' placeholder='" . $indentiteit . "' required>
                <br /><br />
                <select name='Macht'>
                        <option value='" . $macht . "'>" . $macht . "</option>
                        <option value='stemgerechtigden'>stemgerechtigden</option>
                        <option value='Verkiesbaren'>Verkiesbaren</option>
                        <option value='Minister'>Minister</option>
                   </select>
                <br /><br />
                <input type='submit' name='update' value='update'>

                <input type='hidden' name='GebruikerID' value ='" .  $gebruikerID . "'>
            </form>

            <form action='index.php'>
                <input type='submit' value='terug'>
            </form>
      </div>";
}
if(isset($_POST['update']))
{
    $gebruiker->Gebruiker_bijwerken();

    echo "<script>alert('Gebruiker bijgewerkt')
            window.location.replace('gebruiker_index.php');
            </script>";

}
?>