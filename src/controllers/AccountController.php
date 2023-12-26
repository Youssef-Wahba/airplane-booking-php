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


    public static function register($email, $username, $password, $is_company){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        // validate email
        $sql = "select * from account where email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo "email exists";
            return false;
        }

        // validate username
        $sql = "select * from account where username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo "username exists";
            return false;
        }


        $sql = "insert into account(email, username, password, is_company)
                values ('$email','$username', '$password', $is_company)";
            
        if($conn->query($sql) === TRUE){
            return true;
        } else {
            return false;
        }
    }


    
}