<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ujikom8";

    $conn = new mysqli($host, $user, $pass, $db);
    // Check connection    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
?>