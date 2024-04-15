<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are provided
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Sanitize and validate the input data
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        // You may perform further validation here, such as checking username uniqueness

        // Connect to your database
        $servername = "localhost"; // Your database server name
        $db_username = "root"; // Your database username
        $db_password = ""; // Your database password
        $dbname = "helpcarbon"; // Your database name

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute SQL statement to insert the user into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful, redirect to login page
            header("Location: login.html");
            exit; // Make sure to exit after redirection
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        // If username or password is not provided
        echo "Both username and password are required";
    }
} else {
    // If the form is not submitted via POST method
    echo "Invalid request";
}
?>
