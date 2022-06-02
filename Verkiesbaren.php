<?php
class Verkiesbaren{

    public function zetVerkiesbaren(){

        //Toon verkiesbaren form
        include "verkiesbaren_toevoegen.php";
    }

    public function Verkiesbaren_Zoeken()
    {
        $conn = dbConnect();

        $verkiesbarenID = $_POST['VerkiesbareID'];

        $verkiesbare = $conn->prepare(" SELECT * FROM verkiesbaren WHERE VerkiesbareID = '$verkiesbarenID'");
        $verkiesbare->execute();
        return $verkiesbare;
    }
    public function toonVerkiesbaren($ZoekVerkiesbaren){
        echo "<table border=1 class= table>";
        echo "<tr>";
        echo "<th>Verkiesbare ID</th>";
        echo "<th>Gebruiker ID</th>";
        echo "<th>Naam</th>";
        echo "<th>partijMacht</th>";
        echo "<th>partijID</th>";
        echo "</tr>";
        foreach ($ZoekVerkiesbaren as $row)
        {
            $verkiesbarenID = $row['VerkiesbareID'];
            $gebruikerID = $row['GebruikerID'];
            $Naam = $row['Naam'];
            $partijMacht = $row['partijMacht'];
            $partijID = $row['partijID'];

            echo "<tr>";
            echo "<td>" . $verkiesbarenID . "</td>";
            echo "<td>" . $gebruikerID . "</td>";
            echo "<td>" . $Naam . "</td>";
            echo "<td>" . $partijMacht . "</td>";
            echo "<td>" . $partijID . "</td>";
            echo "<td><form action='verkiesbaren_wijzig.php' method='post'><input type='submit' value='Wijzigen'>
			        <input type='hidden' name='VerkiesbareID' value=" . $verkiesbarenID . " ></form>";
            echo "<td> <form action='verkiesbaren_verwijderen.php' method='post'><input type='submit' value='Verwijderen'>
			<input type='hidden' name='Naam' value=" . $Naam . " >
			<input type='hidden' name='VerkiesbareID' value=" . $verkiesbarenID . " ></form>";
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

    public function Verkiesbaren_bijwerken()
    {
        $conn = dbConnect();

        $verkiesbarenID = $_POST['VerkiesbareID'];
        $gebruikerID = $_POST['GebruikerID'];
        $Naam = $_POST['Naam'];
        $partijMacht = $_POST['partijMacht'];
        $partijID = $_POST['partijID'];

        $sql = "UPDATE verkiesbaren SET VerkiesbareID='$verkiesbarenID', GebruikerID='$gebruikerID', Naam='$Naam', partijMacht='$partijMacht', partijID='$partijID' WHERE VerkiesbareID='$verkiesbarenID'";
        return $conn->query($sql);
    }


    public function Verkiesbaren_verwijderen()
    {
        $conn = dbConnect();

        $verkiesbarenID = $_POST['VerkiesbareID'];

        $sql = "DELETE FROM verkiesbaren WHERE VerkiesbareID='$verkiesbarenID'";
        return $conn->exec($sql);
    }

}

?>