<?php

    $dbdir = 'Z:\Eigene Dateien\IWeb\sPORTcLIPs_Florentin';
    /* Datenbankdatei ausserhalb htdocs öffnen bzw. erzeugen */
    $db = new SQLite3("$dbdir/sq3.db");


    $user = $_POST['usr'];
    $pwd = $_POST['pwd'];

    $resSchu = $db->query("SELECT * FROM TSchueler where SchuUser = ". $user." and SchuPassword = ". $pwd);
$resLehr = $db->query("SELECT * FROM TLehrer where SchuUser = ". $user." and SchuPassword = ". $pwd);

    /* Abfrageergebnis ausgeben */
    while ($dsatz = $resSchu->fetchArray(SQLITE3_ASSOC)) {
        header('Location: http://localhost:63342/sPORTcLIPs_Florentin/mainPage.php');

    }

$res = $db->query("SELECT * FROM TLehrer");

/* Abfrageergebnis ausgeben */
while ($dsatz = $resSchu->fetchArray(SQLITE3_ASSOC)) {
    header('Location: http://localhost:63342/sPORTcLIPs_Florentin/mainPage.php');
}

/* Verbindung zur Datenbankdatei wieder lösen */
$db->close();
?>


