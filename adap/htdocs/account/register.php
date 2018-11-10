<?php
  include '../homepage/navbar_before_login.php';
?>
<!DOCTYPE html>
<head>
  <title>ADAP</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
  span.reg_err {
    color: red;
  }
  </style>
</head>
<body>
  <?php
    // Connect to the database. Please change the password in the following line accordingly
    require_once '../config.php';
    if (isset($_POST['submit'])) { // Submit the update SQL command
      $company_name = $_POST['company_name'];
      $company_name_bool = false;
      $email = $_POST['email'];
      $email_bool = false;
      $password = $_POST['password'];
      $password_bool = false;
      $contact = $_POST['contact'];
      $contact_bool = false;
      $address = $_POST['address'];
      $address_bool = false;
      $postal_code = $_POST['postal_code'];
      $postal_code_bool = false;

      if ($company_name==null) $company_name_err = 'Company name is empty!';
      else $company_name_bool = true;

      if ($email==null) $email_err= 'Email is empty!';
      else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $email_err = 'Email is invalid!';
      else $email_bool = true;
      
      if ($password==null) $password_err = 'Password is empty!';
      else if (($_POST['password_reenter']==null)||($password<>$_POST['password_reenter'])) $password_comp_err = 'Passwords do not match!';
      else $password_bool = true;

      if ($contact==null) $contact_err ='Contact Number is empty!';
      else if (!is_numeric($contact)||(strlen($contact)<3)) $contact_err ='Contact Number is Invalid';
      else $contact_bool = true;

      if ($address==null) $address_err ='Address is empty!';
      else $address_bool = true;
      
      if ($postal_code==null) $postal_code_err ='Postal code is empty!';
      else if (!is_numeric($postal_code)||!(strlen($postal_code)==6)) $postal_code_err ='Postal Code is Invalid!';
      else $postal_code_bool = true;

      if (($company_name_bool == true) && ($email_bool == true) && ($password_bool == true) && ($contact_bool == true) && ($address_bool == true) && ($postal_code_bool == true)) {
        $result = pg_query($db, "INSERT INTO company_account VALUES ('$company_name','$email','$password','$contact','$address','$postal_code')");
        if (!$result)  $err = 'Account was already created before. Would you like to <a href="../adap/login.php">log in</a> instead?';
        else {
            header("location: register_success.php");
        }
      }}
    ?>
  <div class="container">
    <h3 class="grey-text text-darken-3 light center">Register</h3>
  </div>  
  <div>
    <form name="display" action="register.php" method="POST" >
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="company_name">Company Name:</label> <br />
          <input class="materialize-textarea" type="text" name="company_name" value="<?php echo $_POST['company_name']; ?>" placeholder="Company Name"/>
          <span class="reg_err"><?php echo $company_name_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="email">Email: </label> <br />
          <input class="materialize-textarea" type="email" name="email" value="<?php echo $_POST['email']; ?>" placeholder="Email"/>
          <span class="reg_err"><?php echo $email_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="password">Password: </label> <br />
          <input class="materialize-textarea" type="password" name="password" value="" placeholder="Password"/>
          <span class="reg_err"><?php echo $password_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="password_reenter">Re-enter your password: </label> <br />
          <input class="materialize-textarea" type="password" name="password_reenter" value="" placeholder=""/>
          <span class="reg_err"><?php echo $password_comp_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="contact">Contact Number: </label> <br />
          <input class="materialize-textarea" type="text" name="contact" value="<?php echo $_POST['contact']; ?>" placeholder="Contact"/>
          <span class="reg_err"><?php echo $contact_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="address">Address: </label> <br />
          <input class="materialize-textarea" type="text" name="address" value="<?php echo $_POST['address']; ?>" placeholder="Address"/>
          <span class="reg_err"><?php echo $address_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="postal_code">Postal Code: </label> <br />
          <input type="text" name="postal_code" value="<?php echo $_POST['postal_code']; ?>" placeholder="Postal Code"/>
          <span class="reg_err"><?php echo $postal_code_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="col s4 offset-s4 center">
          <input type="submit" name="submit" value = "REGISTER"/>
        </div>
      </div>
      <?php echo $err; ?>
      <br>
    </form>
  </div>

<!-- Import jQuery and other relevant JavaScript files -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
</body>
</html>