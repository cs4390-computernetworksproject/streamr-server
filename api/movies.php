<?php
/**
 * API for movies.
 */

/**
 * Add a movie to the database.
 *
 * @param string $name
 *  The name of the movie.
 * @param integer $length
 *  The length of the movie (in seconds).
 * @param string $file
 *  The location of the file.
 * @param string  $director
 *  The director of the movie.
 * @param string $star
 *  The star of the movie.
 *
 * @return int
 *  The ID of the created movie.
 */
function movies_create_movie($name, $length, $file, $director = NULL, $star = NULL) {
  // DB setup.
  require_once(dirname(__FILE__) . '/../helpers/db_helper.php');
  $sql = db_helper_get_sql();

  // Create the movie.
  $query = <<<HDOC
INSERT INTO MOVIES (
            NAME,
            LENGTH,
            DIRECTOR,
            STAR,
            FILE
            ) VALUES (
            "$name",
            $length,
            "$director",
            "$star",
            "$file"
            )
HDOC;

  mysqli_query($sql, $query);

  // Get the id of the newly created movie.
  $query = "SELECT LAST_INSERT_ID()";
  $result = mysqli_query($sql, $query) or die("A MySQL error has occurred.<br />Error: (" . mysqli_errno($sql) . ") " . mysqli_error($sql));
  $row = mysqli_fetch_row($result);
  $id = $row[0];
  return $id;
}

/**
 * Returns the movie with the specified id.
 *
 * @param integer $id
 *  The id of the movie.
 *
 * @return object
 *  The movie matching the passed in id.
 */
function movies_get_movie_by_id($id) {
  // DB setup.
  require_once(dirname(__FILE__) . '/../helpers/db_helper.php');
  $sql = db_helper_get_sql();

  // Get the movie.
  $query = "SELECT * FROM MOVIES
            WHERE ID=$id";
  $result = mysqli_query($sql, $query);
  $movie = mysqli_fetch_object($result);

  return $movie;
}

/**
 * Returns the movie with the specified name.
 *
 * @param string $name
 *  The name of the movie.
 *
 * @return object
 *  The movie matching the passed in name.
 */
function movies_get_movies_by_name($name) {
  // DB setup.
  require_once(dirname(__FILE__) . '/../helpers/db_helper.php');
  $sql = db_helper_get_sql();

  // Get the movie.
  $query = <<<HDOC
    SELECT * FROM MOVIES
    WHERE NAME LIKE "%$name%"
HDOC;

  $result = mysqli_query($sql, $query);
  while ($object = mysqli_fetch_object($result)) {
    $movies[] = $object;
  }

  return $movies;
}

/**
 * Returns all movies.
 *
 * @return array
 *  An array of movies.
 */
function movies_get_movies() {
  $movies = [];

  // DB setup.
  require_once(dirname(__FILE__) . '/../helpers/db_helper.php');
  $sql = db_helper_get_sql();

  // Get all movies.
  $query = "SELECT * FROM MOVIES";
  $result = mysqli_query($sql, $query);
  while ($object = mysqli_fetch_object($result)) {
    $movies[] = $object;
  }

  return $movies;
}
