<?php

include "Verkiezingsoorten.php";
include "connect.php";
include 'menu.html';

$verkiezing = new Verkiezingsoorten;
//Toon Verkiezingsoorten
$ZoekVerkiezingsoorten = $verkiezing->Verkiezingsoorten_Zoeken();

foreach ($ZoekVerkiezingsoorten as $row)
{

    $verkiezingID =  $row['VerkiezingID'];
    $bestuursniveau = $row['Bestuursniveau'];


echo "<div class='parent'>
        <h2>Verkiezingsoorten Bijwerken:</h2>
            <form action=verkiezingsoorten_wijzig.php method='POST'>                
                <input type='text' name='Bestuursniveau' value='" . $bestuursniveau . "' placeholder='" . $bestuursniveau . "' required>
                <br /><br />
                <input type='submit' name='update' value='update'>
                <input type='hidden' name='VerkiezingID' value ='" .  $verkiezingID . "'>
            </form>

            <form action='index.php'>
                <input type='submit' value='terug'>
            </form>
      </div>";
}
if(isset($_POST['update']))
{
    $verkiezing->Verkiezingsoorten_bijwerken();

    echo "<script>alert('Verkiezingsoorten bijgewerkt')
            window.location.replace('verkiezingsoorten_Zoek.php');
            </script>";

}
?>