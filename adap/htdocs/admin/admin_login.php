<?php
  include('admin_navbar.php');
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
  #err {
    color: red;
  }
  </style>
</head>
<body>
  <?php
    // Connect to the database. Please change the password in the following line accordingly
    require_once '../config.php';
    $param = $_POST['username'];
    $result = pg_query($db, "SELECT * FROM admin where username = '$param'");
    $row = pg_fetch_assoc($result); 

    if (isset($_POST['submit'])) {
      if (trim($_POST['username'])==null) $err = 'Please enter username';
      else if (trim($_POST['password'])==null) $err='Please enter password';
      else if ($row['username']==null) $err = 'Invalid admin username';
      else if ($row['password']<>$_POST['password']) $err = 'Invalid password';
      else {
            session_start();
            $_SESSION[username] = $row[username];
            header("location: admin.php");
         }
    }
    ?>
  <div class="container">
    <h3 class="grey-text text-darken-3 light center">Admin Login</h3>
  </div>
  <div>
    <form name="display" action="admin_login.php" method="POST" >
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <input type="text" name="username" value="<?php echo $_POST[username]; ?>" placeholder="Username" id="" />
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
          <button class="btn waves-effect waves-light btn orange center-align" type="submit" name="submit">Login
          </button>
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