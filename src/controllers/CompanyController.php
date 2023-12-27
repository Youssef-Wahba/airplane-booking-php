<?php

require_once "../airplane-booking-php/config/database.php";


/*
      CREATE TABLE Company (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    bio  VARCHAR(255),
    address  VARCHAR(255),
    location varchar(255),
    telephone  VARCHAR(15),
    logo_img varchar(255),
    account_id INT NOT NULL,
    FOREIGN KEY (account_id) REFERENCES account(id)
*/
class CompanyController{
    // get company by account id
    public static function getCompanyByAccountId($account_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from company where account_id = $account_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }

    // get company by id
    public static function getCompanyById($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from company where id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }

    // add company
    public static function addCompany($name, $bio, $address, $location, $telephone, $logo_img, $account_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "insert into company(name, bio, address, location, telephone, logo_img, account_id)
                values ('$name', '$bio', '$address', '$location', '$telephone', '$logo_img', $account_id)";
            
        if($conn->query($sql) === TRUE){
            return true;
        } else {
            return false;
        }
    }


    // update company by acount id
    public static function updateCompanyByAccountId($name, $bio, $address, $location, $telephone, $logo_img, $account_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "update company 
                set name = '$name', 
                bio = '$bio', 
                address = '$address', 
                location = '$location', 
                telephone = '$telephone', 
                logo_img = '$logo_img' 
                where account_id = $account_id";
                
        if($conn->query($sql) === TRUE){
            return true;
        } else {
            return false;
        }
    }

    // update company by id
    public static function updateCompanyById($id, $name, $bio, $address, $location, $telephone, $logo_img){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "update company 
                set name = '$name', 
                bio = '$bio', 
                address = '$address', 
                location = '$location', 
                telephone = '$telephone', 
                logo_img = '$logo_img' 
                where id = '$id'";
                
        if($conn->query($sql) === TRUE){
            return true;
        } else {
            return false;
        }
    }

    // TODO: get company flights
    // public static function getCompanyFlights($company_id){
    //     $db = Database::getInstance();
    //     $conn = $db->getConnection();

    //     $sql = "select * from flight where company_id = $company_id";
    //     $result = $conn->query($sql);

    //     if ($result->num_rows > 0) {
    //         $flights = array();
    //         while($row = $result->fetch_assoc()) {
    //             array_push($flights, $row);
    //         }
    //         return $flights;
    //     }
    //     return null;
    // }



}
?>