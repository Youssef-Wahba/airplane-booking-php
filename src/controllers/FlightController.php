<?php

require_once "../config/database.php";

/*
    CREATE TABLE Flight (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    fee DECIMAL(10, 2) NOT NULL,
    passenger_capacity INT NOT NULL,
    company_id INT NOT NULL,
    start_city_id INT NOT NULL,
    end_city_id INT NOT NULL,
    FOREIGN KEY (company_id) REFERENCES Company(id),
    FOREIGN KEY (start_city_id) REFERENCES City(id),
    FOREIGN KEY (end_city_id) REFERENCES City(id)
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
     * Inserts a new flight into the 'Flight' table in the database.
     * The new flight is associated with a specific company, identified by the provided company ID, and has a start and end city, identified by their respective IDs.
     *
     * @param string $name The name of the flight.
     * @param float $fee The fee for the flight.
     * @param int $passenger_capacity The passenger capacity of the flight.
     * @param int $company_id The ID of the company to associate the flight with.
     * @param int $start_city_id The ID of the city where the flight starts.
     * @param int $end_city_id The ID of the city where the flight ends.
     * @return bool Returns true if the flight was successfully inserted, false otherwise.
     */
    public static function addFlight($name, $fee, $passenger_capacity, $company_id, $start_city_id, $end_city_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "insert into Flight(name, fee, passenger_capacity, company_id, start_city_id, end_city_id)
                values ('$name', $fee, $passenger_capacity, $company_id, $start_city_id, $end_city_id)";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // search Flights start city and end city
    /**
     * Searches for flights in the 'Flight' table in the database that start and end in the specified cities.
     * The cities are identified by their respective IDs.
     * Returns an array of flights that match the criteria, where each flight is represented as an associative array with keys as column names and values as the corresponding values in the database.
     * If no flights match the criteria, an empty array is returned.
     *
     * @param int $start_city_id The ID of the city where the flight starts.
     * @param int $end_city_id The ID of the city where the flight ends.
     * @return array An array of associative arrays representing the flights that match the criteria.
     */
    public static function searchFlights($start_city_id, $end_city_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from Flight where start_city_id = $start_city_id and end_city_id = $end_city_id";
        $result = $conn->query($sql);

        $Flights = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($Flights, $row);
            }
        }
        return $Flights;
    }
       // delete flight by id
    public static function deleteFlightById($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "delete from Flight where id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

}
?>