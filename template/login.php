<?php
    require "../src/controllers/AccountController.php";
    if(isset($_GET["logout"])){
        unset($_COOKIE['account_id']); 
        setcookie('account_id','',time()-3600); 
        unset($_COOKIE['type']); 
        setcookie('type','', time()-3600); 
    }
    if($_COOKIE["account_id"] && $_COOKIE["type"])
        $_COOKIE["type"] == "company"?header("Location: company-home.php"):header("Location: passenger-home.php");
    $email_err = $password_err = "";
    $email= $password = "";
    if (isset($_POST['submit'])) {
        if (empty($_POST["email"])){
            $email_err = "* email is required";
        }else $email = htmlspecialchars($_POST["email"]);
        if (empty($_POST["password"])){
            $password_err = "* password is required";
        }else $password = htmlspecialchars($_POST["password"]);
            $data = AccountController::login($email,$password);
            if($data){
                setcookie("account_id",$data["id"]);
                if($data["is_company"] == "1"){
                    setcookie("type","company");
                    header("Location: company-home.php");
                }else{
                    setcookie("type","passenger");
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
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>

    <form acton=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <p style="color: red; padding-bottom:15px"><?php echo $email_err; ?></p>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <p style="color: red; padding-bottom:15px"><?php echo $password_err; ?></p>
        <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer;" type="submit" name="submit" value="Login">
        <a href="register.php">
            <button type="button">Register</button>
        </a>
    </form>
    <p style="color: red;text-align: center;"><?php if(!$data && isset($_POST["submit"])) echo "not found"  ?></p>
</body>

</html>