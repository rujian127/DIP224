<?php
// Initialize the carbon footprint variables
$car_footprint = 0;
$motorbike_footprint = 0;
$airplane_footprint = 0;
$house_footprint = 0;
$diet_footprint = 0;
$busandrail_footprint = 0;

// Calculate the carbon footprint for car
if (isset($_POST["car_distance"]) && isset($_POST["car_fuel_type"])) {
    $car_distance = (int)$_POST["car_distance"];
    $car_fuel_type = $_POST["car_fuel_type"];

    if ($car_fuel_type == "petrol") {
        $car_footprint = $car_distance * 0.126; // kg CO2 per km for petrol cars
    } else if ($car_fuel_type == "diesel") {
        $car_footprint = $car_distance * 0.117; // kg CO2 per km for diesel cars
    }
}

// Calculate the carbon footprint for motorbike
if (isset($_POST["motorbike_distance"]) && isset($_POST["motorbike_fuel_type"])) {
    $motorbike_distance = (int)$_POST["motorbike_distance"];
    $motorbike_fuel_type = $_POST["motorbike_fuel_type"];

    if ($motorbike_fuel_type == "petrol") {
        $motorbike_footprint = $motorbike_distance * 0.072; // kg CO2 per km for petrol motorbikes
    } else if ($motorbike_fuel_type == "diesel") {
        $motorbike_footprint = $motorbike_distance * 0.065; // kg CO2 per km for diesel motorbikes
    }
}

// Calculate the carbon footprint for airplane
if (isset($_POST["airplane_distance"])) {
    $airplane_distance = (int)$_POST["airplane_distance"];
    $airplane_footprint = $airplane_distance * 0.139; // kg CO2 per km for airplane
}

// Calculate the carbon footprint for house
if (isset($_POST["house_electricity"]) && isset($_POST["house_gas"])) {
    $house_electricity = (int)$_POST["house_electricity"];
    $house_gas = (int)$_POST["house_gas"];

    $house_footprint = ($house_electricity * 0.233) + ($house_gas * 0.184); // kg CO2 per kWh for electricity and kg CO2 per kWh for gas
}

// Calculate the carbon footprint for diet
if (isset($_POST["diet_meat"]) && isset($_POST["diet_dairy"]) && isset($_POST["diet_fruit_veg"])) {
    $diet_meat = (int)$_POST["diet_meat"];
    $diet_dairy = (int)$_POST["diet_dairy"];
    $diet_fruit_veg = (int)$_POST["diet_fruit_veg"];

    $diet_footprint = ($diet_meat * 2.58) + ($diet_dairy * 1.33) + ($diet_fruit_veg * 0.42); // kg CO2 per kg for meat, dairy, and fruit and vegetables
}

// Calculate the carbon footprint for bus and rail
if (isset($_POST["busandrail_distance"])) {
    $busandrail_distance = (int)$_POST["busandrail_distance"];
    $busandrail_footprint = $busandrail_distance * 0.06; // kg CO2 per km for bus and rail
}

// Calculate the total carbon footprint
$total_footprint = $car_footprint + $motorbike_footprint + $airplane_footprint + $house_footprint + $diet_footprint + $busandrail_footprint;

// Output the result
echo "Your total carbon footprint is: ". $total_footprint. " kg CO2 per year";
?>