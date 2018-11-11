<?php
  // Connect to the database
  include("../config.php");

  // Add router function
  if ($_POST['mac'] != '') {
     $query = "SELECT mac_address FROM router WHERE mac_address = '$_POST[mac]'";
     $result = pg_query($db, $query)
                or die('FAILURE!');
     echo "SUCCESS!";
 }
  else {
    echo "ERROR!";
  }

?>