
<?php require "config/database.php"?>
<?php 
    require "src/controllers/AccountController.php";
    require "src/controllers/CompanyController.php";
    require "src/controllers/PassengerController.php";

    $return = AccountController::register("idreturntest12", "idreturntest12", "idreturntest12", 0);
    if($return){
        echo "REGISTER success". "<br>";
        echo "Id: " . $return . "<br>";
    } else {
        echo "REGISTER fail" . "<br>";
    }

    $ret = PassengerController::addPassenger("name", "tel", "photo_img", "passport_img", $return);
    if($ret){
        echo "ADD PASSENGER success". "<br>";
    } else {
        echo "ADD PASSENGER fail" . "<br>";
    }

    PassengerController::updatePassengerByAccountId("reupdated", "passenger", "by", "id", 6);


    $passenger = PassengerController::getPassengerById(5);

    echo $passenger['name'] . "<br>";
    echo $passenger['tel'] . "<br>";
    echo $passenger['photo_img'] . "<br>";
    echo $passenger['passport_img'] . "<br>";
    echo $passenger['account_id'] . "<br>";
    
//    $company = CompanyController::getCompanyByAccountId(1);

//     echo $company['name'] . "<br>";
//     echo $company['bio'] . "<br>";
//     echo $company['address'] . "<br>";
//     echo $company['location'] . "<br>";
//     echo $company['telephone'] . "<br>";
//     echo $company['logo_img'] . "<br>";
//     echo $company['account_id'] . "<br>";


//     $ret = CompanyController::addCompany("name", "bio", "address", "location", "telephone", "logo_img", 2);
//     if($ret){
//         echo "ADD COMPANNY success". "<br>";
//     } else {
//         echo "ADD COMPANNY fail" . "<br>";
//     }   



//     $company = CompanyController::getCompanyByAccountId(2);

//     echo $company['name'] . "<br>";
//     echo $company['bio'] . "<br>";
//     echo $company['address'] . "<br>";
//     echo $company['location'] . "<br>";
//     echo $company['telephone'] . "<br>";
//     echo $company['logo_img'] . "<br>";
//     echo $company['account_id'] . "<br>";
        


/*
    CREATE TABLE Flight (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    fee DECIMAL(10, 2) NOT NULL,
    passenger_capacity INT NOT NULL,
    company_id INT NOT NULL,
    FOREIGN KEY (company_id) REFERENCES Company(id)
    );
*/

// insert into flight
// $sql = "insert into flight (name, fee, passenger_capacity, company_id) values ('name', 100, 100, 1)";


       





?>
