<?php
$url = parse_url(getenv('CLEARDB_DATABASE_URL'));

$dbHost = $url['host'];
$dbUser = $url['user'];
$dbPass = $url['pass'];
$dbName = substr($url['path'], 1);

$link = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// if (!$link) {
//   echo mysqli_error($link);
// } else {
//   echo 'Connected to DB';
// };

?>