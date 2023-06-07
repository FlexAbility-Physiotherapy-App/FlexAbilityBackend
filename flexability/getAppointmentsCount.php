<?php 
	// Database credentials
    require('config.php');
	
	// Check if it's a GET request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // Get parameters date and id
        $date = isset($_GET['date']) ? $_GET['date'] : '';
        $physio = isset($_GET['id']) ? intval($_GET['id']) : null;

        // Prepare the SQL statement to fetch the count of appointments
        $stmt = $conn->prepare("SELECT COUNT(patient_physio.timestamp) 
                                FROM patient
                                INNER JOIN patient_physio ON patient.id = patient_physio.patient_id
                                WHERE DATE(patient_physio.timestamp) = ? AND patient_physio.status = 'accepted' AND patient_physio.physio_id = ?");
        $stmt->bind_param("si", $date, $physio);
        
        // Execute the statement
        $stmt->execute();

        // Bind the result variable
        $stmt->bind_result($appointmentCount);

        // Fetch the count of appointments
        $stmt->fetch();

        // Close the statement
        $stmt->close();

        // Prepare the response JSON
        $response = array(
            'totalAppointments' => $appointmentCount
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