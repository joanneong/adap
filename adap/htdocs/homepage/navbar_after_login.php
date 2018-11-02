<?php
// Initialize the session
// session_start();
// require_once 'config.php';
// $result = pg_query($db, "SELECT name FROM account where email = '$_SESSION[email]'");
// $row    = pg_fetch_assoc($result);
// $_SESSION[name] = $row[name];

// If session variable is not set it will redirect to login page
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ADAP</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
  <style>
  </style>
</head>
<body>
    <nav class="grey darken-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="../index.php" class="brand-logo" style="left:0%">ADAP</a>
      <ul class="right">
        <!--li><?php echo $_SESSION[name]; ?></li-->
        <li><a href="../index.php">Home</a></li>
        <li><a href="../router_management/view_routers.php">Manage Whitelisted Routers</a></li>
        <li><a href="logout.php">Sign out</a></li>
      </ul>
    </div>
  </nav>

</body>
</html>
