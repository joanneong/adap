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
      $company_name = test_input($_POST['company_name']);
      $company_name_bool = false;
      $email = test_input($_POST['email']);
      $email_bool = false;
      $password = test_input($_POST['password']);
      $password_bool = false;
      $contact = test_input($_POST['contact']);
      $contact_bool = false;
      $address = test_input($_POST['address']);
      $address_bool = false;
      $postal_code = test_input($_POST['postal_code']);
      $postal_code_bool = false;

      if ($company_name==null) $company_name_err = 'Company name is empty!';
      else $company_name_bool = true;

      if ($email==null) $email_err= 'Email is empty!';
      else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $email_err = 'Email is invalid!';
      else $email_bool = true;
      
      // Credits to https://stackoverflow.com/questions/8141125/regex-for-password-php
      if ($password==null) $password_err = 'Password is empty!';
      else if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(\S+)$/i", $password)) $password_err = 'Password is not complex enough! It must be at least 8 characters long, contain at least one upper case letter, one lower case letter and one digit.';
      else if (($_POST['password_reenter']==null)||($password<>$_POST['password_reenter'])) $password_comp_err = 'Passwords do not match!';
      else $password_bool = true;

      if ($contact==null) $contact_err ='Contact Number is empty!';
      else if (!is_numeric($contact)||(strlen($contact)<3)) {
        $contact_err ='Contact Number is Invalid';
        $contact = 'invalid';
      }
      else $contact_bool = true;

      if ($address==null) $address_err ='Address is empty!';
      else $address_bool = true;
      
      if ($postal_code==null) $postal_code_err ='Postal code is empty!';
      else if (!is_numeric($postal_code)||!(strlen($postal_code)==6)) {
        $postal_code_err ='Postal Code is Invalid!';
        $postal_code = 'invalid';
      }
      else $postal_code_bool = true;

      if (($company_name_bool == true) && ($email_bool == true) && ($password_bool == true) && ($contact_bool == true) && ($address_bool == true) && ($postal_code_bool == true)) {
        // $result = pg_query($db, "INSERT INTO company_account VALUES ('$company_name','$email','$password','$contact','$address','$postal_code')");
        $result = pg_prepare($db, "query", 'INSERT INTO company_account VALUES ($1, $2, $3, $4, $5, $6)');
        $tag = array($company_name, $email, $password, $contact, $address, $postal_code);
        $result = pg_execute($db, "query", $tag);
        if (!$result)  $err = 'Account was already created before. Would you like to <a href="login.php">log in</a> instead? <br />';
        else {
            header("location: register_success.php");
        }
      }}

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = xss_clean($data);
      return $data;
    }
    // Credits to: https://stackoverflow.com/questions/1336776/xss-filtering-function-in-php
    function xss_clean($data)
    {
    // Fix &entity\n;
    $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do
    {
      // Remove really unwanted tags
      $old_data = $data;
      $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);

    // we are done...
    return $data;
    }
    function debug_to_console( $data ) {
      $output = $data;
      if ( is_array( $output ) )
          $output = implode( ',', $output);

      echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }

    ?>
  <div class="container">
    <h3 class="grey-text text-darken-3 light center">Register</h3>
  </div>
  <div class="center"><?php echo $err; ?></div>
  <div>
    <form name="display" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="company_name">Company Name:</label> <br />
          <input class="materialize-textarea" type="text" name="company_name" value="<?php echo $company_name ?>" placeholder="Company Name"/>
          <span class="reg_err"><?php echo $company_name_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="email">Email: </label> <br />
          <input class="materialize-textarea" type="email" name="email" value="<?php echo $email ?>" placeholder="Email"/>
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
          <input class="materialize-textarea" type="text" name="contact" value="<?php echo $contact ?>" placeholder="Contact"/>
          <span class="reg_err"><?php echo $contact_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="address">Address: </label> <br />
          <input class="materialize-textarea" type="text" name="address" value="<?php echo $address ?>" placeholder="Address"/>
          <span class="reg_err"><?php echo $address_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <label for="postal_code">Postal Code: </label> <br />
          <input type="text" name="postal_code" value="<?php echo $postal_code ?>" placeholder="Postal Code"/>
          <span class="reg_err"><?php echo $postal_code_err; ?></span>
        </div>
      </div>
      <div class="row">
        <div class="col s4 offset-s4 center">
          <input type="submit" name="submit" value = "REGISTER"/>
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