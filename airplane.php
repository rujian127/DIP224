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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $from1 = $_POST['from1'] ?? '';
    $to1 = $_POST['to1'] ?? '';
    $class = $_POST['class'] ?? '';
    $trips = $_POST['trips'] ?? '';
    $trip_type = $_POST['trip_type'] ?? '';

    // Placeholder for distance calculation based on airport codes - this will need to be implemented
    $distance = getFlightDistance($from1, $to1); // Function to calculate the distance between airports

    // Placeholder for emission factor retrieval based on flight class - this will need to be implemented
    $emission_factor = getEmissionFactor($class); // Function to get emission factor based on the class

    // Calculate the carbon footprint (assuming $distance is in kilometers and $emission_factor in kgCO2e per km)
    // This will also assume $trips is the total number of one-way trips
    $carbon_footprint = $distance * $emission_factor * $trips;

    // If it's a return trip, double the footprint
    if ($trip_type === 'return') {
        $carbon_footprint *= 2;
    }

    // Convert the carbon footprint to metric tons
    $carbon_footprint_metric_tons = $carbon_footprint / 1000;

    // Insert the data into the database
    $sql = "INSERT INTO airplane (from1, to1, class, trips, trip_type, carbon_footprint)
            VALUES ('$from1', '$to1', '$class', '$trips', '$trip_type', '$carbon_footprint_metric_tons')";

    if ($conn->query($sql) === TRUE) {
        echo "Data and carbon footprint inserted successfully. Total Flight Footprint: $carbon_footprint_metric_tons Metric Tons of CO2e";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();

// Functions to calculate distance and emission factor (placeholders - need proper implementation)
function getFlightDistance($from, $to) {
    // Implement the logic or API call to get the distance between $from and $to airports
    return 1000; // Example distance in kilometers
}

function getEmissionFactor($class) {
    // Define emission factors for different classes
    // These values are examples and should be based on accurate data or APIs
    $factors = [
        'economy' => 0.15,
        'business' => 0.30,
        'first_class' => 0.40
    ];
    return $factors[strtolower($class)] ?? 0.15; // Default to economy if not set
}
?>
