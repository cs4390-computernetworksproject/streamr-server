<?php
/**
 * Initialization script for database.
 */

require_once(dirname(__FILE__) . '/server_config.php');

// Connect to the MYSQL database.
$sql = mysqli_connect($_DB_HOST_, $_DB_USER_, $_DB_PASS_) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));

// If requested, drop the database.
if ($_GET['drop'] === 'true') {
  $query = 'DROP DATABASE ' . $_DB_NAME_;
  mysqli_query($sql, $query) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));
}

// Create the database and select it.
$query = 'CREATE DATABASE IF NOT EXISTS ' . $_DB_NAME_;
mysqli_query($sql, $query) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));
mysqli_select_db($sql, $_DB_NAME_) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));

// Create the MOVIES table.
$query = "CREATE TABLE IF NOT EXISTS MOVIES (
  ID int(11) AUTO_INCREMENT,
  NAME varchar(255) NOT NULL,
  LENGTH int(11) NOT NULL,
  DIRECTOR varchar(255),
  STAR varchar(255),
  FILE varchar(255) UNIQUE NOT NULL,
  PRIMARY KEY (ID)
  )";
mysqli_query($sql, $query) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));

// If requested, insert dummy data.
if (isset($_GET['populate']) && $_GET['populate'] == "true") {
  $host = "http://$_SERVER[HTTP_HOST]";
  $query = <<<HDOC
INSERT INTO MOVIES (
            NAME,
            LENGTH,
            DIRECTOR,
            STAR,
            FILE
            ) VALUES (
            "Big Buck Bunny",
            10,
            "Sacha Goedegebure",
            "Sacha Goedegebure",
            "http://192.168.0.17:8888/movies/big_buck_bunny_720p_surround.avi"
            ), (
            "Frozen",
            102,
            "Chris Buck",
            "Kristen Bell, Idina Menzel, Jonathan Groff",
            "http://192.168.0.17:8888/movies/frozen.mp4"
            ), (
            "The Shawshank Redemption",
            142,
            "Frank Darabont",
            "Tim Robbins, Morgan Freeman, Bob Gunton",
            "http://192.168.0.17:8888/movies/shawshank.mp4"
            ), (
            "Mr. and Mrs. Smith",
            1,
            "Doug Liman",
            "Brad Pitt, Angelina Jolie, Adam Brody",
            "http://192.168.0.17:8888/movies/mrmrssmithtrailer.mp4"
            )
HDOC;

  mysqli_query($sql, $query) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));
}

echo('Operations completed.');
