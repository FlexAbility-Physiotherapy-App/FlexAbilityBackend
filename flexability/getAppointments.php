<?php 
	// Database credentials
    $host="localhost";
	$uname="root";
	$pass="";
	$dbname="flexability";
	
	// Establish a database connection
	$conn = mysqli_connect($host,$uname,$pass,$dbname) or die("cannot connect");
	
	// Check if it's a GET request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // Get the optional limit parameter from the URL and parameters date and id
        $date = isset($_GET['date']) ? $_GET['date'] : '';
        $physio = isset($_GET['id']) ? intval($_GET['id']) : null;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : null;

        // Prepare the SQL statement to fetch appointments with optional limit
        if ($limit !== null) {
            $stmt = $conn->prepare("SELECT patient.name, patient.surname, patient.amka, patient_physio.timestamp 
                                    FROM patient
                                    INNER JOIN patient_physio ON patient.id = patient_physio.patient_id
                                    WHERE DATE(patient_physio.timestamp) = ? AND patient_physio.status = 'accepted' AND patient_physio.physio_id = ?
                                    ORDER BY patient_physio.timestamp ASC
                                    LIMIT ?");
            $stmt->bind_param("sii", $date, $physio, $limit);
        }
        else {
            $stmt = $conn->prepare("SELECT patient.name, patient.surname, patient.amka, patient_physio.timestamp 
                    FROM patient
                    INNER JOIN patient_physio ON patient.id = patient_physio.patient_id
                    WHERE DATE(patient_physio.timestamp) = ? AND patient_physio.status = 'accepted' AND patient_physio.physio_id = ?
                    ORDER BY patient_physio.timestamp ASC");
            $stmt->bind_param("si", $date, $physio);
        }
        
        // Execute the statement
        $stmt->execute();

        // Bind the result variables
        $stmt->bind_result($name, $surname, $amka, $timestamp);

        // Create an empty array to store appointments
        $appointments = array();

        // Fetch appointments and add them to the array
        while ($stmt->fetch()) {
            $appointments[] = array(
            'name' => $name,
            'surname' => $surname,
            'amka' => $amka,
			'timestamp' => $timestamp
            );
        }

        // Close the statement
        $stmt->close();

        // Prepare the response JSON
        $response = array(
            'appointments' => $appointments
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
