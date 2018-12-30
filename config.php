<?php
$dbdir = './db';
/* Datenbankdatei ausserhalb htdocs öffnen bzw. erzeugen */
$db = new SQLite3("$dbdir/sq3.db");

$db->exec("CREATE TABLE  if not exists TUser(UsrId PRIMARY KEY, UsrVorname not null, UsrNachname not null, UsrPassword not null, UsrType not null);");

$db->exec("CREATE TABLE IF NOT EXISTS TVideos (VidNummer INTEGER PRIMARY KEY AUTOINCREMENT, VidName String, VidSchlagwort String, VidBeschreibung String);");


// Start the session
session_start();
