<?php

    require_once "../config/database.php";


/*
    CREATE TABLE FlightCity (
    flight_id INT NOT NULL,
    city_id INT NOT NULL,
    start_date DATE,
    end_date DATE,
    PRIMARY KEY (flight_id, city_id),
    FOREIGN KEY (flight_id) REFERENCES Flight(id),
    FOREIGN KEY (city_id) REFERENCES city(id)
    );
*/
class FlightCityController
{
    // add flight city
    /**
     * Inserts a new record into the 'FlightCity' table in the database.
     * The new record represents a flight's visit to a city, with a start and end date.
     *
     * @param int $flight_id The ID of the flight.
     * @param int $city_id The ID of the city.
     * @param string $start_date The start date of the flight's visit to the city, in 'YYYY-MM-DD' format.
     * @param string $end_date The end date of the flight's visit to the city, in 'YYYY-MM-DD' format.
     * @return bool Returns true if the record was successfully inserted, false otherwise.
     */
    public static function addFlightCity($flight_id, $city_id, $start_date, $end_date)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "insert into FlightCity(flight_id, city_id, start_date, end_date)
                values ($flight_id, $city_id, '$start_date', '$end_date')";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // get flight city by flight id
    public static function getFlightCitiesByFlightId($flight_id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from FlightCity where flight_id = $flight_id";
        $result = $conn->query($sql);

        $flightCities = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($flightCities, $row);
            }
        }
        return $flightCities;
    }

    // get flight city by city id
    public static function getFlightCitiesByCityId($city_id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from FlightCity where city_id = $city_id";
        $result = $conn->query($sql);

        $flightCities = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($flightCities, $row);
            }
        }
        return $flightCities;
    }
}
