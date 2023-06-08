<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $nfcCode = $_POST['nfcCode'];
  
    $csvContent = "Name,NFC-Code\n" . $name . "," . $nfcCode . "\n";
    $encodedUri = "data:text/csv;charset=utf-8," . urlencode($csvContent);
    
    header("Content-Type: application/csv");
    header("Content-Disposition: attachment; filename=export.csv");
    echo $csvContent;
    exit();
  }


// Klasse für Kunden
class Customer {
    public $customer_number;
    public $first_name;
    public $last_name;
    public $nfc_user;

    public function __construct($customer_number, $first_name, $last_name) {
        $this->customer_number = $customer_number;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->nfc_user = null;
    }
}

// Klasse für NFC-User
class NFCUser {
    public $user_id;
    public $start_date;
    public $end_date;

    public function __construct($user_id) {
        $this->user_id = $user_id;
        $this->start_date = null;
        $this->end_date = null;
    }
}

?>
