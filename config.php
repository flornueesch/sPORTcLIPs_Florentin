<?php
$dbdir = './db';
/* Datenbankdatei ausserhalb htdocs öffnen bzw. erzeugen */
$db = new SQLite3("$dbdir/sq3.db");

$db->exec("CREATE TABLE  if not exists TLehrer(LehrUser PRIMARY KEY, LehrVorname not null, LehrNachname not null, LehrPassword not null);");


$db->exec("create table if not exists TSchueler(SchuUser INTEGER PRIMARY KEY, SchuVorname not null, SchuNachname not null, SchuPassword not null);");


$db->exec("CREATE TABLE IF NOT EXISTS TVideos (VidNummer INTEGER PRIMARY KEY AUTOINCREMENT, VidPfand String, VidBeschreibung String);");


// Start the session
session_start();
