<?php
    require('config.php');

    // Get the POST parameters
    $id = $_GET['id'];
	$name = $_GET['name'];
    $address = $_GET['address'];
    $phone = $_GET['phone_number'];
    $ssn = $_GET['ssn'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO `physio` (`id`, `address`, `name`, `owner`, 'afm', 'phone_number') VALUES (?, ?, ?, ?, ?, ?)");

    // Bind the parameters to the statement
    $stmt->bind_param("ssds", $id, $address, $name, $owner, $afm, $phone_number);

    // Execute the statement
    if ($stmt->execute()) {
        // The physio entry was successfully created
        echo "Physio entry created successfully.";
    } else {
        // An error occurred while creating the physio entry
        echo "Error creating physio entry: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
?>