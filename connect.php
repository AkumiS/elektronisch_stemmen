<?php
function DbConnect(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $myDB = "elektronisch_stemmen";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
?>
