<?php
  // Connect to the database
  include("../config.php");

  // Edit router function
  if ($_POST['mac_address'] != '' && $_POST['model'] != '' && $_POST['version'] != '' && $_POST['original_mac_addr'] != '' && $_POST['mac_address'] != $_POST['original_mac_addr']) {
    $query = "UPDATE router SET mac_address = '$_POST[mac_address]', 
        model = '$_POST[model]', 
        version = '$_POST[version]'
        WHERE mac_address = '$_POST[original_mac_addr]'";
    $result = pg_query($db, $query)
                or die('Edit failed.');

    echo "SUCCESS!";
} else {
    echo "ERROR!";
  }
?>