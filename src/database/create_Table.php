<?php
// Datenbank-Verbindung herstellen
$conn = mysqli_connect("localhost", "root", "", "blog");
if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}

// MySQL-Befehl der Variablen $sql zuweisen
$sql = "
CREATE TABLE users (
  id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  role enum('Author','Admin') DEFAULT NULL,
  password varchar(255) NOT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1
    ";


// MySQL-Anweisung ausführen lassen
$db_erg = mysqli_query($conn, $sql)
or die("Anfrage fehlgeschlagen: " . mysqli_error().$sql);

$sql = "
INSERT INTO users (`id`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin1', 'info@check24.com', 'Admin', 'mypassword', '2020-01-08 12:52:58', '2020-01-08 12:52:58')
    ";
$db_erg = mysqli_query($conn, $sql)
or die("Anfrage fehlgeschlagen: " . mysqli_error().$sql);

$sql = "
INSERT INTO users (`id`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Admin2', 'info@check24.com', 'Admin', 'mypassword', '2020-01-08 12:55:58', '2020-01-08 12:55:58')
    ";
$db_erg = mysqli_query($conn, $sql)
or die("Anfrage fehlgeschlagen: " . mysqli_error().$sql);


$sql = "
CREATE TABLE posts (
 id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 user_id int(11) DEFAULT NULL,
 title varchar(255) NOT NULL,
 slug varchar(255) NOT NULL UNIQUE,
 views int(11) NOT NULL DEFAULT '0',
 image varchar(255) NOT NULL,
 body text NOT NULL,
 published tinyint(1) NOT NULL,
 created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1
";

$db_erg = mysqli_query($conn, $sql)
or die("Anfrage fehlgeschlagen: " . mysqli_error().$sql);


$sql = "
INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `views`, `image`, `body`, `published`, `created_at`, `updated_at`) VALUES
(1, 1, '5 Habits that can improve your life', '5-habits-that-can-improve-your-life', 0, 'banner.jpg', 'Read every day', 1, '2020-02-03 07:58:02', '2020-02-01 19:14:31'),
(2, 1, 'Second post on LifeBlog', 'second-post-on-lifeblog', 0, 'banner.jpg', 'This is the body of the second post on this site', 0, '2020-02-02 11:40:14', '2020-02-01 13:04:36')
";
$db_erg = mysqli_query($conn, $sql)
or die("Anfrage fehlgeschlagen: " . mysqli_error().$sql);

?>