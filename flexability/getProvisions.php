<?php
    // Database credentials
    $host="localhost";
    $uname="root";
    $pass="";
    $dbname="flexability";

    // Establish a database connection
    $conn = new mysqli($host, $uname, $pass, $dbname);

    // Check if it's a GET request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // Get the optional limit parameter from the URL
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : null;

        // Prepare the SQL statement to fetch provisions with optional limit
        if ($limit !== null && $limit > 0) {
            $stmt = $conn->prepare("SELECT `name`, `id` AS `code`, `cost`, `description` FROM `provision` ORDER BY `id` DESC LIMIT ?");
            $stmt->bind_param("i", $limit);
        } else {
            $stmt = $conn->prepare("SELECT `name`, `id` AS `code`, `cost`, `description` FROM `provision`");
        }
        
        // Execute the statement
        $stmt->execute();

        // Bind the result variables
        $stmt->bind_result($name, $code, $cost, $description);

        // Create an empty array to store provisions
        $provisions = array();

        // Fetch provisions and add them to the array
        while ($stmt->fetch()) {
            $provisions[] = array(
            'name' => $name,
            'code' => $code,
            'cost' => $cost,
            'description' => $description
            );
        }

        // Close the statement
        $stmt->close();

        // Prepare the response JSON
        $response = array(
            'provisions' => $provisions
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
