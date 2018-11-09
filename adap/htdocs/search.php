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
 	<form id="search">
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <input id="mac" type="text" value="<?php echo "$_GET[mac_address]"; ?>"
          class="materialize-textarea">
          <label for="mac"></label>
        </div>
      </div>
      <div class="row">
        <div class="col s4 offset-s4 center">
          <button class="btn waves-effect waves-light btn orange center-align" type="submit" name="submitadd">
            <i class="material-icons right"></i>
            <input type="submit">
          </button>
        </div>
      </div>
  </form>


  <!-- Import jQuery and other relevant JavaScript files -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../htdocs/js/materialize.min.js"></script>
  <script type="text/javascript" src="../htdocs/js/search.js"></script>
</body>
</html>
