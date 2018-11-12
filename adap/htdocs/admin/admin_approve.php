<?php
    include_once("../config.php");
    $query = "UPDATE company_account
            SET identification = true
            WHERE email = '$_POST[email]'";
    $result = pg_query($db, $query);

    if($result) {
      header("Location: admin.php?msg=Successfully approved!");
    } else {
      header("Location: admin.php?msg=Failed to approve this account!");
    }
?>
