<?php
    require('config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $timestamp = $_GET["timestamp"];

        $sql = "SELECT id FROM physio;";
        $result = $conn->query($sql);
        $allPhysioIds = array();
        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $allPhysioIds[] = $row['id'];
            }
        }

        $sql = "SELECT physio_id FROM patient_physio WHERE timestamp = '$timestamp';";
        $result = $conn->query($sql);
        $reservedPhysioIds = array();
        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reservedPhysioIds[] = $row['physio_id'];
            }
        }
        $availablePhysioIds = array_diff($allPhysioIds, $reservedPhysioIds);

        $physioObjects = array();
        $physioIdsString = implode(',', $availablePhysioIds);
        $sql = "SELECT name, phone_number, id FROM physio WHERE id IN ($physioIdsString)";
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $physioObject = (object) $row;
                $physioObjects[] = $physioObject;
            }
        }
        
        $json = json_encode($physioObjects);
        header('Content-Type: application/json');
        echo $json;
    }

    $conn->close();
?>