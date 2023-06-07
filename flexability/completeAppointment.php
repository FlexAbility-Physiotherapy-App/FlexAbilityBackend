<?php
    // Database credentials
    require "config.php";

    // Get the POSTed parameters
    $physio_id= $_GET['physio_id'];
    $patient_id= $_GET['patient_id'];
    $timestamp= $_GET['timestamp'];
    $comment= $_GET['comment'];

    // Construct query
    $sql = "UPDATE patient_physio SET comment='$comment', status='complete' WHERE patient_id=$patient_id AND physio_id=$physio_id AND timestamp='$timestamp'";

    // Print result
    if(mysqli_query($conn, $sql)) {
        echo "Appointment completed successfully.";
    }
    else{
        echo mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);

?>
