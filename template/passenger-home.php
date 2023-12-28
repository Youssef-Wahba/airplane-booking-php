<?php
    require "../src/controllers/PassengerController.php";
    require "../src/controllers/FlightPassengerController.php";
    $data = PassengerController::getPassengerByAccountId($_COOKIE["account_id"]);
    $name = $data["name"];
    $tel = $data["tel"];
    $data = FlightPassengerController::getFlightPassengerByPassengerId($_COOKIE["account_id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Home</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>

<header>
    <div class="header-buttons">
        <a href="login.php?logout=true">
            <button type="button">Log out</button>
        </a>
    </div>
    <h1><?php echo $name?></h1>
    <p><?php echo $tel?></p>
    <img src="../assets/Messi.png" alt="Passenger Image">
</header>

<h2>List of Completed Flights</h2>
<ul class="flight-list">
    <li class="flight-list-item">Flight 1 - Completed</li>
    <li class="flight-list-item">Flight 2 - Completed</li>
    <!-- Add more completed flight list items as needed -->
</ul>

<h2>Current Flights</h2>
<ul class="flight-list">
    <li class="flight-list-item">Flight 3 - In progress</li>
    <li class="flight-list-item">Flight 4 - In progress</li>
    <!-- Add more current flight list items as needed -->
</ul>

<h2><a href="passenger-profile.php">Profile</a></h2>
<!-- Passenger Profile Information -->

<h2><a href="search-flight.php">Search a Flight</a></h2>
<!-- Search Flight Form (you can add form elements as needed) -->

<script>
    function signOut() {
        // Redirect to the login page (replace 'login.html' with your actual login page)
        window.location.href = 'login.html';
    }
    // You can add JavaScript functions for search functionality if required
</script>

</body>
</html>