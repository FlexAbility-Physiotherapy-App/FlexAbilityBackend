<?php
    // Database credentials
    $host="localhost";
    $uname="root";
    $pass="";
    $dbname="flexability";

    // Get the POST parameters
    $name = $_GET['name'];
    $id = $_GET['id'];
    $cost = $_GET['cost'];
    $description = $_GET['description'];

    // Establish a database connection
    $conn = new mysqli($host, $uname, $pass, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Connection successful
    echo "Connected successfully.<br>";

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO `provision` (`id`, `description`, `cost`, `name`) VALUES (?, ?, ?, ?)");

    // Bind the parameters to the statement
    $stmt->bind_param("ssds", $id, $description, $cost, $name);

    // Execute the statement
    if ($stmt->execute()) {
        // The provision entry was successfully created
        echo "Provision entry created successfully.";
    } else {
        // An error occurred while creating the provision entry
        echo "Error creating provision entry: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
?>
