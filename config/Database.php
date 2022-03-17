
<?php
    class Database {
        private $conn;
        private $url;

        public function __construct() {
            $this->conn = null;
            $this->url = getenv('JAWSDB_MARIA_URL');
        }

        public function connect() {
            $dbparts = parse_url($this->url);

            $hostname = $dbparts['host'];
            $username = $dbparts['user'];
            $password = $dbparts['pass'];
            $database = ltrim($dbparts['path'],'/');
            $dsn = "mysql:host={$hostname};dbname={$database}";
           
            try {
                $this->conn = new PDO($dsn, $username, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
    }
