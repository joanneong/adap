<?php
  include 'homepage/navbar_before_login.php';
?>
<!DOCTYPE html>
<head>
  <title>ADAP</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
  #err {
    color: red;
  }
  </style>
</head>
<body>
  <?php
    // Connect to the database. Please change the password in the following line accordingly
    require_once 'config.php';
    $param = $_POST['email'];
    $result = pg_query($db, "SELECT * FROM company_account where email = '$param'");
    $row = pg_fetch_assoc($result); 
    //$sql = 'SELECT * FROM company_account';
    //$result = pg_prepare($db, "", $sql);
    //$result = pg_execute($db, "", $param);
    //$row = pg_fetch_all($result);
    if (isset($_POST['submit'])) {
      if (trim($_POST['email'])==null) $err = 'Please enter email';
      else if (trim($_POST['password'])==null) $err='Please enter password';
      else if ($row['email']==null) $err = 'Invalid email address';
      else if ($row['password']<>$_POST['password']) $err = 'Invalid password';
      else if (!(strcasecmp($row['identification'], 't') == 0)) $err = 'Account is not yet verified!';
      else {
            session_start();
            $_SESSION[email] = $row[email];
            header("location: router_management/view_routers.php");
         }
    }
    ?>
  <div class="container">
    <h3 class="grey-text text-darken-3 light center">Login</h3>
  </div>
  <div>
    <form name="display" action="login.php" method="POST" >
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <input type="email" name="email" value="<?php echo $_POST[email]; ?>" placeholder="Email" id="" />
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <input type="password" name="password" value="" placeholder="Password" id="  " />
        </div>
      </div>
      <div class="row">
        <div class="col s4 offset-s4 center">
          <p id="err"><?php echo $err; ?></p>
          <input type="submit" name="submit" value = "LOGIN"/>
          Not registered? <a href="register.php"> Sign up here </a>
        </div>
      </div>
      
      <br>
    </form>
  </div>

<!-- Import jQuery and other relevant JavaScript files -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
</body>
</html>