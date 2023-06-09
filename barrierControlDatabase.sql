CREATE DATABASE barrierControlDatabase;

USE barrierControlDatabase;

CREATE TABLE Customer (
  customerID INT PRIMARY KEY AUTO_INCREMENT,
  firstName VARCHAR(50),
  lastName VARCHAR(50),
  CONSTRAINT fk_customer_nfcuser FOREIGN KEY (customerID) REFERENCES NFCUser (customerID)
);

CREATE TABLE NFCUser (
  customerID INT PRIMARY KEY,
  von DATE,
  bis DATE,
  NFCNum INT,
  CONSTRAINT fk_nfcuser_customer FOREIGN KEY (customerID) REFERENCES Customer (customerID)
);


INSERT INTO Customer (customerID, firstName, lastName) VALUES (1,'testKunde1', 'TestKunde1');

INSERT INTO NFCUser (customerID, von, bis, NFCNum) VALUES (1, '2023-06-01', '2023-06-30', 98765);