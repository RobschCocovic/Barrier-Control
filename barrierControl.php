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

// Klasse für die Verwaltungsoberfläche
class AdminInterface {
    public $customers;
    public $nfc_users;

    public function __construct() {
        $this->customers = [];
        $this->nfc_users = [];
    }

    public function addCustomer($customer_number, $first_name, $last_name) {
        $customer = new Customer($customer_number, $first_name, $last_name);
        $this->customers[] = $customer;
    }

    public function removeCustomer($customer_number) {
        foreach ($this->customers as $key => $customer) {
            if ($customer->customer_number == $customer_number) {
                if ($customer->nfc_user) {
                    $this->removeNFCUser($customer);
                }
                unset($this->customers[$key]);
                break;
            }
        }
    }

    public function addNFCUser($customer_number, $user_id) {
        foreach ($this->customers as $customer) {
            if ($customer->customer_number == $customer_number) {
                if ($customer->nfc_user) {
                    $this->removeNFCUser($customer);
                }
                $nfc_user = new NFCUser($user_id);
                $nfc_user->start_date = date('Y-m-d H:i:s');
                $customer->nfc_user = $nfc_user;
                $this->nfc_users[] = $nfc_user;
                break;
            }
        }
    }

    public function removeNFCUser($customer) {
        if ($customer->nfc_user) {
            $customer->nfc_user->end_date = date('Y-m-d H:i:s');
            $customer->nfc_user = null;
        }
    }

    public function displayCustomers() {
        foreach ($this->customers as $customer) {
            echo "Customer Number: " . $customer->customer_number . "\n";
            echo "Name: " . $customer->first_name . " " . $customer->last_name . "\n";
            if ($customer->nfc_user) {
                echo "NFC User ID: " . $customer->nfc_user->user_id . "\n";
                echo "Start Date: " . $customer->nfc_user->start_date . "\n";
                if ($customer->nfc_user->end_date) {
                    echo "End Date: " . $customer->nfc_user->end_date . "\n";
                }
            }
            echo "\n";
        }
    }
}

// Beispielverwendung
$admin = new AdminInterface();

// Kunden hinzufügen
$admin->addCustomer(1, "Max", "Mustermann")."\n";
$admin->addCustomer(2, "Erika", "Musterfrau");

// NFC-User hinzufügen
$admin->addNFCUser(1, 1001);
$admin->addNFCUser(2, 1002);

// Kunden und NFC-User anzeigen
$admin->displayCustomers();


// NFC-User entfernen
$admin->removeNFCUser($admin->customers[0]);

// Kunden entfernen
$admin->removeCustomer(2);

// Kunden und NFC-User erneut anzeigen
$admin->displayCustomers();

?>
