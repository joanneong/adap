<?php
  // Connect to the database
  include("../config.php");

  // Credits for helper functions go to: 
  // https://www.stetsenko.net/2011/01/php-mac-address-validating-and-formatting/
  // Checks if a given mac is in a valid format
  function isValid($mac) {
    return (preg_match('/([a-fA-F0-9]{2}[:|\-]?){6}/', $mac) == 1);
  }

  // Remove separators : and -
  function removeSeparator($mac, $separator = array(':', '-')) {
    return str_replace($separator, '', $mac);
  }

  // Standardise the separators
  function addSeparator($mac, $separator = ':') {
    return join($separator, str_split($mac, 2));
  }

  // Get the mac data
  $split_mac = json_decode($_POST['split_mac_json']);

  // Initialise the results array
  $verification_results["whitelisted"] = array();
  $verification_results["not_whitelisted"] = array();
  $verification_results["invalid_mac"] = array();

  // Loop through the mac array
  foreach ($split_mac as $mac) {
    $mac = trim($mac);
    
    // Ignore empty inputs (e.g. newlines)
    if ($mac == '') {
      continue;
    }
    
    if (!isValid($mac)) {
      $verification_results["invalid"][] = $mac;
      continue;
    }

    $mac = addSeparator(removeSeparator($mac));
    $query = "SELECT * FROM router WHERE mac_address = '$mac'";
    $result = pg_query($db, $query)
                or die('Something has gone terribly wrong. :(');
    $num = pg_num_rows($result);

    if ($num == 1) {
      $verification_results["whitelisted"][] = $mac;
    } else {
      $verification_results["not_whitelisted"][] = $mac;
    }
  }

  echo json_encode($verification_results);
?>