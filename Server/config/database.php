<?php
    final class Database
    {
        private $host = "localhost";
        private $db_name = "cotisation";
        private $username = "root";
        private $db_password = "";
        private $connection;

        public function connect() {
            $this->connection = null;

            try {
                $this->connection = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                     echo "Erreur de connexion : " . $e->getMessage();
            }
            return $this->conn;
            }
    }
    