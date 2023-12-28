<?php
    require "../src/controllers/FlightController.php";
    require "../src/controllers/CompanyController.php";
    require "../src/controllers/CityController.php";
    require "../src/controllers/FlightPassengerController.php";
    $company = CompanyController::getCompanyByAccountId($_COOKIE["account_id"]);
    $flight = FlightController::getFlightById($_GET["id"]);
    $cities = CityController::getAllCities();
    if(isset($_POST["submit"])){
        $res = FlightController::deleteFlightById($flight["id"]);
        if($res) header("Location: company-home.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Details</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>

<header>
    <div class="header-buttons">
        <a href="company-home.php">
                <button type="button">Home</button>
            </a>
            <a href="login.php?logout=true">
                <button type="button">Log out</button>
        </a>
    </div>
    <h1>Flight Details</h1>
</header>

<p>ID: Flight <span id="flightId" style="color:green"><?php echo $flight["id"]?></span></p>
<p>Name: <span id="flightName" style="color:green"><?php echo $flight["name"]?></span></p>
<p>Itinerary: Departure City-><span id="flightItinerary" style="color:green; padding:0px 5px">
    <?php foreach($cities as $city) if($city["id"]==$flight["start_city_id"]) echo $city["name"];
    ?>
    </span>Arrival City<-<span id="flightItinerary" style="color:green; padding:0px 5px" >
        <?php foreach($cities as $city) if($city["id"]==$flight["end_city_id"]) echo $city["name"];
        ?>
    </span></p>
<p>Pending Passengers List: <span id="pendingPassengers">Passenger 1, Passenger 2</span></p>
<p>Registered Passengers List: <span id="registeredPassengers">Passenger 3, Passenger 4</span></p>
    <form acton=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST">    
    <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer; margin-top:10px" type="submit" name="submit" value="Cancel flight">
</form>
<script>

    function goToHomePage() {
            // Redirect to the home page (replace 'home.html' with your actual home page)
            window.location.href = 'company-home.html';
    }

    function signOut() {
        // Redirect to the login page (replace 'login.html' with your actual login page)
        window.location.href = 'login.html';
    }
</script>

</body>
</html>
