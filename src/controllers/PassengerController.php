<?php

require_once "../airplane-booking-php/config/database.php";

/*
        CREATE TABLE Passenger (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        tel VARCHAR(20),
        photo_img VARCHAR(255),
        passport_img VARCHAR(255),
        account_id INT NOT NULL,
        FOREIGN KEY (account_id) REFERENCES Account(id)
        );
*/
class PassengerController{
    // get Passenger by account id
    /**
     * @return array|null Returns an associative array containing the Passenger details if the account ID matches a Passenger in the database, or null if no match is found.
     * 
     * If the provided account ID matches a Passenger in the database, the function will return an associative array containing the Passenger details.
     * If the provided account ID does not match any Passenger in the database, the function will return null.
     */
    public static function getPassengerByAccountId($account_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from Passenger where account_id = $account_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }

    // get Passenger by id
    /**
     * @return array|null Returns an associative array containing the Passenger's details if a match is found, or null if no match is found.
     * 
     * If the provided ID matches a Passenger in the database, the function will return an associative array containing the Passenger's details.
     * If the provided ID does not match any Passenger in the database, the function will return null.
     */
    public static function getPassengerById($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from Passenger where id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }

    // add Passenger
    /**
     * @return bool Returns true if the Passenger is successfully added to the database, or false if the operation failed.
     * 
     * If the provided details are successfully inserted into the 'Passenger' table in the database, the function will return true.
     * If there is an error while inserting the new Passenger into the database, the function will return false.
     */
    public static function addPassenger($name, $tel, $photo_img, $passport_img, $account_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "insert into Passenger(name, tel, photo_img, passport_img, account_id)
                values ('$name', '$tel', '$photo_img', '$passport_img', $account_id)";
            
        if($conn->query($sql) === TRUE){
            return true;
        } else {
            return false;
        }
    }

    // update Passenger by id
    /**
     * @return bool Returns true if the Passenger's details are successfully updated in the database, or false if the operation failed.
     * 
     * If the provided details are successfully updated in the 'Passenger' table in the database, the function will return true.
     * If there is an error while updating the Passenger's details in the database, the function will return false.
     */
    public static function updatePassengerById($name, $tel, $photo_img, $passport_img, $id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "update Passenger set name = '$name', tel = '$tel', photo_img = '$photo_img', passport_img = '$passport_img' where id = $id";
            
        if($conn->query($sql) === TRUE){
            return true;
        } else {
            return false;
        }
    }

    // update Passenger by acount id
    /**
     * @return bool Returns true if the Passenger's details are successfully updated in the database, or false if the operation failed.
     * 
     * If the provided details are successfully updated in the 'Passenger' table in the database, the function will return true.
     * If there is an error while updating the Passenger's details in the database, the function will return false.
     */
    public static function updatePassengerByAccountId($name, $tel, $photo_img, $passport_img, $account_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "update Passenger set name = '$name', tel = '$tel', photo_img = '$photo_img', passport_img = '$passport_img' where account_id = $account_id";
            
        if($conn->query($sql) === TRUE){
            return true;
        } else {
            return false;
        }
    }
}
?>