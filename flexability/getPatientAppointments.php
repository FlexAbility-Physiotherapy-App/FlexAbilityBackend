<?php
    require('config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET["patient_id"];

        $appointments = array();

        $sql = "SELECT * FROM patient_physio
                INNER JOIN physio ON patient_physio.physio_id = physio.id
                WHERE patient_id = '$id';";
        $result = $conn->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            $upcomingAppointmentTimestamp = null;
            $physioName = null;
            while ($row = $result->fetch_assoc()) {
                $newAppointment = array();
                $appointmentTimestamp = $row['timestamp'];
                $physioName = $row['name'];
                $newAppointment = explode(" ", $appointmentTimestamp);
                array_push($newAppointment, $physioName);
                array_push($appointments, $newAppointment);
            }
        }
        
        
        $json = json_encode($appointments);
        header('Content-Type: application/json');
        echo $json;
    }

    $conn->close();
?>