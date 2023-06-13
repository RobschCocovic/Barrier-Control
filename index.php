<!DOCTYPE html>
<html>
<head>
  <title>Barrier-Control</title>
 <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>Barrier-Control</h1>
  <div class="container3"></div>
    <!--•
      Aufgabenstellung

   Kunden werden uber eine Kundennummer identifiziert ¨
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
  

  
 <div class="container4">
  <div id="divVName">
    <form id="createVName">
      <label for="vnameInput">Vorname:</label>
      <input type="text" id="vnameInput" name="vname" placeholder="Max " required>
    </form>
  </div>

  <div id="divNName">
    <form id="createNName">
      <label for="nnameInput">Nachname:</label>
      <input type="text" id="nnameInput" name="nname" placeholder="Mustermann" required>
    </form>
  </div>

  <div id="divNFCCode">
    <form id="createNfC-Code">
      <label for="nfcInput">NFC-Code:</label>
      <input type="text" id="nfcInput" name="nfcCode" placeholder="NFC-Code" required>
    </form>
  </div>

  <div id="divDate">
    <form id="createDate">
      <label for="dateInput">Datum:</label>
      <input type="date" id="dateInput" name="date" required>
    </form>
  </div>

  <div class="container2">
    <div id="safeConfig">
      <button class="button" role="button" onclick="insertMember()"><span class="text">Safe</span></button>
    </div>

    <div id="divDeleteMember">
      <button class="button" role="button" onclick="deleteMember()"><span class="text">Delete Member </span></button>
    </div>

    <div id="divDeleteNFCCode">
      <button class="button" role="button" onclick="deleteNFCCode()"><span class="text">Delete NFC </span></button>
    </div>

    <div id="divDeleteAll">
      <button class="button" role="button" onclick="deleteAll()"><span class="text">Delete All </span></button>
    </div>

    <div id="divShowList" class="button">
      <form method="post">
        <input class="button" type="submit" name="showList" value="Show List" >
      </form>
    </div>

    <div id="divExportCSV">
      <button class="button" role="button" onclick="exportCSV()"><span class="text">Export CSV </span></button>
    </div>
  </div>
</div>

<button class="button" role="button" onclick="openNewPage()"><span class="text">Jump Back</span></button>
  <script>
    function openNewPage() {
      window.location.href = "introduction.html";
    }
  </script>


<?php
  require_once("barrierControl.php");
  ?>

</body>
</html>
