<?php
    require "../src/controllers/AccountController.php";
    if($_COOKIE["account_id"] && $_COOKIE["type"]){
        if($_COOKIE["type"] == "company")
            header("Location: company-home.php");
        else header("Location: passenger-home.php");
    }
    $email_err= $username_err = $password_err = "";
    $email= $username = $password = "";
        if (isset($_POST['submit'])) {
            if (empty($_POST["email"])){
                $email_err = "* email is required";
            }else $email = htmlspecialchars($_POST["email"]);
            if (empty($_POST["username"])){
                $username_err = "* username is required";
            }else $username = htmlspecialchars($_POST["username"]);
            if (empty($_POST["password"])){
                $password_err = "* password is required";
            }else $password = htmlspecialchars($_POST["password"]);
            $type = $_POST["type"]=="company" ? 1 : 0;
            $account_id = AccountController::register($email,$username,$password,$type);
            if($account_id){
                // set cookie
                setcookie("account_id", $account_id);
                if($type == 1){
                    // set type of account cookie
                    setcookie("type", "company");
                    // Redirect to additional-info-passenger.php
                    header("Location: additional-info-company.php");
                }   
                else{
                    // set type of account cookie
                    setcookie("type", "passenger");
                    // Redirect to additional-info-passenger.php
                    header("Location: additional-info-passenger.php"); 
                } 
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST" id="registrationForm">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email">
    <p style="color: red; padding-bottom:15px"> <?php echo $email_err; ?> </p>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <p style="color: red; padding-bottom:15px"><?php echo $name_err; ?></p>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <p style="color: red; padding-bottom:15px"><?php echo $password_err; ?></p>
    <label for="type">Type:</label>
    <select id="type" name="type">
        <option value="company">Company</option>
        <option value="passenger">Passenger</option>
    </select>
    <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer;" type="submit" name="submit" value="complete registeration data">
    <a href="login.php">
        <button type="button">Login</button>
    </a>
</form>
    <p style="color: red;text-align: center;"><?php if(!$account_id && isset($_POST["submit"]))echo "email or username already exists" ?></p>
</body>
</html>