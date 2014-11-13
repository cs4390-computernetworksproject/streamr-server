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
  FILE varchar(255) UNIQUE,
  PRIMARY KEY (ID)
  )";
mysqli_query($sql, $query) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));

echo('Operations completed.');
