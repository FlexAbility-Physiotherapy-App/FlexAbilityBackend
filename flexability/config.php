<?php
   $host = 'localhost';
   $uname = 'root';
   $pass = '';
   $dbname = "flexability";
   $port = 3307;

   $conn = new mysqli($host, $uname, $pass, $dbname, $port);

   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>
