<?php
    require "../src/controllers/CityController.php";
    require "../src/controllers/FlightController.php";
    require "../src/controllers/CompanyController.php";
    $cities = CityController::getAllCities();
    $company = CompanyController::getCompanyByAccountId($_COOKIE["account_id"]);
    $name = $time = $fees = $from_city = $to_city=$pass_num = "";
    if (isset($_POST['submit'])) {
            if (empty($_POST["name"])){
                $name_err = "* flight name is required";
            }else $name = htmlspecialchars($_POST["name"]);
            if (empty($_POST["time"])){
                $time_err = "* flight time is required";
            }else $time = htmlspecialchars($_POST["time"]);
            $fees = $_POST["fees"];
            $from_city = $_POST["from-city"];
            $to_city = $_POST["to-city"];
            $pass_num = $_POST["pass-num"];
            // echo $name. "  ".$time." " .$fees."   ".$from_city."   ".$to_city."   ".$pass_num;
            $res = FlightController::addFlight($name,$fees,$pass_num,$company["id"],$from_city,$to_city);
            if($res) header("Location: company-home.php");
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Flight</title>
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
    </header>
    <form acton=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <p style="color: red; padding-bottom:15px"> <?php echo $name_err; ?> </p>
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
        <label for="fees">Fees:</label>
        <input type="number" id="fees" name="fees" value="0">

        <label for="pass-num"># Passengers:</label>
        <input type="number" id="pass-num" name="pass-num" value="0">

        <label for="time">Time:</label>
        <input type="datetime-local" id="time" name="time">
        <p style="color: red; padding-bottom:15px"> <?php echo $time_err; ?> </p>
        <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer;" type="submit" name="submit" value="Add Flight">
    </form>

</body>

</html>