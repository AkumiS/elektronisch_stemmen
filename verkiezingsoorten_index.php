<?php
include "connect.php";
include "Verkiezingsoorten.php";
$conn = DbConnect();

$verkiezing = new Verkiezingsoorten($conn);

$verkiezing->zetVerkiezingsoorten();
?>


