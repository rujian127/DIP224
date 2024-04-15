<?php
// Enable error reporting for debugging (remove this in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpcarbon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure all expected POST variables are set to avoid undefined index notices
    if (isset($_POST['userName'], $_POST['userId'], $_POST['email'], $_POST['country'], $_POST['dob'])) {
        $userName = $conn->real_escape_string($_POST['userName']);
        $userId = $conn->real_escape_string($_POST['userId']);
        $email = $conn->real_escape_string($_POST['email']);
        $country = $conn->real_escape_string($_POST['country']);
        $dob = $conn->real_escape_string($_POST['dob']);

        // Prepare SQL Query to insert/update the user profile
        $sql = "INSERT INTO profiles (userName, userId, email, country, dob) VALUES (?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE userName=VALUES(userName), email=VALUES(email), country=VALUES(country), dob=VALUES(dob)";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssss", $userName, $userId, $email, $country, $dob);

            // Execute and check
            if ($stmt->execute()) {
                echo "Profile updated successfully";
                // Optionally redirect or perform other success actions
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "All form fields must be filled out.";
    }
} else {
    echo "No data received";
}

// Close connection
$conn->close();
?>