<?php
    require "../src/controllers/PassengerController.php";
        if(!$_COOKIE["account_id"] || !$_COOKIE["type"] == "passenger") header("Location: login.php");
        $name_err = $tel_err = "";
        $name = $tel = "";
    
    if (isset($_POST['submit'])) {
            if (empty($_POST["name"])){
                $name_err = "* name is required";
            }else $name = htmlspecialchars($_POST["name"]);
            if (empty($_POST["telephone"])){
                $tel_err = "* telephone is required";
            }else $tel = htmlspecialchars($_POST["telephone"]);
            if(!empty($name) && !empty($tel)){
                $isComplete = PassengerController::addPassenger($name,$tel,"","",$_COOKIE["account_id"]);
                if($isComplete){
                    setcookie("isDataCompleted","1");
                    header("Location: passenger-home.php");
                }
            }
        }           

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Passenger Information</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>

<h2>Additional Passenger Information</h2>
<br>
<form acton=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST" >
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <p style="color: red; padding-bottom:15px"><?php echo $name_err; ?></p>
    <label for="telephone">Telephone:</label>
    <input type="text" id="telephone" name="telephone">
    <p style="color: red; padding-bottom:15px"><?php echo $tel_err; ?></p>
    <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer;" type="submit" name="submit" value="Register">
</form>
    <p style="color: red;text-align: center;"><?php if(!$isComplete && isset($_POST["submit"]))echo "error X(" ?></p>
</body>
</html>
