<?php
    require "../src/controllers/MessagesController.php";
    setcookie("a",$_GET["id"]);
    if(isset($_POST["submit"])){
        $message = $_POST["message"];
        $res = MessageController::addMessage($_COOKIE["a"],$message);
        if($res) header("Location: passenger-home.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Form</title>
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

<h2>Message the Company</h2>
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST">
    <textarea id="message" placeholder="Type your message here" name="message"></textarea>
        <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer;" type="submit" name="submit" value="Send message">
    <a href="login.php">
</form>

</body>
</html>