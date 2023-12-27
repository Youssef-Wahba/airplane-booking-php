<?php

require_once "../airplane-booking-php/config/database.php";

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
class FlightController{

    // get all flights
    /**
     * Returns an array of all flights from the 'flight' table in the database.
     * Each flight is represented as an associative array where the keys are the column names and the values are the corresponding values in the database.
     * If there are no flights in the database, an empty array is returned.
     *
     * @return array An array of associative arrays representing all flights in the database.
     */
    public static function getAllFlights(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from flight";
        $result = $conn->query($sql);

        $flights = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($flights, $row);
            }
        }
        return $flights;
    }

    // get flight by id
    /**
     * Returns an associative array representing a flight from the 'flight' table in the database, where the keys are the column names and the values are the corresponding values in the database.
     * The flight is identified by the provided ID.
     * If no flight with the provided ID is found in the database, null is returned.
     *
     * @param int $id The ID of the flight to retrieve.
     * @return array|null An associative array representing the flight with the provided ID, or null if no such flight is found.
     */
    public static function getFlightById($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from flight where id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }

    // get flight by company id
    public static function getFlightsByCompanyId($company_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from flight where company_id = $company_id";
        $result = $conn->query($sql);

        $flights = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($flights, $row);
            }
        }
        return $flights;
    }


    // add flight
    /**
     * Returns an array of flights from the 'flight' table in the database, where the keys are the column names and the values are the corresponding values in the database.
     * The flights are filtered by the provided company ID.
     * If no flights with the provided company ID are found in the database, an empty array is returned.
     *
     * @param int $company_id The ID of the company to filter flights by.
     * @return array An array of associative arrays representing the flights with the provided company ID.
     */
    public static function addFlight($name, $fee, $passenger_capacity, $company_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "insert into flight (name, fee, passenger_capacity, company_id) 
                values ('$name', $fee, $passenger_capacity, $company_id)";
    
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    

        

    

}
?>