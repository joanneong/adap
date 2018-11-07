<?php
  // Connect to the database
  include("../config.php");

  // Add router function
  if ($_POST['mac_address'] != '' && $_POST['model'] != '' && $_POST['version'] != '') {
    $query = "INSERT INTO router VALUES(
              '$_POST[company_email]',
              '$_POST[mac_address]',
              '$_POST[model]',
              '$_POST[version]')";
    $result = pg_query($db, $query)
                or die('Search failed.');

    echo "SUCCESS!";
  } else {
    echo "ERROR!";
  }
?>