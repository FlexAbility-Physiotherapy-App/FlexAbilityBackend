<?php
    // Database credentials
    $host="localhost";
    $uname="root";
    $pass="";
    $dbname="flexability";

    // Get the POST parameters
    $physio_id= $_GET['physio_id'];
    $patient_id= $_GET['patient_id'];
    $timestamp= $_GET['timestamp'];
    $comment= $_GET['comment'];

    // Establish a database connection
    $conn = new mysqli($host, $uname, $pass, $dbname);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Or alltogether
    $sql = "UPDATE patient_physio SET comment='$comment', status='Complete' WHERE patient_id=$patient_id AND physio_id=$physio_id AND timestamp='$timestamp'";

    if(mysqli_query($conn, $sql)) {
        echo "Appointment completed successfully.";
    }
    else{
        echo mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);

?>
