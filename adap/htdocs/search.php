<?php
  include 'homepage/navbar_before_login.php';
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
  <link type="text/css" rel="stylesheet" href="../htdocs/css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
  <style></style>

<STYLE>
   .section {
  font-size: 100%;
  color: black;
  background-color: #white;

  }

  .section {
    padding-top: 50px;
    padding-right: 30px;
    padding-bottom: 50px;
    padding-left: 60px;
}


 </STYLE>
  <div class="section" id="page" >
  <H4><strong>Enter your query:</strong></H4>
<div class="row">
        <div class="input-field col s6 offset-s3">
          <form action="../js/search.js">
          <input type="text" placeholder="Search.." name="search">
	      <button type="submit"><i class="fa fa-search"></i></button>
          </div>
      </div>
  </div>


  <!-- Import jQuery and other relevant JavaScript files -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript">
  </script>
  <script type="text/javascript" src="../js/search.js"></script>
</body>
</html>
