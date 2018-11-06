<?php
  // Connect to the database
  include("../config.php");

  // Query for CVEs for the given router model and version
  $query = "SELECT cve_id, cve_severity, cve_description FROM cve
            WHERE router_model = '$_POST[router_model]'";

  $result = pg_query($db, $query)
              or die('Query failed.');

  $num = pg_num_rows($result);
  $response = array("numOfResults"=>$num);

  while($row = pg_fetch_assoc($result)) {
    $response["results"][] = $row;
  }

  echo json_encode($response);
?>
