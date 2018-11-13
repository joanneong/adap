<?php
    include_once("../config.php");
    $query = "UPDATE company_account
            SET identification = false
            WHERE email = '$_POST[email]'";
    $result = pg_query($db, $query);

    if($result) {
      header("Location: admin.php?msg=Successfully disapproved!");
    } else {
      header("Location: admin.php?msg=Failed to disapprove this account!");
    }
?>
