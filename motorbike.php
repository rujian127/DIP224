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
    $mileage = $_POST['mileage'] ?? 0;
    $type = $_POST['type'] ?? '';
    $efficiency = $_POST['efficiency'] ?? 0;

    // Calculate the carbon footprint
    $carbon_footprint = calculateMotorbikeFootprint($mileage, $type, $efficiency);

    // Insert the data into the database
    $sql = "INSERT INTO motorbikes (mileage, type, efficiency, carbon_footprint)
            VALUES ('$mileage', '$type', '$efficiency', '$carbon_footprint')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully. Total Motorbike Footprint: $carbon_footprint Metric Tons of CO2e";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

function calculateMotorbikeFootprint($mileage, $type, $efficiency) {
    // Assuming $efficiency is in L/100km and $mileage is in km, emission factor is in gCO2e/km.
    // You'll need to replace this with the actual emission factors based on the motorbike type.
    $emission_factors = [
        'small' => 0.08, // Example emission factor for small motorbikes
        'medium' => 0.12, // Example for medium motorbikes
        'large' => 0.15 // Example for large motorbikes
    ];

    $emission_factor = $emission_factors[strtolower($type)] ?? 0.08; // Default to small if not set
    // Convert L/100km to km/L then multiply by mileage and emission factor, and convert to metric tons
    $carbon_footprint = ($mileage / (100 / $efficiency)) * $emission_factor / 1000; 
    return $carbon_footprint; // Returns carbon footprint in metric tons
}
?>
