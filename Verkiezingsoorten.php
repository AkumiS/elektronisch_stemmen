<?php
class Verkiezingsoorten{

    public function zetVerkiezingsoorten(){

        //Toon klant form
        include "verkiezingsoorten_toevoegen.php";
    }

    public function Verkiezingsoorten_Zoeken()
    {
        $conn = dbConnect();
        //include 'verkiezingsoorten_Zoek.php';

        $verkiezingID = $_POST['VerkiezingID'];

        $verkiezing = $conn->prepare(" SELECT * FROM verkiezingsoorten WHERE VerkiezingID = '$verkiezingID'");
        $verkiezing->execute();
        return $verkiezing;
    }
    public function toonVerkiezingsoorten($ZoekVerkiezingsoorten){
        echo "<table border=1 class= table>";
        echo "<tr>";
        echo "<th>Verkiezing ID</th>";
        echo "<th>Bestuursniveau</th>";
        echo "</tr>";
        foreach ($ZoekVerkiezingsoorten as $row)
        {
            $verkiezingID = $row['VerkiezingID'];
            $bestuursniveau = $row['Bestuursniveau'];

            echo "<tr>";
            echo "<td>" . $verkiezingID . "</td>";
            echo "<td>" . $bestuursniveau . "</td>";
            echo "<td><form action='verkiezingsoorten_wijzig.php' method='post'><input type='submit' value='Wijzigen'>
			        <input type='hidden' name='VerkiezingID' value=" . $verkiezingID . " ></form>";
            echo "<td> <form action='verkiezingsoorten_verwijderen.php' method='post'><input type='submit' value='Verwijderen'>
            <input type='hidden' name='Bestuursniveau' value=" . $bestuursniveau . " >
			<input type='hidden' name='VerkiezingID' value=" . $verkiezingID . " ></form>";
            echo "</tr>";
        }
        echo "</table>";
//
//        $form = "<div class='parent'>
//        <h2>Klant Bijwerken:</h2>
//            <form action=gebruiker_wijzig.php method='POST'>
//                <input type='text' name='KlantNaam' value='" . $KlantNaam . "' placeholder='" . $KlantNaam . "' required>
//                <br /><br />
//                <input type='email' name='KlantEmail' value='" . $KlantEmail . "' placeholder='" . $KlantEmail . "' required>
//                <br /><br />
//                <input type='email' name='KlantAdres' value='" . $KlantAdres . "' placeholder='" . $KlantAdres . "' required>
//                <br /><br />
//                <input type='email' name='KlantPostcode' value='" . $KlantPostcode . "' placeholder='" . $KlantPostcode . "' required>
//                <br /><br />
//                <input type='email' name='KlantWoonplaats' value='" . $KlantWoonplaats . "' placeholder='" . $KlantWoonplaats . "' required>
//                <br /><br />
//                <input type='submit' name='update' value='update'>
//
//                <input type='hidden' name='id' value ='" .  $klantId . "'>
//            </form>
//
//            <form action='index.php'>
//                <input type='submit' value='terug'>
//            </form>
//      </div>";
//        return $form;

    }

    public function Verkiezingsoorten_bijwerken()
    {
        $conn = dbConnect();

        $verkiezingID = $_POST['VerkiezingID'];
        $bestuursniveau = $_POST['Bestuursniveau'];

        $sql = "UPDATE verkiezingsoorten SET VerkiezingID='$verkiezingID', Bestuursniveau='$bestuursniveau' WHERE VerkiezingID='$verkiezingID'";
        return $conn->query($sql);
    }


    public function Verkiezingsoorten_verwijderen()
    {
        $conn = dbConnect();

        $verkiezingID = $_POST['VerkiezingID'];

        $sql = "DELETE FROM verkiezingsoorten WHERE VerkiezingID='$verkiezingID'";
        return $conn->exec($sql);
    }

}

?>