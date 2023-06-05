<?php
    // Database credentials
    require('config.php');

    // Check if it's a GET request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // Get the optional limit parameter from the URL and parameters date and id
        $patient = isset($_GET['pid']) ? intval($_GET['pid']) : null;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : null;

        // Prepare the SQL statement to fetch transactions with optional limit
        if ($limit !== null && $limit > 0) {
            $stmt = $conn->prepare("SELECT pp.timestamp, pp.physio_id, pp.cost, p.name, pr.name
                                    FROM patient_physio pp
                                    INNER JOIN physio p ON pp.physio_id = p.id
                                    INNER JOIN provision pr ON pp.provision_id = pr.id
                                    WHERE pp.patient_id = ?
                                    ORDER BY physio_id ASC 
                                    LIMIT ?");
            $stmt->bind_param("ii", $patient, $limit);
        } else {
            $stmt = $conn->prepare("SELECT pp.timestamp, pp.physio_id, pp.cost, p.name, pr.name
                                    FROM physio p
                                    JOIN patient_physio pp ON pp.physio_id = p.id
                                    JOIN provision pr ON pr.id = pp.provision_id
                                    WHERE pp.patient_id = ?
                                    ORDER BY physio_id ASC");
            $stmt->bind_param("i", $patient);
        }
        
        
        // Execute the statement
        $stmt->execute();

        // Bind the result variables
        $stmt->bind_result($time, $id, $cost, $ph_name, $pr_name);

        // Create an empty array to store transactions
        $transactions = array();

        // Fetch transactions and add them to the array
        while ($stmt->fetch()) {
            $transactions[] = array(
            'date' => $time,
            'id' => $id,
            'cost' => $cost,
            'ph_name' => $ph_name,
            'pr_name' => $pr_name
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

