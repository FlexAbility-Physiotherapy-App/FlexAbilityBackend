<?php
	require('config.php');
	
    // Get the POST parameters
    $physio_id= $_GET['physio_id'];
    $patient_id= $_GET['patient_id'];
    $timestamp= $_GET['timestamp'];

    // Or alltogether
    $sql = "DELETE FROM patient_physio WHERE patient_id = $patient_id AND physio_id = $physio_id AND timestamp = '$timestamp'";

    if(mysqli_query($conn, $sql)) {
        echo "Appointment was rejected.";
    }
    else{
        echo mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
?>
