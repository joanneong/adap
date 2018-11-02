<?php
  #session_start();
  #if(!isset($_SESSION[email]) || empty($_SESSION[email]))
  #  include('headerN.php');
  #else include ('headerHi.php');
  include '../homepage/navbar_after_login.php';
 ?>
<!DOCTYPE html>
<head>
  <title>ADAP</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
    .bidder-num {font-size: 50px;}
    .text-size {font-size: 20px;}
    .delete {font-size: 30px;}
    .edit {font-size: 30px;}
    .delete:hover {
      color: #f44336;
      opacity: 0.6;
    }
    .edit:hover {
      color: #4caf50;
      opacity: 0.6;
    }
    #add-avail {
        position: fixed;
        bottom: 8px;
        right: 8px;
    }
  </style>
</head>
<body>
  <a class="waves-effect waves-light btn grey darken-2" href="" id="add-avail">Whitelist a router</a>
  <div class="container">
    <h3 class="grey-text text-darken-3 light center">Whitelisted Routers</h3>
  </div>
  <?php
      require_once '../config.php';
      /*$sql = "SELECT *
              FROM router
              WHERE company_email = '$_SESSION[email]'";*/
      $sql = "SELECT *
              FROM router
              WHERE company_email = 'cs3235@gmail.com'";
      $result = pg_query($db, $sql);

      // If the company has not whitelisted any router
      if (pg_num_rows($result) == 0) {
        echo "<h5 class=\"center\">No router has been whitelisted.</h5>";
      }

      // Create a while loop and loop through result set
      while($row = pg_fetch_assoc($result)){
        $mac_address = $row['mac_address'];
        $model = $row['model'];
        $version = $row['version'];
      }
    ?>
</body>
</html>