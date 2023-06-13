<!DOCTYPE html>
<html>
<head>
  <title>Barrier-Control</title>
 <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
  <div class="container1"></div>
  <h1>Barrier-Control</h1>
    <!--• Kunden werden uber eine Kundennummer identifiziert ¨
• Kunden haben einen Vorname und einen Nachnamen
• NFC-User weden uber Loxone zur Verf ¨ ugung gestellt, gehen Sie daher vorerst von einer fertigen Liste an ¨
Usern aus
• Es soll festgehalten werden, ab wann einem Kunden ein NFC-User zugeordnet wurde.
• Es soll festgehalten werden, wann diese Zuordnung wieder endet (Ablaufdatum).
1
INFORMATION SYSTEMS Third Class
• Aus Archivgrunden sollen Kunden nur archiviert, aber nicht gel ¨ ¨oscht werden, daher sehen sie ain aktiv/inaktivFeld vor.
• Als Datenbackend k¨onnen Sie wahlweise CSV oder JSON Dateien, MongoDB als dokumentenorientierte Datenbank oder MariaDB als SQL-Datenbank w¨ahlen; strukturieren Sie ihr Programm so, dass dies
m¨oglichst einfach auf ein anderes Backend umgestellt werden kann.
-->
    
    <!--Button für das Exportieren der Values-->
 <!-- <button class="button" role="button" onclick="exportCSV()"><span class="text">Export to CSV </span></button>-->
  

  
 <div id="divVName">
  <form id="createVName" method="post" >
    <label for="vnameInput">Vorname:</label>
    <input type="text" id="vnameInput" name="vname" placeholder="Max " required>
    
  </form>
</div>

<div id="divNName">
  <form id="createNName" method="post" >
    <label for="nnameInput">Nachname:</label>
    <input type="text" id="nnameInput" name="nname" placeholder="Mustermann" required>
   
  </form>
</div>

<div id="divCustomerID">
  <form id="createCustomerID" method="post" >
    <label for="CustomerIDInput">Kundennummer</label>
    <input type="text" id="CustomerIDInput" name="CustomerID" placeholder="CustomerID" required>
  </form>
</div>

<div id="divNFCCode">
  <form id="createNfC-Code" method="post" >
    <label for="nfcInput">NFC-Code:</label>
    <input type="text" id="nfcInput" name="NFCCode" placeholder="NFC-Code" required>
  </form>
</div>

<div id="divDate">
  <form id="createDate" method="post" >
    <label for="dateInput">Datum:</label>
    <input type="date" id="dateInput" name="date" required>
    
  </form>
</div>

<div id="safeConfig">
<form method="post" >
    <input type="submit" name="insertMember" value="Insert Member" >
  </form> 
</div>

<div id="divDeleteMember">
<form method="post" >
    <input type="submit" name="deleteMember" value="delete Member" >
  </form> 
</div>

<div id="divDeleteNFCCode">
<form method="post" >
    <input type="submit" name="deleteNFCCode" value="delete NFC Code" >
  </form> 
</div>

<div id="divDeleteAll">
<form method="post" >
    <input type="submit" name="deleteAll" value="delte all" >
  </form> 
</div>

<div id="divShowList">
  <form method="post" >
    <input type="submit" name="showList" value="Show List" >
  </form> 
</div>

<div id="divExportCSV">
<form method="post" >
    <input type="submit" name="exportCSV" value="export CSV" >
  </form> 
</div>


<?php
  require_once("barrierControl.php");
?>


</body>
</html>
