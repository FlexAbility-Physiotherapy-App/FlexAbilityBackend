<?php
    require('config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $patinet_id = $_GET["patient_id"];
        $physio_id = $_GET["physio_id"];
        $timestamp = $_GET["timestamp"];

        $sql = "INSERT INTO `patient_physio` (`patient_id`, `physio_id`, `timestamp`, `status`, `cost`, `comment`, `send_timestamp`, `provision_id`) 
                VALUES ('$patinet_id', '$physio_id', '$timestamp', 'pending', NULL, NULL, NULL, NULL);";
        $result = $conn->query($sql);
    }

    $conn->close();
?>