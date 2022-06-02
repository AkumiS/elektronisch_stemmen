<?php
include "connect.php";
include "Gebruiker.php";
$conn = DbConnect();

$gebruiker = new Gebruiker($conn);

$gebruiker->zetGebruiker();
?>


