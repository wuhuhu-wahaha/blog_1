<?php

// Verbindungs-Objekt samt Zugangsdaten festlegen
@$db = new mysqli('localhost', 'root', '');

// Verbindung überprüfen
if (mysqli_connect_errno()) {
    printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
    exit();
}

// SQL-Befehl
$sql_befehl = "CREATE DATABASE IF NOT EXISTS blog";

if ($db->query($sql_befehl)) {
    // Meldung bei erfolgreicher Erstellung der Datenbank
    echo "Datenbank erfolgreich angelegt.";
} else {
    // Meldung bei Fehlschlag
    echo "Datenbank konnte nicht angelegt werden!";
}

// Verbindung zum Datenbankserver beenden
$db->close();

?>
