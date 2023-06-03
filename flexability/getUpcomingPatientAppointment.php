<?php
    require('config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET["patient_id"];

        $upcomingAppointment = array();

        $sql = "SELECT * FROM patient_physio
                INNER JOIN physio ON patient_physio.physio_id = physio.id
                WHERE patient_id = '$id' ORDER BY timestamp ASC LIMIT 1;";
        $result = $conn->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            $upcomingAppointmentTimestamp = null;
            $physioName = null;
            while ($row = $result->fetch_assoc()) {
                $upcomingAppointmentTimestamp = $row['timestamp'];
                $physioName = $row['name'];
                $upcomingAppointment = explode(" ", $upcomingAppointmentTimestamp);
                array_push($upcomingAppointment, $physioName);
            }
        }
        
        
        $json = json_encode($upcomingAppointment);
        header('Content-Type: application/json');
        echo $json;
    }

    $conn->close();
?>