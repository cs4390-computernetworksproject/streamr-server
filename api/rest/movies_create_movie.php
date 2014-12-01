<?php
/**
 * REST endpoint for movies_create_movie().
 */

require_once(dirname(__FILE__) . '/../movies.php');

if (isset($_GET['name']) && isset($_GET['length']) && isset($_GET['file']) && isset($_GET['length']) && isset($_GET['director']) && isset($_GET['star'])) {
  echo json_encode(movies_create_movie($_GET['name'], $_GET['length'], $_GET['file'], $_GET['length'], $_GET['director'], $_GET['star']));
} else {
  echo json_encode(array(400 => 'Invalid arguments'));
}
