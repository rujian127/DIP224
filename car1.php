<?php
$servername = "localhost";
$username = "root";
$password = ""; // Leave empty if no password is set for your MySQL root user
$dbname = "helpcarbon"; // Replace with the name of your MySQL database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $mileage = $_POST['mileage'] ?? '';
    $years = $_POST['years'] ?? '';
    $manufacturers = $_POST['manufacturers'] ?? '';
    $model = $_POST['model'] ?? '';
    $efficiency = $_POST['efficiency'] ?? '';
    $fuel_type = $_POST['fuel_type'] ?? '';
    

    // Calculate the carbon footprint
    // Define a coefficient for CO2e emissions per km per unit efficiency
    $co2e_coefficient = 0.239; // Example: 239 grams CO2e per km per L/100km
    $total_co2e = ($mileage * $efficiency * $co2e_coefficient) / 1000000; // Converts g/km to metric tons

    // Insert the data into the database
    $sql = "INSERT INTO cars (mileage, years, manufacturers, model, efficiency, fuel_type, carbon_footprint)
            VALUES ('$mileage', '$years', '$manufacturers', '$model', '$efficiency', '$fuel_type', '$total_co2e')";

if ($conn->query($sql) === TRUE) {
    echo "Data and carbon footprint inserted successfully. Total Car Footprint: $total_co2e Metric Tons of CO2e";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close connection
$conn->close();
?>
