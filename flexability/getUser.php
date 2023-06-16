<?php 
	// Database credentials
    require('config.php');
	
	// Check if it's a GET request
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = 0;
        $usname = null;
        $pword = null;
        $category = null;
        
        // Get parameters username and password
        $username = isset($_GET['username']) ? $_GET['username'] : '';
        $password = isset($_GET['password']) ? $_GET['password'] : '';

        // Prepare the SQL statement to fetch the user
        if ($username !== null && $password !== null) {
            $stmt = $conn->prepare("SELECT user.id, user.username, user.password, user.category
                                    FROM user
                                    WHERE user.username = ? AND user.password = ?");
            $stmt->bind_param("ss", $username, $password);
        }
        else{
            exit();
        }
        
        // Execute the statement
        $stmt->execute();

        // If SQL result is empty: exit
        if(!($stmt->num_rows == 0)){
            exit();
        }

        // Bind the result variable
        $stmt->bind_result($id, $usname, $pword, $category);

        // Fetch the user
        $stmt->fetch();

        // Close the statement
        $stmt->close();

        // Prepare the response JSON
        $response = array(
            'id' => $id,
            'username' => $usname,
            'password' => $pword,
            'category' => $category
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