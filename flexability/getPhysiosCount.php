<?php
    require('config.php');

    // Check if it's a GET request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // Prepare the SQL statement to fetch the count of physios
        $stmt = $conn->prepare("SELECT COUNT(*) FROM `physio`");

        // Execute the statement
        $stmt->execute();

        // Bind the result variable
        $stmt->bind_result($physiosCount);

        // Fetch the count of physios
        $stmt->fetch();

        // Close the statement
        $stmt->close();

        // Prepare the response array
        $response = array(
            'totalphysios' => $physiosCount
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