<?php

    $dbdir = 'Z:\Eigene Dateien\IWeb\sPORTcLIPs_Florentin';
    /* Datenbankdatei ausserhalb htdocs öffnen bzw. erzeugen */
    $db = new SQLite3("$dbdir/sq3.db");

if(isset($_POST['usr']) && isset($_POST['pwd'])) {

    $user = $_POST['usr'];
    $pwd = $_POST['pwd'];

    $res = $db->query("SELECT * FROM TSchueler");

    /* Abfrageergebnis ausgeben */
    while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
        echo $dsatz["StudVorname"] . ", "
            . $dsatz["StudNachname"] . "<br>";
    }

}

/* Verbindung zur Datenbankdatei wieder lösen */
$db->close();
?>