<?php

require_once "../airplane-booking-php/config/database.php";

/*
    CREATE TABLE City (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
*/
class CityController{
    
    // get all cities
    /**
     * Returns an array of all cities from the 'City' table in the database.
     * Each City is represented as an associative array where the keys are the column names and the values are the corresponding values in the database.
     * If there are no cities in the database, an empty array is returned.
     *
     * @return array An array of associative arrays representing all cities in the database.
     */
    public static function getAllCities(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from City";
        $result = $conn->query($sql);

        $cities = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($cities, $row);
            }
        }
        return $cities;
    }
}