<?php
    require_once 'ConnectToDatabase.php';
/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $nfcCode = $_POST['nfcCode'];
  
    $csvContent = "Name,NFC-Code\n" . $name . "," . $nfcCode . "\n";
    $encodedUri = "data:text/csv;charset=utf-8," . urlencode($csvContent);
    
    header("Content-Type: application/csv");
    header("Content-Disposition: attachment; filename=export.csv");
    echo $csvContent;
    exit();
  }*/

  //Verbindung zur Datenbank wird Herrgestellt
  $database = new ConnectToDatabase("localhost", "barrierControlDatabase", "root", "");
  $database->connect();
  $conn = $database->getConnection();


  if(isset($_POST['showList'])){
    echo "ffffffffffffffffffffffffffffffffffffff";
    showList($conn);
  }


function deleteAll($conn) {
    $sql1 = "DELETE FROM Customer";
    $sql2 = "DELETE FROM NFCUser";

    if ($conn->query($sql1) === TRUE) {
        echo "Alle Tupel aus der Tabelle Customer wurden erfolgreich gelöscht.";
    } else {
        echo "Fehler beim Löschen der Tupel: " . $conn->error;
    }
    
    if ($conn->query($sql2) === TRUE) {
        echo "Alle Tupel aus der Tabelle NFCUser wurden erfolgreich gelöscht.";
    } else {
        echo "Fehler beim Löschen der Tupel: " . $conn->error;
    }
}

function InsertMember($firstName, $lastName, $customerNum, $conn) {
    $sql = "INSERT INTO Customer (firstName, lastName, customerNum)
            VALUES ('$firstName', '$lastName', '$customerNum')";

    if ($conn->query($sql) === TRUE) {
        echo "Kunde erfolgreich erstellt.";
    } else {
        echo "Fehler beim Erstellen des Kunden: " . $conn->error;
    }
}
function showList($conn) {
    echo "kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk";
    $sql = "SELECT C.customerID, C.firstName, C.lastName, N.von, N.bis, N.NFCNum FROM Customer C JOIN NFCUser N ON C.customerID = N.customerID;";
   
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Kunden-ID: " . $row["customerID"] . "<br>";
            echo "Vorname: " . $row["firstName"] . "<br>";
            echo "Nachname: " . $row["lastName"] . "<br>";

            if (isset($row["von"]) && isset($row["bis"]) && isset($row["NFCNum"])) {
                echo "NFC von: " . $row["von"] . "<br>";
                echo "NFC bis: " . $row["bis"] . "<br>";
                echo "NFC-Nummer: " . $row["NFCNum"] . "<br>";
            }

            echo "<br>";
        }
    } else {
        echo "Keine Kunden mit zugehörigen NFC-Usern gefunden.";
    }
}










?>
