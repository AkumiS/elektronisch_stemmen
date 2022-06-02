<?php
class Gebruiker{

    public function zetGebruiker(){

        //Toon gebruiker form
        include "gebruiker_toevoegen.php";
    }

    public function Gebruiker_Zoeken()
    {
        $conn = dbConnect();
        //include 'gebruiker_Zoek.php';

        $gebruikerID = $_POST['GebruikerID'];

        $gebruiker = $conn->prepare(" SELECT * FROM gebruiker WHERE GebruikerID = '$gebruikerID'");
        $gebruiker->execute();
        return $gebruiker;
    }
    public function toonGebruiker($ZoekGebruiker){
        echo "<table border=1 class= table>";
        echo "<tr>";
        echo "<th>Gebruiker ID</th>";
        echo "<th>Gebruikersnaam</th>";
        echo "<th>Email</th>";
        echo "<th>Leeftijd</th>";
        echo "<th>Indentiteit</th>";
        echo "<th>Macht</th>";
        echo "</tr>";
        foreach ($ZoekGebruiker as $row)
        {
            $gebruikerID = $row['GebruikerID'];
            $gebruikerNaam = $row['Gebruikersnaam'];
            $gebruikerEmail = $row['Email'];
            $leeftijd = $row['Leeftijd'];
            $indentiteit = $row['Indentiteit'];
            $macht = $row['Macht'];

            echo "<tr>";
            echo "<td>" . $gebruikerID . "</td>";
            echo "<td>" . $gebruikerNaam . "</td>";
            echo "<td>" . $gebruikerEmail . "</td>";
            echo "<td>" . $leeftijd . "</td>";
            echo "<td>" . $indentiteit . "</td>";
            echo "<td>" . $macht . "</td>";
            echo "<td><form action='gebruiker_wijzig.php' method='post'><input type='submit' value='Wijzigen'>
			        <input type='hidden' name='GebruikerID' value=" . $gebruikerID . " ></form>";
            echo "<td> <form action='gebruiker_verwijderen.php' method='post'><input type='submit' value='Verwijderen'>
            <input type='hidden' name='Gebruikersnaam' value=" . $gebruikerNaam . " >
			<input type='hidden' name='GebruikerID' value=" . $gebruikerID . " ></form>";
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

    public function Gebruiker_bijwerken()
    {
        $conn = dbConnect();

        $gebruikerID = $_POST['GebruikerID'];
        $gebruikerNaam = $_POST['Gebruikersnaam'];
        $gebruikerEmail = $_POST['Email'];
        $leeftijd = $_POST['Leeftijd'];
        $indentiteit = $_POST['Indentiteit'];
        $macht = $_POST['Macht'];

        $sql = "UPDATE gebruiker SET GebruikerID='$gebruikerID', Gebruikersnaam='$gebruikerNaam', Email='$gebruikerEmail', Leeftijd='$leeftijd', Indentiteit='$indentiteit', Macht='$macht' WHERE GebruikerID='$gebruikerID'";
        return $conn->query($sql);
    }


    public function Gebruiker_verwijderen()
    {
        $conn = dbConnect();

        $gebruikerID = $_POST['GebruikerID'];

        $sql = "DELETE FROM gebruiker WHERE GebruikerID = '$gebruikerID'";
        return $conn->exec($sql);
    }

}

?>