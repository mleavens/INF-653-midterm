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

        $hostname = $getenv('host');
        $username = $getenv('user');
        $password = $getenv('pass');
        $database = $getenv('path');

        try {
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
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