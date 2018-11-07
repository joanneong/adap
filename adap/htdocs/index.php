<?php
  include 'homepage/navbar_before_login.php';
?>

<!DOCTYPE html>  
<html lang="en">
<head>
  <title>ADAP</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../htdocs/css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
  <style></style>
</head>
<body>
<STYLE>
   .section {
	text-align: center;
  font-size: 200%;
  color: white;
  background-color: #050303;

	}

	img {
	width: 40%;
	margin: auto;
     vertical-align: middle;
	}

 </STYLE>
  <div class="section" id="WELCOME" >
	<H1><strong>Welcome</strong></H1>
 <img src="https://i.imgur.com/qxZhg7s.png" alt="adap">

	<H4>For organisations:</H4>
  <a href="../htdocs/login.php" class="waves-effect waves-light btn-large"><i class="material-icons left">account_circle</i>Login</a>
<a href="../htdocs/register.php" class="waves-effect waves-light btn-large"><i class="material-icons left">create</i>Sign up</a>  
<br>
  <H4>For common users:</H4>
<a href="../htdocs/search.php" class="waves-effect waves-light btn-large"><i class="material-icons left">perm_scan_wifi</i>Verify Access Points</a>
<br><br>
</div>

</body>
</html>
