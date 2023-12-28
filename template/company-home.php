<?php
    require "../src/controllers/FlightController.php";
    require "../src/controllers/CompanyController.php";
    require "../src/controllers/CityController.php";
    require "../src/controllers/FlightPassengerController.php";
    $company = CompanyController::getCompanyByAccountId($_COOKIE["account_id"]);
    $flights = FlightController::getFlightsByCompanyId($company["id"]);
    $cities = CityController::getAllCities();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Home</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>

    <header>
        <div class="header-buttons">
        <a href="login.php?logout=true">
            <button type="button">Log out</button>
        </a>
    </a>
        </div>
        <h1>Company Name</h1>
        <img src="../assets/egyptair-logo-1.png" alt="Company Logo" class="company-logo">
    </header>

    <h3><a href="add-flight.php">Add Flight</a></h3>

    <h3>#Flights as List</h3>
    <ul class="flight-list" id="flightList">
        <?php
            foreach($flights as $flight){
                $fPassengers = FlightPassengerController::getFlightPassengerByFlightId($flight["id"]);
                // echo var_dump($fPassengers);
                echo '<a href="flight-details.php?id='.$flight["id"].
                '">' . "<li style='display:flex; justify-content: space-around;list-style: none; text-decoration: none;' class='flight-list-item'><p>".$flight["name"]."</p><p>".$flight["fee"]."$</p><p>#T: ".$flight["passenger_capacity"]."</p><p>#C: "."  "."</p><p>#P: ". " " ."</p><p>f: ";
                foreach($cities as $city) if($city["id"]==$flight["start_city_id"]) echo $city["name"];
                echo "</p><p>T: ";
                foreach($cities as $city) if($city["id"]==$flight["end_city_id"]) echo $city["name"];
                echo "</p></li></a>";  
            }
        ?>
    </ul>
    <h3><a href="company-profile.php">Profile</a></h3>
    <h3><a href="company-messages.php">Messages</a></h3>

</body>
</html>