<?php

// Verbindung zur Datenbank herstellen
$db = new ConnectToDatabase("localhost", "username", "password", "barrierControlDatabase");
$db->connect();

// Funktion zum Einfügen eines Mitglieds in die Datenbank
function insertMember() {
  global $db;

  // Werte aus dem Formular abrufen
  $firstName = $_POST['vname'];
  $lastName = $_POST['nname'];
  $nfcCode = $_POST['nfcCode'];
  $date = $_POST['date'];

  // SQL-Abfrage zum Einfügen des Mitglieds in die Datenbank
  $insertQuery = "INSERT INTO Customer (firstName, lastName) VALUES ('$firstName', '$lastName')";
  $db->getConnection()->query($insertQuery);

  // Die zuletzt eingefügte customerID abrufen
  $customerID = $db->getConnection()->insert_id;

  // SQL-Abfrage zum Einfügen des NFC-Codes in die Datenbank
  $nfcInsertQuery = "INSERT INTO NFCUser (customerID, von, bis, NFCNum) VALUES ('$customerID', '$date', NULL, '$nfcCode')";
  $db->getConnection()->query($nfcInsertQuery);

  // Erfolgsmeldung ausgeben
  echo "Mitglied erfolgreich hinzugefügt.";
}

// Funktion zum Löschen eines Mitglieds aus der Datenbank
function deleteMember() {
  global $db;

  // customerID aus dem Formular abrufen
  $customerID = $_POST['customerID'];

  // SQL-Abfrage zum Löschen des Mitglieds aus der Datenbank
  $deleteQuery = "DELETE FROM Customer WHERE customerID = '$customerID'";
  $db->getConnection()->query($deleteQuery);

  // Erfolgsmeldung ausgeben
  echo "Mitglied erfolgreich gelöscht.";
}

// Funktion zum Löschen eines NFC-Codes aus der Datenbank
function deleteNFCCode() {
  global $db;

  // customerID aus dem Formular abrufen
  $customerID = $_POST['customerID'];

  // SQL-Abfrage zum Löschen des NFC-Codes aus der Datenbank
  $deleteQuery = "UPDATE NFCUser SET bis = CURDATE() WHERE customerID = '$customerID'";
  $db->getConnection()->query($deleteQuery);

  // Erfolgsmeldung ausgeben
  echo "NFC-Code erfolgreich gelöscht.";
}

// Funktion zum Löschen aller Mitglieder aus der Datenbank
function deleteAll() {
  global $db;

  // SQL-Abfrage zum Löschen aller Mitglieder aus der Datenbank
  $deleteQuery = "DELETE FROM Customer";
  $db->getConnection()->query($deleteQuery);

  // Erfolgsmeldung ausgeben
  echo "Alle Mitglieder erfolgreich gelöscht.";
}

// Funktion zum Exportieren der Daten als CSV-Datei
function exportCSV() {
  global $db;

  // SQL-Abfrage zum Abrufen aller Mitgliederdaten
  $selectQuery = "SELECT * FROM Customer";
  $result = $db->getConnection()->query($selectQuery);

  if ($result->num_rows > 0) {
    // CSV-Datei öffnen
    $file = fopen("members.csv", "w");

    // Überschriftenzeile in die CSV-Datei schreiben
    fputcsv($file, array('customerID', 'firstName', 'lastName'));

    // Daten in die CSV-Datei schreiben
    while ($row = $result->fetch_assoc()) {
      fputcsv($file, $row);
    }

    // CSV-Datei schließen
    fclose($file);

    // Erfolgsmeldung ausgeben
    echo "Daten erfolgreich als CSV exportiert.";
  } else {
    echo "Keine Daten zum Exportieren gefunden.";
  }
}

// Funktion zum Anzeigen der Mitgliederliste
function showList() {
  global $db;

  // SQL-Abfrage zum Abrufen aller Mitgliederdaten
  $selectQuery = "SELECT * FROM Customer";
  $result = $db->getConnection()->query($selectQuery);

  if ($result->num_rows > 0) {
    // Mitgliederliste anzeigen
    while ($row = $result->fetch_assoc()) {
      echo "ID: " . $row['customerID'] . ", Name: " . $row['firstName'] . " " . $row['lastName'] . "<br>";
    }
  } else {
    echo "Keine Mitglieder gefunden.";
  }
}

// Verbindung zur Datenbank schließen
$db->closeConnection();

?>
