<?php
session_start();

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
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Prepare SQL Query to check if user exists and password is correct
    $sql = "SELECT id, password FROM users WHERE username = '$username'";
    
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['password']==$password) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            echo "Redirecting to home.html";
            header("Location: home.html"); // Redirect to a logged-in page
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that username";
    }

    $result->close();
}

$conn->close();
?>
