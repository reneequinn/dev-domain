<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once './conndb.php';
$data = array();
$query = 'SELECT * FROM events LEFT JOIN venues ON events.event_venue = venues.venue_name;';
$result = mysqli_query($link, $query);
if ($result) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  $jsonRes = json_encode($data);
  echo $jsonRes;
} else {
  echo 'No event data found';
}


mysqli_close($link);

?>