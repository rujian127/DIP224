<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpcarbon";

// Define the maximum carbon footprint for 100% score for each category
$max_footprints = [
    'cars' => 2000,
    'motorbikes' => 500,
    'airplane' => 3000,
    'busandrail' => 1500,
    'diets' => 1000,
    'houseult' => 2500,
];

// Categories you're interested in
$interested_categories = ['cars', 'motorbikes'];

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to retrieve and calculate carbon footprint score
function getCarbonFootprintScore($conn, $categories, $max_footprints) {
    $total_footprint = 0;

    // Loop through each interested category to calculate the total carbon footprint
    foreach ($categories as $category) {
        $sql = "SELECT SUM(carbon_footprint) as total_footprint FROM {$category}";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_footprint += $row['total_footprint'];
        }
    }

    // Calculate the overall score
    $max_total_footprint = array_sum(array_intersect_key($max_footprints, array_flip($categories)));
    $score = ($total_footprint / $max_total_footprint) * 100;

    return $score;
}

// Retrieve overall carbon footprint score for the interested categories
$score = getCarbonFootprintScore($conn, $interested_categories, $max_footprints);

$conn->close();

// Output the score as JSON
header('Content-Type: application/json');
echo json_encode(['Overall Score' => $score]);
?>
