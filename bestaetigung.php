<?php

if (extension_loaded("sqlite3")) {
    echo "SQLite3-Bibliothek geladen";
} else {
    echo "SQLite3-Bibliothek nicht geladen";
}

$dbdir = 'Z:\Eigene Dateien\IWeb\sPORTcLIPs_Florentin';
/* Datenbankdatei ausserhalb htdocs öffnen bzw. erzeugen */
$db = new SQLite3("$dbdir/sq3.db");

/* Tabelle mit Primärschlüssel erzeugen */
$db->exec("CREATE TABLE IF NOT EXISTS TLehrpersonen (LehrId INTEGER PRIMARY KEY AUTOINCREMENT, LehrVorname String, LehrNachnamen String);");
$db->exec("CREATE TABLE IF NOT EXISTS TSchueler (StudId INTEGER PRIMARY KEY AUTOINCREMENT, StudVorname String, StudNachname);");
$db->exec("CREATE TABLE IF NOT EXISTS TVideos (VidNummer INTEGER PRIMARY KEY AUTOINCREMENT, VidPfand String);");

/* Drei Datensätze eintragen */
$db->query("INSERT INTO TLehrpersonen VALUES (null , 'Jean-Pierre', 'Mouret')");
$db->query("INSERT INTO TSchueler VALUES (null , 'Jan', 'Reifler')");


/* Verbindung zur Datenbankdatei wieder lösen */
$db->close();
?>