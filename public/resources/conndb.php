<?php

// Connection variables
$db = array(
  'host' => 'localhost',
  'user' => 'root',
  'password' => '',
  'dbname' => 'codeclubdb'
);

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['dbname'] );

// if (!$link) {
//   echo mysqli_error($link);
// } else {
//   echo 'Connected to DB';
// };

?>