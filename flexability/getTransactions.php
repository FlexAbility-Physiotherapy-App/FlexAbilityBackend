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

        // Get the optional limit parameter from the URL and parameters date and id
        // $date = isset($_GET['date']) ? $_GET['date'] : '';
        // $physio = isset($_GET['id']) ? intval($_GET['id']) : null;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : null;

        // Prepare the SQL statement to fetch transactions with optional limit
        if ($limit !== null && $limit > 0) {
            $stmt = $conn->prepare("SELECT timestamp, physio_id, cost, name 
                                    FROM patient_physio pp
                                    INNER JOIN physio p ON pp.physio_id = p.id
                                    ORDER BY physio_id ASC 
                                    LIMIT ?");
            $stmt->bind_param("i", $limit);
        } else {
            $stmt = $conn->prepare("SELECT timestamp, physio_id, cost, name
                                    FROM patient_physio pp
                                    INNER JOIN physio p ON pp.physio_id = p.id
                                    ORDER BY physio_id ASC ");
            // $stmt->bind_param("si", $date, $physio);
        }
        
        
        // Execute the statement
        $stmt->execute();

        // Bind the result variables
        $stmt->bind_result($time, $id, $cost, $name);

        // Create an empty array to store transactions
        $transactions = array();

        // Fetch transactions and add them to the array
        while ($stmt->fetch()) {
            $transactions[] = array(
            'date' => $time,
            'id' => $id,
            'cost' => $cost,
            'name' => $name
            );
        }

        // Close the statement
        $stmt->close();

        // Prepare the response JSON
        $response = array(
            'transactions' => $transactions
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
