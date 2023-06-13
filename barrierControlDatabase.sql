DROP DATABASE IF EXISTS barrierControlDatabase;
CREATE DATABASE barrierControlDatabase DEFAULT CHARACTER SET = utf8 DEFAULT COLLATE utf8_general_ci;
USE barrierControlDatabase;
CREATE TABLE Customer (
  customerID INT,
  firstName VARCHAR(50),
  lastName VARCHAR(50),
  PRIMARY KEY(customerID)
);
CREATE TABLE NFCUser (
  customerID INT,
  von DATE,
  bis DATE,
  NFCCode INT,
  PRIMARY KEY(NFCCode),
  CONSTRAINT fk_nfcuser_customer FOREIGN KEY(customerID) REFERENCES Customer(customerID) ON DELETE NO ACTION ON UPDATE CASCADE
);
INSERT INTO Customer (customerID, firstName, lastName)
VALUES (1, 'testKunde123', 'TestKunde123');
INSERT INTO NFCUser (customerID, von, bis, NFCCode)
VALUES (1, '2023-06-01', '2023-06-30', 98765);