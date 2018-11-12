<?php
  // Connect to the database
  include("../config.php");

  $trimmed = trim($_POST[mac_address]);
//  echo $trimmed;
  $query  = "SELECT * FROM router WHERE mac_address = '$trimmed'";
//  echo $query;
  $result = pg_query($db, $query);
//  echo $result;
  $row = pg_fetch_row($result);
//  echo $row[1];
  if ($row[1] == $trimmed) {
    echo "SUCCESS!";
  }

  else {
    echo "FAILURE!";
  }

?>