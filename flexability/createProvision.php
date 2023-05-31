<?php
    require('config.php');

    // Get the POST parameters
    $name = $_GET['name'];
    $id = $_GET['id'];
    $cost = $_GET['cost'];
    $description = $_GET['description'];

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
