<?php
class Database {

    private $host = 'm7az7525jg6ygibs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com	';
    private $db_name = 'w5huh52nmonaqr7h';
    private $username = 'y8r135ms02a89dsf';
    private $password = getenv('PASSWORD');
    private $conn;

    public function connect(){
        $this->conn = null;
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'Connection Error:' . $e->getMessage();
        }

        return $this->conn;
    }
}


?>