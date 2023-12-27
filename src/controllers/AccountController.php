<?php

require_once "../airplane-booking-php/config/database.php";
class AccountController{
    public static function login($email, $password){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from account where email = '$email' and password = '$password'";
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }



    /**
     * @return int|bool The ID of the newly created account if successful, or false if the registration failed.
     * 
     * If the email or username already exists in the database, the function will return false.
     * If the account is successfully created, the function will return the ID of the newly created account.
     * If there is an error while inserting the new account into the database, the function will also return false.
     */
    public static function register($email, $username, $password, $is_company){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        // validate email
        $sql = "select * from account where email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo "email exists" . "<br>";
            return false;
        }

        // validate username
        $sql = "select * from account where username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo "username exists" . "<br>";
            return false;
        }


        $sql = "insert into account(email, username, password, is_company)
                values ('$email','$username', '$password', $is_company)";
            
        if($conn->query($sql) === TRUE){
            // return account id
            $id = $conn->insert_id;
            return $id;
        } else {
            return false;
        }
    }


    
}