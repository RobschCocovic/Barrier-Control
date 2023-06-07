// Kundenliste
const customers = [];

// Formulare
const createCustomerForm = document.getElementById('createCustomerForm');
const assignNfcUserForm = document.getElementById('assignNfcUserForm');
const removeNfcUserForm = document.getElementById('removeNfcUserForm');

// Kunden erstellen
createCustomerForm.addEventListener('submit', function(event) {
  event.preventDefault();
  const customerName = document.getElementById('customerName').value;
  createCustomer(customerName);
  createCustomerForm.reset();
});

function createCustomer(name) {
  const customer = { name, nfcUser: null };
  customers.push(customer);
  updateCustomerList();
}

// Kunden NFC-User zuordnen
assignNfcUserForm.addEventListener('submit', function(event) {
  event.preventDefault();
  const selectedCustomerId = document.getElementById('customerSelect').value;
  const nfcUser = document.getElementById('nfcUser').value;
  assignNfcUser(selectedCustomerId, nfcUser);
  assignNfcUserForm.reset();
});

function assignNfcUser(customerId, nfcUser) {
  const customer = customers[customerId];
  if (customer) {
    customer.nfcUser = nfcUser;
    updateCustomerList();
  }
}

// Kunden NFC-User entfernen
removeNfcUserForm.addEventListener('submit', function(event) {
  event.preventDefault();
  const selectedCustomerId = document.getElementById('customerSelect2').value;
  removeNfcUser(selectedCustomerId);
  removeNfcUserForm.reset();
});

function removeNfcUser(customerId) {
  const customer = customers[customerId];
  if (customer) {
    customer.nfcUser = null;
    updateCustomerList();
  }
}

// Kundenliste aktualisieren
function updateCustomerList() {
  const customerList = document.getElementById('customerList');
  customerList.innerHTML = '';

  customers.forEach(function(customer, index) {
    const listItem = document.createElement('li');
    listItem.textContent = `${customer.name}: ${customer.nfcUser ? customer.nfcUser : 'Kein NFC-User zugewiesen'}`;
    customerList.appendChild(listItem);
  });

  // Dropdown-Optionen für Kunden-Selektoren aktualisieren
  updateCustomerSelectors();
}

// Dropdown-Optionen für Kunden-Selektoren aktualisieren
function updateCustomerSelectors() {
  const customerSelect = document.getElementById('customerSelect');
  const customerSelect2 = document.getElementById('customerSelect2');

  // Alle Optionen entfernen
  customerSelect.innerHTML = '';
  customerSelect2.innerHTML = '';

  // Optionen hinzufügen
  customers.forEach(function(customer, index) {
    const option1 = document.createElement('option');
    option1.value = index;
    option1.textContent = customer.name;
    customerSelect.appendChild(option1);

    const option2 = document.createElement('option');
    option2.value = index;
    option2.textContent = customer.name;
    customerSelect2.appendChild(option2);
  });
}
