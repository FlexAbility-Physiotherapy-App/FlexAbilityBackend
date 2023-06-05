<?php
    require('config.php');

    // Check if it's a GET request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // Get the optional limit parameter from the URL
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : null;

        // Prepare the SQL statement to fetch physios with optional limit
        if ($limit !== null && $limit > 0) {
            $stmt = $conn->prepare("SELECT `id`, `name`, `address`, `phone_number`, `afm` FROM `physio` ORDER BY `name` ASC LIMIT ?");
            $stmt->bind_param("i", $limit);
        } else {
            $stmt = $conn->prepare("SELECT `id`, `name`, `address`, `phone_number`, `afm` FROM `physio` ORDER BY `name` ASC");
        }
        
        // Execute the statement
        $stmt->execute();

        // Bind the result variables
        $stmt->bind_result($id, $name, $address, $phone, $ssn);

        // Create an empty array to store physios
        $physios = array();

        // Fetch physios and add them to the array
        while ($stmt->fetch()) {
            $physios[] = array(
			'id' => $id,
            'name' => $name,
            'address' => $address,
            'phone_number' => $phone,
            'afm' => $ssn
            );
        }

        // Close the statement
        $stmt->close();

        // Prepare the response JSON
        $response = array(
            'physios' => $physios
        );

        // Convert the response to JSON format
        $json = json_encode($response);

        // Set the content type to JSON
        header('Content-Type: application/json');

        // Return the JSON response
        echo $json;
    }

    // Close the database connection
    $conn->close();

?>