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
    #back {
        position: fixed;
        bottom: 8px;
        right: 8px;
    }
  </style>
</head>
<body>
  <a class="waves-effect waves-light btn grey darken-2" href="view_routers.php" id="back">Back</a>
  <div class="container">
    <h3 class="grey-text text-darken-3 light center">Successfully updated router information!</h3>
  </div>
  <div class="container">
    <div class="row">
        <?php
          require_once '../config.php';
          /*$sql = "SELECT *
                  FROM router
                  WHERE company_email = '$_SESSION[email]'";*/
          $sql = "SELECT *
                  FROM router
                  WHERE mac_address = '$_GET[mac_address]'";
          $result = pg_query($db, $sql);

          // Create a while loop and loop through result set
          while($row = pg_fetch_assoc($result)){
            $mac_address = $row['mac_address'];
            $model = $row['model'];
            $version = $row['version'];

            // TODO: display routers
            ?>
            <div class="col s4 offset-s4">
              <div class="card hoverable">
                <div class="card-content">
                  <div class="row">
                    <img src="../img/linksys-EA7300.jpg" height="200">
                  </div>
                  <div class="row">
                      <p>
                        <span class="orange-text text-darken-1 text-size light">Router MAC Address:
                        <span class="grey-text text-darken-2 text-size light"><?php echo $mac_address ?>
                      </p>
                      <p>
                        <span class="orange-text text-darken-1 text-size light">Router Model:
                        <span class="grey-text text-darken-2 text-size light"><?php echo $model ?>
                      </p>
                      <p>
                        <span class="orange-text text-darken-1 text-size light">Router Firmware Version:
                        <span class="grey-text text-darken-2 text-size light"><?php echo $version ?>
                      </p>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
        ?>
    </div>
  </div>
</body>
</html>
