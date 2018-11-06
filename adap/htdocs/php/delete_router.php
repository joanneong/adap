<?php
  // Connect to the database
  include("../config.php");

  // Delete router function
  $query = "DELETE FROM router WHERE mac_address = '$_POST[mac_address]'";
  $result = pg_query($db, $query)
              or die('Delete failed.');
?>
