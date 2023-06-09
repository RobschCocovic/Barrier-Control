<?php

class ConnectToDatabase {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;


    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    // Methode zum Herstellen der Verbindung zur Datenbank
    public function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
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

?>