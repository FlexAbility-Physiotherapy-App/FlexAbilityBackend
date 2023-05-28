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

    // Establish a database connection
    $conn = new mysqli($host, $uname, $pass, $dbname);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Or alltogether
    $sql = "UPDATE patient_physio SET status='rejected' WHERE patient_id=$patient_id AND physio_id=$physio_id AND timestamp='$timestamp'";

    if(mysqli_query($conn, $sql)) {
        echo "Appointment was rejected.";
    }
    else{
        echo mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
?>
