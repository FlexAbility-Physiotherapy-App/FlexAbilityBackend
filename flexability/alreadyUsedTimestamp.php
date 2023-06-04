<?php
    require('config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET["patient_id"];
        $timestamp = $_GET["timestamp"];

        $sql = "SELECT * FROM patient_physio WHERE patient_id = '$id' AND timestamp = '$timestamp';";
        $result = $conn->query($sql);
        $isUsed = false;
        if ($result !== false && $result->num_rows > 0) {
            $isUsed = true;
        }
        
        
        $json = json_encode($isUsed);
        header('Content-Type: application/json');
        echo $json;
    }

    $conn->close();
?>