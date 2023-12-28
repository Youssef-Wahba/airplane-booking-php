<?php
    require "../src/controllers/CompanyController.php";
    $data = CompanyController::getCompanyByAccountId($_COOKIE["account_id"]);
    $nameData = $data["name"];
    $bioData = $data["bio"];
    $addressData = $data["address"];
    $telephoneData = $data["telephone"];
    $locationData = $data["location"];
    $name = $_POST["name"];
    $bio = $_POST["bio"];
    $address = $_POST["address"];
    $telephone = $_POST["telephone"];
    $location = $_POST["location"]; 
    if(isset($_POST["submit"]) && !empty($name) && !empty($bio) && !empty($address) && !empty($location) && !empty($telephone)){
        $isUpdated = CompanyController::updateCompanyByAccountId($name,$bio,$address,$location,$telephone,"",$_COOKIE["account_id"]);
        if($isUpdated){
            $nameData = $name;
            $bioData = $bio; 
            $addressData = $address;
            $telephoneData = $telephone;
            $locationData = $location;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
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
        <img src="../assets/egyptair-logo-1.png" alt="Company Logo" class="company-logo">

    </header>

    <div class="profile-info">
        <h3>Company Profile</h3>
        <p >Name: <?php echo $nameData;?></p>
        <p >Bio: <?php echo $bioData;?></p>
        <p >Address: <?php echo $addressData;?></p>
        <p>Location: <?php echo $locationData;?></p>
        <p>Telephone: <?php echo $telephoneData;?></p>

        <h3>Flights List</h3>
        <ul>
            <li>Flight 1 - Some details</li>
            <li>Flight 2 - Some details</li>
            <!-- Add more flight list items as needed -->
        </ul>

        <button style="margin:10px 0px" onclick="editProfile()">Edit</button>

        <!-- Edit Form (initially hidden) -->
        <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?> id="editForm" style="display: none;" onsubmit="preventD(e)">
            <h3>Edit Company Profile</h3>
            <label for="editName">Name:</label>
            <input type="text" name="name" id="editName" value=<?php echo $nameData;?>>

            <label for="editBio">Bio:</label>
            <input type="text" name="bio" id="editBio" value=<?php echo $bioData;?>>

            <label for="editAddress">Address:</label>
            <input type="text" name="address" id="editAddress" value=<?php echo $addressData;?>>
            <label for="editLocation">Location:</label>
            <input type="text" name="location" id="editLocation" value=<?php echo $locationData;?>>
            <label for="editTelephone">Telephone:</label>
            <input type="text" name="telephone" id="editTelephone" value=<?php echo $telephoneData;?>>
            <input style="background-color: green; outline: auto; color:whitesmoke; border-radius: 6px; font-weight: 600; font-size: 20px; cursor: pointer;" type="submit" name="submit" value="Save changes">        
        </form>
            <p style="color: red;text-align: center;"><?php if(!$isUpdated && isset($_POST["submit"]))echo "error updating data" ?></p>
    </div>

    <script>
        function editProfile() {
            let div = document.getElementById('editForm');
            if(div.style.display === 'none')
                div.style.display = 'block';
            else div.style.display = 'none';
        }
    </script>

</body>

</html>