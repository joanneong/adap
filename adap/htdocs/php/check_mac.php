<?php
  // Connect to the database
  include("../config.php");

  // Credits for helper functions go to: 
  // https://www.stetsenko.net/2011/01/php-mac-address-validating-and-formatting/
  // Checks if a given mac is in a valid format
  function IsValid($mac) {
    return (preg_match('/([a-fA-F0-9]{2}[:|\-]?){6}/', $mac) == 1);
  }

  // Remove separators : and -
  function RemoveSeparator($mac, $separator = array(':', '-')) {
    return str_replace($separator, '', $mac);
  }

  // Standardise the separators
  function AddSeparator($mac, $separator = ':') {
    return join($separator, str_split($mac, 2));
  }

  // Get the mac data
  $split_mac = json_decode($_POST['split_mac_json']);

  // Loop through the mac array
  foreach ($split_mac as $mac) {
    $query = "SELECT * FROM router WHERE mac_address = '$mac'";
    $result = pg_query($db, $query)
                or die('Something has gone terribly wrong. :(');
    $num = pg_num_rows($result);
    echo $mac;
    echo "\n";
    echo $num;
  }

  echo "OKAY";


/*
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
*/
?>