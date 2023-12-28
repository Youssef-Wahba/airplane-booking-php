<?php
    require "../src/controllers/CompanyController.php";
    // return to register page if no cookei 
    if(!$_COOKIE["account_id"] || !$_COOKIE["type"] == "company") header("Location: login.php");
    $name_err = $tel_err = $address_err = $location_err = $bio_err = "";
    $name = $tel = $address = $location = $bio = "";
    
    if (isset($_POST['submit'])) {
            if (empty($_POST["name"])){
                $name_err = "* company name is required";
            }else $name = htmlspecialchars($_POST["name"]);
            if (empty($_POST["address"])){
                $address_err = "* address is required";
            }else $address = htmlspecialchars($_POST["address"]);
            if (empty($_POST["telephone"])){
                $tel_err = "* telephone is required";
            }else $tel = htmlspecialchars($_POST["telephone"]);
            if (empty($_POST["location"])){
                $location_err = "* location is required";
            }else $location = htmlspecialchars($_POST["location"]);
            if (empty($_POST["bio"])){
                $bio_err = "* bio is required";
            }else $bio = htmlspecialchars($_POST["bio"]);
            // echo $name . " " . $address . " ". $tel . " ". $location . " ".$bio;

            $isComplete = CompanyController::addCompany($name,$bio,$address,$location,$tel,"", $_COOKIE["account_id"]);
            if($isComplete){
                setcookie("isDataCompleted","1");
                header("Location: company-home.php");
            } else echo "adasd";
        }           
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Company Information</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>

<h2>Additional Company Information</h2>

<form acton=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST">
    <br>
    <label for="name">Company Name:</label>
    <input type="text" id="name" name="name">
    <p style="color: red; padding-bottom:15px"><?php echo $name_err; ?></p>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address">
    <p style="color: red; padding-bottom:15px"><?php echo $address_err; ?></p>
    <label for="telephone">Telephone:</label>
    <input type="text" id="telephone" name="telephone">
    <p style="color: red; padding-bottom:15px"><?php echo $tel_err; ?></p>
    <label for="location">Location:</label>
    <input type="text" id="location" name="location">
    <p style="color: red; padding-bottom:15px"><?php echo $location_err; ?></p>
    <label for="bio">Bio:</label>
    <textarea style="padding:2px" id="bio" name="bio"></textarea>
    <p style="color: red; padding-bottom:15px"><?php echo $bio_err; ?></p>
    <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer;" type="submit" name="submit" value="Register">
</form>
    <p style="color: red;text-align: center;"><?php if(!$isComplete && isset($_POST["submit"]))echo "error X(" ?></p>
</body>
</html>
