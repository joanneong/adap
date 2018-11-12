<?php
  // Connect to the database
  include("../config.php");

//  echo "testing12344588 ";
  $query  = "SELECT * FROM router WHERE mac_address = '" . $_POST[mac_address] . "'";

//  echo $query;

  $result = pg_query($db, $query);

//  echo $result;

  $row = pg_fetch_row($result);

//  echo $row[1];

  if ($row[1] == $_POST[mac_address]) {
    echo "SUCCESS!";
  }

  else {
    echo "FAILURE!";
  }

?>