<?php
  include '../homepage/navbar_before_login.php';
?>

<!DOCTYPE html>  
<html lang="en">
<head>
  <title>ADAP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="../css/check_mac.css">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
  <div class="container">
    <div class="row">
      <h3 class="grey-text text-darken-3 light center">Verify MAC address</h3>
    </div>

    <div id="mac_input" class="row">
      <div class="row">
        <span class="row">Please input your MAC address(es) below:</span>
      </div>
      <form id="check_mac">
        <div class="row">
          <textarea id="mac_address" data-autoresize autofocus></textarea>
        </div>
        <div class="row">
          <div class="col s4 offset-s4 center">
            <button class="btn waves-effect waves-light btn orange center-align">Submit
              <i class="material-icons right"></i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="row" id="verification_results">
      <span style="white-space:pre-wrap; cursor:default;"></span>
    </div>

  <!-- Import jQuery and other relevant JavaScript files -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript" src="../js/check_mac.js"></script>
</body>
</html>
