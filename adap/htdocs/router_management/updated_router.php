<?php
  session_start();
  if(!isset($_SESSION[email]) || empty($_SESSION[email]))
    include('../homepage/navbar_before_login.php');
  else include ('../homepage/navbar_after_login.php');
?>
<!DOCTYPE html>
<head>
  <title>ADAP</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="../css/view_routers.css">

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
                  <div class="row img_container">
                    <img src="../img/linksys-EA7300.jpg" height="200">
                    <span class="overlay activator" id="<?php echo $counter ?> router_model=<?php echo $model ?>&router_version=<?php echo $version ?>">
                      <p class="hint activator" id="<?php echo $counter ?> router_model=<?php echo $model ?>&router_version=<?php echo $version ?>">
                        Click to see known common vulnerabilities for this router!
                      </p>
                    </span>
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
                <div class="card-reveal">
                  <span class="card-title red-text text-darken-4">CVE Information<i class="material-icons right">close</i></span>
                  <p><b>Model:</b> <?php echo $model ?></p>
                  <p><b>Version:</b> <?php echo $version ?></p>
                  <span style="white-space:pre-wrap; cursor:default;" class="col s12 cve" id="cve_content<?php echo $counter ?>"></span>
                </div>
              </div>
            </div>
          <?php
          }
        ?>
    </div>
  </div>
  
  <!-- Import jQuery and other relevant JavaScript files -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript" src="../js/view_cve.js"></script>
</body>
</html>
