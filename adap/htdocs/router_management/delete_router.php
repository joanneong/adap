<?php
  // session_start();
  // if(!isset($_SESSION[email]) || empty($_SESSION[email]))
  //   include('headerN.php');
  // else include ('headerHi.php');
  include '../homepage/navbar_after_login.php';
?>
<!DOCTYPE html>
<head>
  <title>ADAP</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="../css/add_router.css">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
  </style>
</head>
<body>
  <div class="container">
    <div class="row center-align" style="margin-top:20%;">
      <div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
          </div><div class="gap-patch">
          <div class="circle"></div>
          </div><div class="circle-clipper right">
          <div class="circle"></div>
          </div>
          </div>
        </div>
        <div class="center-align">
            <p>Deleting your router information...</p>
        </div>
        </div>
    </div>
  </div>

  <!-- Import relevant JavaScript files -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript">
    var mac_address = '<?php echo "$_GET[mac_address]";?>';
  </script>
  <script type="text/javascript" src="../js/delete_router.js"></script>
</body>
</html>
