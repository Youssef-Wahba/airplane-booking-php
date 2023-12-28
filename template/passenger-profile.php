<?php
    require "../src/controllers/PassengerController.php";
    $data = PassengerController::getPassengerByAccountId($_COOKIE["account_id"]);
    $nameData = $data["name"];
    $telData = $data["tel"];
    $name = $tel = "";
    $name_err = $tel_err = "";
    if(isset($_POST["submit"])){
        if (empty($_POST["name"])){
            $name_err = "* name is required";
        }else $name = htmlspecialchars($_POST["name"]);
        if (empty($_POST["tel"])){
            $tel_err = "* telephone is required";
        }else $tel = htmlspecialchars($_POST["tel"]);
        if(!empty($name) && !empty($tel)){
            PassengerController::updatePassengerByAccountId($name,$tel,"","",$_COOKIE["account_id"]);
            header("Location: passenger-home.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Profile</title>
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
    <h1>Passenger Profile</h1>
</header>

<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?> method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value=<?php echo $nameData?>>
    <p style="color: red; padding-bottom:15px"><?php echo $name_err; ?></p>
    <label for="tel">Telephone:</label>
    <input type="text" id="tel" name="tel" value=<?php echo $telData?>>
    <p style="color: red; padding-bottom:15px"><?php echo $tel_err; ?></p>
    <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer;" type="submit" name="submit" value="update">
</form>

</body>
</html>
