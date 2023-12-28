<?php
    require "../src/controllers/FlightController.php";
    require "../src/controllers/CityController.php";
    $flight = FlightController::getFlightById($_GET["id"]);
    $cities = CityController::getAllCities();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Information</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>

<header>
    <div class="header-buttons">
        <a href="passenger-home.php">
                <button type="button">Home</button>
            </a>
            <a href="login.php?logout=true">
                <button type="button">Log out</button>
        </a>
    </div>
    <h1>Flight Information</h1>
</header>

<div class="flight-details2">
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
</div>

<h3>Take it?</h3>
<button onclick="openPaymentOption()">Take Flight</button>

<div id="paymentOption" style="display: none;">
    <h3>Choose Payment Option</h3>
    <label class="inline-label">
        <input type="radio" name="paymentType" value="fromAccount" checked>
        Pay from Account $
    </label>
    <label class="inline-label">
        <input type="radio" name="paymentType" value="cash">
        Cash (dealing with company, no implementation)
    </label>
    <button style="display: inline-block;" onclick="pay()">Confirm and Pay</button>
</div>

<h3>Message the Company</h3>
<!-- Added button to open Messages tab -->
<a href=<?php echo "passenger-messages.php?id=".$flight["company_id"]?>><button>Send Message</button></a>

</body>
</html>
