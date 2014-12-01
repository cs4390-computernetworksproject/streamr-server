<?php
/**
 * REST endpoint for movies_get_movie_by_name().
 */

require_once(dirname(__FILE__) . '/../movies.php');

if (isset($_GET['name'])) {
  echo json_encode(movies_get_movie_by_id($_GET['name']));
} else {
  echo json_encode(array(400 => 'Invalid arguments'));
}
