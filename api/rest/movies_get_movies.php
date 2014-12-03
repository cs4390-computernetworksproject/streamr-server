<?php
/**
 * REST endpoint for movies_get_movies().
 */

require_once(dirname(__FILE__) . '/../movies.php');

echo json_encode(movies_get_movies());
