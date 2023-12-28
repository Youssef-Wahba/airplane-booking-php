<?php

require_once "../config/database.php";

/*
    CREATE TABLE Messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL, 
    message_text VARCHAR(1000) NOT NULL, 
    FOREIGN KEY (company_id) REFERENCES Company(id) 
    );
*/

class MessageController{
    // get all company messages
    /**
     * Returns an array of messages from the 'Messages' table in the database, where the keys are the column names and the values are the corresponding values in the database.
     * The messages are filtered by the provided company ID.
     * If no messages with the provided company ID are found in the database, null is returned.
     *
     * @param int $company_id The ID of the company to filter messages by.
     * @return array|null An array of associative arrays representing the messages with the provided company ID, or null if no such messages are found.
     */
    public static function getMessagesBycompany_id($company_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from Messages where company_id = $company_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $messages = array();
            while($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
            return $messages;
        }
        return null;
    }

    // add message
    /**
    * Inserts a new message into the 'Messages' table in the database.
    * The new message is associated with a specific company, identified by the provided company ID.
    *
    * @param int $company_id The ID of the company to associate the message with.
    * @param string $message_text The text of the message to insert.
    * @return bool Returns true if the message was successfully inserted, false otherwise.
    */
    public static function addMessage($company_id, $message_text){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "insert into Messages(company_id, message_text)
                values ($company_id, '$message_text')";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    
}
