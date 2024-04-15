<?php
// Database connection parameters
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
    $food_drinks = $_POST['food-drinks'] ?? 0;
    $time_period = $_POST['time-period'] ?? '';
    $diet_type = $_POST['diet-type'] ?? '';

    // Calculate the carbon footprint based on the diet type
    $carbon_footprint = calculateDietFootprint($food_drinks, $time_period, $diet_type);

    // Insert the data into the database
    $sql = "INSERT INTO diets (food_drinks, time_period, diet_type, carbon_footprint)
            VALUES ('$food_drinks', '$time_period', '$diet_type', '$carbon_footprint')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully. Your Diet Footprint: $carbon_footprint Metric Tons of CO2e";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

// Function to calculate diet footprint based on food expenditure and diet type
function calculateDietFootprint($expenditure, $time_period, $diet_type) {
    $emission_factors = [
        'low_meat' => 0.003, // Metric tons CO2e per unit of currency
        'high_meat' => 0.004,
        'pescatarian' => 0.0035,
        'vegan' => 0.0025
    ];
    
    // Convert expenditure to a yearly amount if necessary
    switch ($time_period) {
        case 'week':
            $expenditure *= 52; // weeks per year
            break;
        case 'month':
            $expenditure *= 12; // months per year
            break;
        case 'year':
            // already in yearly terms
            break;
    }
    
    // Use the diet type to get the emission factor and calculate the footprint
    $emission_factor = $emission_factors[strtolower($diet_type)] ?? 0.003; // Default to low meat if not set
    $carbon_footprint = $expenditure * $emission_factor; // Calculate the footprint
    
    return $carbon_footprint; // Returns carbon footprint in metric tons
}
?>
