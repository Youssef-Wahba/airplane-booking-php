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

    // get all Flights
    /**
     * Returns an array of all Flights from the 'Flight' table in the database.
     * Each Flight is represented as an associative array where the keys are the column names and the values are the corresponding values in the database.
     * If there are no Flights in the database, an empty array is returned.
     *
     * @return array An array of associative arrays representing all Flights in the database.
     */
    public static function getAllFlights(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from Flight";
        $result = $conn->query($sql);

        $Flights = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($Flights, $row);
            }
        }
        return $Flights;
    }

    // get Flight by id
    /**
     * Returns an associative array representing a Flight from the 'Flight' table in the database, where the keys are the column names and the values are the corresponding values in the database.
     * The Flight is identified by the provided ID.
     * If no Flight with the provided ID is found in the database, null is returned.
     *
     * @param int $id The ID of the Flight to retrieve.
     * @return array|null An associative array representing the Flight with the provided ID, or null if no such Flight is found.
     */
    public static function getFlightById($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from Flight where id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }

    // get Flight by company id
    public static function getFlightsByCompanyId($company_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from Flight where company_id = $company_id";
        $result = $conn->query($sql);

        $Flights = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($Flights, $row);
            }
        }
        return $Flights;
    }


    // add Flight
    /**
     * Returns an array of Flights from the 'Flight' table in the database, where the keys are the column names and the values are the corresponding values in the database.
     * The Flights are filtered by the provided company ID.
     * If no Flights with the provided company ID are found in the database, an empty array is returned.
     *
     * @param int $company_id The ID of the company to filter Flights by.
     * @return array An array of associative arrays representing the Flights with the provided company ID.
     */
    public static function addFlight($name, $fee, $passenger_capacity, $company_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "insert into Flight (name, fee, passenger_capacity, company_id) 
                values ('$name', $fee, $passenger_capacity, $company_id)";
    
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>