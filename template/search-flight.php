<?php
    require "../src/controllers/CityController.php";
    require "../src/controllers/FlightController.php";
    require "../src/controllers/CompanyController.php";
    $cities = CityController::getAllCities();
    if(isset($_POST["submit"])){
            $from_city = $_POST["from-city"];
            $to_city = $_POST["to-city"];
        
        $flights = FlightController::searchFlights($from_city,$to_city);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>
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
    </header>

    <h1>Flight Search</h1>

    <form acton=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST">
        <label style="text-align: center;" >Itinerary:</label>
        <div style="display: flex;justify-content: space-around;">
            <div>
                <label for="from-city">From</label>
                    <select id="fruits" name="from-city" style="width: 150px;">
                    <?php
                        foreach ($cities as $city){
                            echo "<option value='". $city["id"] ."'>".$city["name"]."</option>";
                        }
                    ?>
                    </select>
            </div>
            <div>
                <label for="to-city">to</label>
                    <select id="to-city" name="to-city" style="width: 150px;">
                        <?php
                        foreach ($cities as $city){
                            echo "<option value='". $city["id"] ."'>".$city["name"]."</option>";
                        }
                    ?>
                    </select>
            </div>
        </div>

         <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer;" type="submit" name="submit" value="search">
    </form>

    <!-- 
    <ul class="flight-list" onclick="openFlightInfo(event)">
        <li class="flight-list-item" data-flight-id="1">
            Flight 1 - Some details
        </li>
        <li class="flight-list-item" data-flight-id="2">
            Flight 2 - Some details
        </li>-->
       <h2>List of Available Flights</h2>
        <ul class="flight-list" id="flightList">
        <?php
            foreach($flights as $flight){
                // echo var_dump($fPassengers);
                echo '<a href="flight-info.php?id='.$flight["id"].
                '">' . "<li style='display:flex; justify-content: space-around;list-style: none; text-decoration: none;' class='flight-list-item'><p>".$flight["name"]."</p><p>".$flight["fee"]."$</p><p>#T: ".$flight["passenger_capacity"]."</p><p>#C: "."  "."</p><p>#P: ". " " ."</p><p>f: ";
                foreach($cities as $city) if($city["id"]==$flight["start_city_id"]) echo $city["name"];
                echo "</p><p>T: ";
                foreach($cities as $city) if($city["id"]==$flight["end_city_id"]) echo $city["name"];
                echo "</p></li></a>";  
            }
        ?>
    </ul>

</body>

</html>