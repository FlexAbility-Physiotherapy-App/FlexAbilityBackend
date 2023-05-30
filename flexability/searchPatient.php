<?php
	require('config.php');
	
    // Check if it's a GET request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // Get the amka parameter from the URL
        $amka = isset($_GET['amka']) ? ($_GET['amka']) : null;

        // Prepare the SQL statement to fetch provisions with optional limit
        if ($amka !== null) {
            $stmt = $conn->prepare("SELECT `name`, `surname` FROM `patient` WHERE amka = ? LIMIT 1");
            $stmt->bind_param('s',$amka);
        } else {
            exit();
        }
        
        // Execute the statement
        $stmt->execute();

        // Bind the result variables
        $stmt->store_result();

        // If SQL result is empty: exit
        if(!($stmt->num_rows > 0)){
            exit();
        }

        $stmt->bind_result($name, $surname);

        // Create an empty array to store provisions
        // $patient = array();

        // Fetch provisions and add them to the array
        while ($stmt->fetch()) {
            $data = ['name' => $name, 'surname' => $surname];
        }

        // Close the statement
        $stmt->close();

        // Prepare the response JSON
        // $response = array(
        //     'patient' => $patient
        // );

        // Convert the response to JSON format
        $json = json_encode($data);

        // Set the content type to JSON
        header('Content-Type: application/json');

        // Return the JSON response
        echo $json;
    }

    // Close the database connection
    $conn->close();

?>
