<?php
	require('config.php');
		
	// Get the POST parameters
	$name = $_GET['name'];
	$surname = $_GET['surname'];
	$address = $_GET['address'];
	$phone = $_GET['phone'];
	$amka = $_GET['amka'];
	$sex = $_GET['sex'];

	$password = "1234";
	$category = "patient";

	// Prepare the SQL statement to insert the user
	$stmt = $conn->prepare("INSERT INTO `user` (`username`, `password`, `category`) VALUES (?, ?, ?)");

	// Bind the parameters to the statement
	$stmt->bind_param("sss", $amka, $password, $category);

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
	$stmt = $conn->prepare("INSERT INTO `patient` (`id`, `name`, `surname`, `phone_number`, `sex`, `amka`) VALUES (?, ?, ?, ?, ?, ?)");

	// Bind the parameters to the statement
	$stmt->bind_param("isssss", $id, $name, $surname, $phone, $sex, $amka);

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
