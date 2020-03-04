<?php
// Datenbank-Verbindung herstellen
$conn = mysqli_connect("localhost", "root", "", "blog");
if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}

// MySQL-Befehl der Variablen $sql zuweisen
$sql = "
CREATE TABLE topics (
  id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name varchar(255) NOT NULL,
  slug varchar(255) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=latin1
    ";

// MySQL-Anweisung ausführen lassen
$db_erg = mysqli_query($conn, $sql)
or die("Anfrage fehlgeschlagen: " . mysqli_error().$sql);

// MySQL-Befehl der Variablen $sql zuweisen
$sql = "
INSERT INTO `topics` (`id`, `name`, `slug`) VALUES
(1, 'Inspiration', 'inspiration'),
(2, 'Motivation', 'motivation'),
(3, 'Diary', 'diary')
    ";

// MySQL-Anweisung ausführen lassen
$db_erg = mysqli_query($conn, $sql)
or die("Anfrage fehlgeschlagen: " . mysqli_error().$sql);

?>
