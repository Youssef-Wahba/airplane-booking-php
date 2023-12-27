
<?php
define("DB_HOST","localhost");
define("DB_USER","user");
define("DB_PASS","password");
define("DB_NAME","flight_booking_db");
class Database{
    // single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $conn;
    
    private function __construct(){
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($this->conn->connect_error){
            die("Failed to connect with MySQL: " . $this->conn->connect_error);
            throw new Exception("Failed to connect");
        }

    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->conn;
    }

    public function test(){
        $sql = "insert into account(email, password, is_company)
                values ('test','test', 1)";
            
        if($this->conn->query($sql) === TRUE){
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }

    }
}
?>