<?php
class Database {

    private $hostname; 
    private $database;
    private $username;
    private $password;
    private $conn;

    public function connect(){
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
        
        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');

        try {
            $conn = new PDO("mysql:host=" . $this->hostname . "dbname=" . $this->database, $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
}

}
?>