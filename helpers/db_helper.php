<?php
/**
 * Helper functions for database operations.
 */

function db_helper_setup() {
  require_once(dirname(__FILE__) . '/../server_config.php');
  $sql = mysqli_connect($_DB_HOST_, $_DB_USER_, $_DB_PASS_) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));
  mysqli_select_db($sql, $_DB_NAME_) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));
  return $sql;
}
