<?php
/**
 * REST endpoint for movies_get_movies().
 */

require_once(dirname(__FILE__) . '/../movies.php');

if (isset($_GET['id'])) {
  echo json_encode(movies_get_movie_by_id($_GET['id']));
} else {
  echo json_encode(array(400 => 'Invalid arguments'));
}
