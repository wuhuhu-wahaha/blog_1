<?php
// Datenbank-Verbindung herstellen
$conn = mysqli_connect("localhost", "root", "", "blog");
if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}

// MySQL-Befehl der Variablen $sql zuweisen
$sql = "
CREATE TABLE post_topic (
  id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  post_id int(11) UNIQUE,
  topic_id int(11)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
    ";

// MySQL-Anweisung ausführen lassen
$db_erg = mysqli_query($conn, $sql)
or die("Anfrage fehlgeschlagen: " . mysqli_error().$sql);

// MySQL-Befehl der Variablen $sql zuweisen
$sql = "
INSERT INTO `post_topic` (`id`, `post_id`, `topic_id`) VALUES
(1, 1, 1),
(2, 2, 2)
    ";

// MySQL-Anweisung ausführen lassen
$db_erg = mysqli_query($conn, $sql)
or die("Anfrage fehlgeschlagen: " . mysqli_error().$sql);

?>
