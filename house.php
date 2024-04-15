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
    $electricity = $_POST['electricity'] ?? 0;
    $natural_gas = $_POST['natural-gas'] ?? 0;
    $heating_oil = $_POST['heating-oil'] ?? 0;
    $propane = $_POST['propane'] ?? 0;
    $lgp = $_POST['lgp'] ?? 0;

    // Calculate the carbon footprint for each utility type
    $electricity_footprint = $electricity * 0.4071; // assuming the factor is kgCO2e per kWh for electricity
    // Add similar calculations for natural gas, heating oil, propane, and lgp here
    // ...

    // Sum the footprints for total
    $total_footprint = $electricity_footprint; // add the rest of the footprints

    // Convert the total footprint from kg to metric tons
    $total_footprint_metric_tons = $total_footprint / 1000;

    // Insert the data into the database
    $sql = "INSERT INTO houseult (electricity, natural_gas, heating_oil, propane, lgp, carbon_footprint)
            VALUES ('$electricity', '$natural_gas', '$heating_oil', '$propane', '$lgp', '$total_footprint_metric_tons')";

    if ($conn->query($sql) === TRUE) {
        echo "Data and carbon footprint inserted successfully. Total House Utilities Footprint: $total_footprint_metric_tons Metric Tons of CO2e";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
