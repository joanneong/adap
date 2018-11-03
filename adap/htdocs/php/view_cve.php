<?php
  // Connect to the database
  include("../config.php");

  // Query for CVEs for the given router model and version
  $query = "SELECT vulnerability FROM cve
            WHERE router_model = '$_POST[router_model]'
            AND router_version = '$_POST[router_version]'";

  $result = pg_query($db, $query)
              or die('Query failed.');

  $num = pg_num_rows($result);
  echo $num;
    
  // while ($row = pg_fetch_row($result)) {
  //   echo $row[0];
  //   echo "\n";
  // }

  // If it is found, send the vunlnerability back to be displayed
  // if ($numResults != 0) {
  //   while ($row = pg_fetch_row($result)) {
  //     echo $row[0];
  //   }
  // }
?>
