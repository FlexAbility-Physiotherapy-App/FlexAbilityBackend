<?php
	require('config.php');
		
	// Get the POST parameters
	$name = $_GET['name'];
	$address = $_GET['address'];
	$phone = $_GET['phone'];
	$afm = $_GET['afm'];

	$password = "1234";
	$category = "physio";

	// Prepare the SQL statement to insert the user
	$stmt = $conn->prepare("INSERT INTO `user` (`username`, `password`, `category`) VALUES (?, ?, ?)");

	// Bind the parameters to the statement
	$stmt->bind_param("sss", $afm, $password, $category);

	// Execute the statement
	if ($stmt->execute()) {
		// The user entry was successfully created

		// Get the ID of the newly created user
		$id = $stmt->insert_id;

		echo "User entry created successfully.";
	} else {
		// An error occurred while creating the user entry
		echo "Error creating User entry: " . $stmt->error;
	}
	$stmt->close();

	// Prepare the SQL statement to insert the patient
	$stmt = $conn->prepare("INSERT INTO `physio` (`id`, `name`, `address`, `phone_number`, `afm`) VALUES (?, ?, ?, ?, ?)");

	// Bind the parameters to the statement
	$stmt->bind_param("issss", $id, $name, $address, $phone, $afm);

	// Execute the statement
	if ($stmt->execute()) {
		// The patient entry was successfully created
		echo "Patient entry created successfully.";
	} else {
		// An error occurred while creating the patient entry
		echo "Error creating Patient entry: " . $stmt->error;
	}

	// Close the statement
	$stmt->close();
?>
