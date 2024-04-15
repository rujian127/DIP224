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
    $bus = $_POST['bus'] ?? 0;
    $lrt_mrt = $_POST['lrt_mrt'] ?? 0;
    $commuter_trains = $_POST['commuter_trains'] ?? 0;
    $monorails = $_POST['monorails'] ?? 0;
    $taxi_ride_hailing = $_POST['taxi_ride_hailing'] ?? 0;
    $ferries = $_POST['ferries'] ?? 0;
    $express_rail_link = $_POST['express_rail_link'] ?? 0;

    // Calculate the carbon footprint for each transport type
    $bus_footprint = calculateTransportFootprint($bus, 'bus');
    $lrt_mrt_footprint = calculateTransportFootprint($lrt_mrt, 'lrt_mrt');
    $commuter_trains_footprint = calculateTransportFootprint($commuter_trains, 'commuter_trains');
    $monorails_footprint = calculateTransportFootprint($monorails, 'monorails');
    $taxi_ride_hailing_footprint = calculateTransportFootprint($taxi_ride_hailing, 'taxi_ride_hailing');
    $ferries_footprint = calculateTransportFootprint($ferries, 'ferries');
    $express_rail_link_footprint = calculateTransportFootprint($express_rail_link, 'express_rail_link');

    // Sum the footprints for total
    $total_footprint = $bus_footprint + $lrt_mrt_footprint + $commuter_trains_footprint + 
                       $monorails_footprint + $taxi_ride_hailing_footprint + $ferries_footprint + 
                       $express_rail_link_footprint;

    // Insert the data into the database
    $sql = "INSERT INTO busandrail (bus, lrt_mrt, commuter_trains, monorails, taxi_ride_hailing, ferries, express_rail_link, carbon_footprint)
            VALUES ('$bus', '$lrt_mrt', '$commuter_trains', '$monorails', '$taxi_ride_hailing', '$ferries', '$express_rail_link', '$total_footprint')";

    if ($conn->query($sql) === TRUE) {
        echo "Data and carbon footprint inserted successfully. Total Bus & Rail Footprint: $total_footprint Metric Tons of CO2e";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();

// Function to calculate transport footprint based on distance and type
function calculateTransportFootprint($distance, $type) {
    $emission_factors = [
        'bus' => 0.089, // Example emission factor in kgCO2e per km
        'lrt_mrt' => 0.085,
        'commuter_trains' => 0.065,
        'monorails' => 0.080,
        'taxi_ride_hailing' => 0.160,
        'ferries' => 0.150,
        'express_rail_link' => 0.055
    ];
    
    return ($distance * ($emission_factors[$type] ?? 0)) / 1000; // Convert kg to metric tons
}
?>
