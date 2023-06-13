<?php
    require_once("ConnectToDatabase.php");
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


  if (isset($_POST['insertMember'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $customerNum = $_POST['customerNum'];
    insertMember($firstName, $lastName, $customerNum, $conn);
}

if (isset($_POST['deleteMember'])) {
    $customerID = $_POST['customerID'];
    deleteMember($customerID, $conn);
}

if (isset($_POST['deleteNFCCode'])) {
    $NFCCode = $_POST['NFCCode'];
    deleteNFCCode($NFCCode, $conn);
}

if (isset($_POST['deleteAll'])) {
    deleteAll($conn);
}

if (isset($_POST['showList'])) {
    showList($conn);
}

if (isset($_POST['exportCSV'])) {
    exportCSV($conn);
}

function deleteAll($conn) {
    $sql1 = "DELETE FROM Customer";
    $sql2 = "DELETE FROM NFCUser";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Alle Tupel aus der Tabelle Customer und NFCUser wurden erfolgreich gelöscht.";
    } else {
        echo "Fehler beim Löschen der Tupel: " . $conn->error;
    }
}

function insertMember($firstName, $lastName, $customerNum, $conn) {
    $sql = "INSERT INTO Customer (firstName, lastName, customerNum)
            VALUES ('$firstName', '$lastName', '$customerNum')";

    if ($conn->query($sql) === TRUE) {
        echo "Kunde erfolgreich erstellt.";
    } else {
        echo "Fehler beim Erstellen des Kunden: " . $conn->error;
    }
}

function deleteMember($customerID, $conn) {
    $sql1 = "DELETE FROM Customer WHERE customerID = $customerID";
    $sql2 = "DELETE FROM NFCUser WHERE customerID = $customerID";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Kunde und zugehöriger NFC-User erfolgreich gelöscht.";
    } else {
        echo "Fehler beim Löschen des Kunden und zugehörigen NFC-Users: " . $conn->error;
    }
}

function deleteNFCCode($NFCCode, $conn) {
    $sql = "DELETE FROM NFCUser WHERE NFCCode = $NFCCode";

    if ($conn->query($sql) === TRUE) {
        echo "NFC-Code erfolgreich gelöscht.";
    } else {
        echo "Fehler beim Löschen des NFC-Codes: " . $conn->error;
    }
}

function showList($conn) {
    $sql = "SELECT C.customerID, C.firstName, C.lastName, N.von, N.bis, N.NFCCode FROM Customer C LEFT JOIN NFCUser N ON C.customerID = N.customerID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Kunden-ID: " . $row["customerID"] . "<br>";
            echo "Vorname: " . $row["firstName"] . "<br>";
            echo "Nachname: " . $row["lastName"] . "<br>";

            if (isset($row["von"]) && isset($row["bis"]) && isset($row["NFCCode"])) {
                echo "NFC von: " . $row["von"] . "<br>";
                echo "NFC bis: " . $row["bis"] . "<br>";
                echo "NFC-Nummer: " . $row["NFCCode"] . "<br>";
            }

            echo "<br>";
        }
    } else {
        echo "Keine Kunden mit zugehörigen NFC-Usern gefunden.";
    }
}

function exportCSV($conn) {
    $sql = "SELECT C.firstName, C.lastName, N.NFCCode FROM Customer C LEFT JOIN NFCUser N ON C.customerID = N.customerID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $csvContent = "Vorname,Nachname,NFC-Nummer\n";
        while ($row = $result->fetch_assoc()) {
            $csvContent .= $row["firstName"] . "," . $row["lastName"] . "," . $row["NFCCode"] . "\n";
        }

        $encodedUri = "data:text/csv;charset=utf-8," . urlencode($csvContent);
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment; filename=export.csv");
        echo $csvContent;
    } else {
        echo "Keine Daten zum Exportieren gefunden.";
    }
}

// Datenbankverbindung schließen
$conn->close();
