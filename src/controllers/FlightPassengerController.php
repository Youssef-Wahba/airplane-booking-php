<?php
require_once "../airplane-booking-php/config/database.php";


/*
    CREATE TABLE FlightPassenger (
    passenger_id INT NOT NULL,
    flight_id INT NOT NULL,
    isComplete BOOL,
    PRIMARY KEY (passenger_id, flight_id),
    FOREIGN KEY (passenger_id) REFERENCES Passenger(id),
    FOREIGN KEY (flight_id) REFERENCES Flight(id)
);
*/
class FlightPassengerController{
    // get by passenger id
    public static function getFlightPassengerByPassengerId($passenger_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from FlightPassenger where passenger_id = $passenger_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $FlightPassengers = array();
            while($row = $result->fetch_assoc()) {
                $FlightPassengers[] = $row;
            }
            return $FlightPassengers;
        }
        return null;
    }

    // get by flight id
    public static function getFlightPassengerByFlightId($flight_id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "select * from FlightPassenger where flight_id = $flight_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $FlightPassengers = array();
            while($row = $result->fetch_assoc()) {
                $FlightPassengers[] = $row;
            }
            return $FlightPassengers;
        }
        return null;
    }

    // add flight passenger
    public static function addFlightPassenger($passenger_id, $flight_id, $isComplete){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "insert into FlightPassenger(passenger_id, flight_id, isComplete)
                values ($passenger_id, $flight_id, $isComplete)";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    


}
