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

  $response = array("numOfResults"=>$num, "result"=>pg_fetch_row($result));
  echo json_encode($response);
?>
