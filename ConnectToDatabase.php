<?php

class ConnectToDatabase {
    private $host;
    private $username;
    private $password;
    private $dbName;
    private $conn;


    public function __construct($host, $dbName, $username, $password) {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->username = $username;
        $this->password = $password;
    }

    // Methode zum Herstellen der Verbindung zur Datenbank
    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbName);
        if ($this->conn->connect_error) {
            die("Verbindung zur Datenbank fehlgeschlagen: " . $this->conn->connect_error);
        }
    }

    // Methode zum Schließen der Verbindung zur Datenbank
    public function closeConnection() {
        $this->conn->close();
    }

    // Getter-Methode für die Verbindungsobjekt
    public function getConnection() {
        return $this->conn;
    }
}
