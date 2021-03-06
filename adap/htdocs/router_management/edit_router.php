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
  <link rel="stylesheet" type="text/css" href="../css/add_router.css">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
  </style>
</head>
<body>
  <div class="container">
    <h3 class="grey-text text-darken-3 light center">Edit Router Information</h3>
  </div>

 <div class="row">
    <form class="col s12" id="edit_router">
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <i class="material-icons prefix">wifi</i>
          <input id="mac_address" type="text" class="materialize-textarea" value="<?php echo "$_GET[mac_address]";?>">
          <label for="mac_address">Router MAC Address</label>
        </div>
      </div>
      
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <i class="material-icons prefix">router</i>
          <input id="model" type="text" class="materialize-textarea" value="<?php echo "$_GET[model]";?>">
          <label for="model">Router Model</label>
        </div>
      </div>
    
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <i class="material-icons prefix">laptop</i>
          <input id="version" type="text" class="materialize-textarea" value="<?php echo "$_GET[version]";?>">
          <label for="version">Router Firmware Version</label>
        </div>
      </div>
      <div class="row">
        <div class="col s4 offset-s4 center">
          <button class="btn waves-effect waves-light btn orange center-align" type="submit" name="submitedit">Submit
            <i class="material-icons right"></i>
          </button>
        </div>
      </div>
    </form>
  </div>

  <!-- Import jQuery and other relevant JavaScript files -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript">
    var original_mac_addr = '<?php echo "$_GET[mac_address]";?>';
    var original_model = '<?php echo "$_GET[model]";?>';
    var original_version = '<?php echo "$_GET[version]";?>';
  </script>
  <script type="text/javascript" src="../js/edit_router.js"></script>
</body>
</html>
