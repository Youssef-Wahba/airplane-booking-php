<?php

require_once "../config/database.php";
class AccountController{


    /**
     * @return array|null Returns an associative array containing the account details if the login is successful, or null if the login failed.
     * 
     * If the provided email and password match an account in the database, the function will return an associative array containing the account details.
     * If the provided email and password do not match any account in the database, the function will return null.
     */
    public static function login($email, $password){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from Account where email = '$email' and password = '$password'";
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

        // validate email and username
        $sql = "select * from Account where email = '$email' or username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return false;
        }

        // // validate username
        // $sql = "select * from Account where username = '$username'";
        // $result = $conn->query($sql);
        // if($result->num_rows > 0){
        //     return false;
        // }


        $sql = "insert into Account(email, username, password, is_company)
                values ('$email','$username', '$password', $is_company)";
            
        if($conn->query($sql) === TRUE){
            // return Account id
            $id = $conn->insert_id;
            return $id;
        } else {
            return false;
        }
    }
}