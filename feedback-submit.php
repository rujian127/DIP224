<?php
$servername = "localhost"; // replace with your database host
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "helpcarbon"; // replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Retrieve form data
$question1 = $_POST['question1'];
$question2 = $_POST['question2'];
$question3 = $_POST['question3'];
$question4 = $_POST['question4'];
$opinion = $_POST['opinion'];

// Check if 'rate' field is set
$rate = isset($_POST['rate']) ? $_POST['rate'] : null;

// SQL query to insert form data into the database
$sql = "INSERT INTO feedback (question1, question2, question3, question4, rate, opinion) VALUES ('$question1', '$question2', '$question3', '$question4', '$rate', '$opinion')";

if ($conn->query($sql) === TRUE) {
    echo "Thank you for giving feedback!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
