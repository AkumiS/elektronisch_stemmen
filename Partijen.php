<?php
class Partijen{

    public function zetPartijen(){

        //Toon klant form
        include "partijen_toevoegen.php";
    }

    public function Partijen_Zoeken()
    {
        $conn = dbConnect();

        $partijID = $_POST['partijID'];

        $partijen = $conn->prepare(" SELECT * FROM parijenperverkiezingen WHERE partijID = '$partijID'");
        $partijen->execute();
        return $partijen;
    }
    public function toonPartijen($ZoekPartijen){
        echo "<table border=1 class= table>";
        echo "<tr>";
        echo "<th>Partij ID</th>";
        echo "<th>Partij Naam</th>";
        echo "<th>Afkorting</th>";
        echo "<th>Goedgekeurd?</th>";
        echo "<th>VerkiezingID</th>";
        echo "</tr>";
        foreach ($ZoekPartijen as $row)
        {
            $partijID = $row['partijID'];
            $partijNaam = $row['PartijNaam'];
            $Afkorting = $row['Afkorting'];
            $goedkeuren = $row['Goedkeuren'];
            $verkiezingID = $row['VerkiezingID'];

            echo "<tr>";
            echo "<td>" . $partijID . "</td>";
            echo "<td>" . $partijNaam . "</td>";
            echo "<td>" . $Afkorting . "</td>";
            echo "<td>" . $goedkeuren . "</td>";
            echo "<td>" . $verkiezingID . "</td>";
            echo "<td><form action='partijen_wijzig.php' method='post'><input type='submit' value='Wijzigen'>
			        <input type='hidden' name='partijID' value=" . $partijID . " ></form>";
            echo "<td> <form action='partijen_verwijderen.php' method='post'><input type='submit' value='Verwijderen'>
			<input type='hidden' name='PartijNaam' value=" . $partijNaam . " >
			<input type='hidden' name='partijID' value=" . $partijID . " ></form>";
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

    public function Partijen_bijwerken()
    {
        $conn = dbConnect();

        $partijID = $_POST['partijID'];
        $partijNaam = $_POST['PartijNaam'];
        $Afkorting = $_POST['Afkorting'];
        $goedkeuren = $_POST['Goedkeuren'];
        $verkiezingID = $_POST['VerkiezingID'];

        $sql = "UPDATE parijenperverkiezingen SET partijID='$partijID', PartijNaam='$partijNaam', Afkorting='$Afkorting', Goedkeuren='$goedkeuren', VerkiezingID='$verkiezingID' WHERE partijID='$partijID'";
        return $conn->query($sql);
    }


    public function Partijen_verwijderen()
    {
        $conn = dbConnect();

        $partijID = $_POST['partijID'];

        $sql = "DELETE FROM parijenperverkiezingen WHERE partijID='$partijID'";
        return $conn->exec($sql);
    }

}

?>