<?php
   session_start();
   if(!isset($_SESSION[username]) || empty($_SESSION[username]))
     header("location: admin_login.php");
   else include('admin_navbar_after_login.php');
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
  <style>
  </style>
</head>
<body>
  <div class="row">
      <div class="col s10 page-content">
        <!-- Teal page content  -->
        <h4 class="grey-text center text-darken-2">Admin</h3>
        <div class="container center">
        <table style="width:100%" class="highlight center">
          <thead>
            <tr>
              <th class="grey-text text-darken-2">Company Name</th>
              <th class="grey-text text-darken-2">Email</th>
              <th class="grey-text text-darken-2">Contact</th>
              <th class="grey-text text-darken-2">Address</th>
              <th class="grey-text text-darken-2">Postal code</th>
              <th class="grey-text text-darken-2">Approved</th>
            </tr>
          </thead>
          <div id="message">
            <?php
              if(isset($_GET["msg"])){
                echo '<h5 class="grey-text text-darken-2">' . $_GET["msg"] . '</h5>';
              }
            ?>
          </div>

          <?php
            require_once '../config.php';
            $sql = "SELECT *
                    FROM company_account
                    ORDER BY company_name ASC";
            $result = pg_query($db, $sql);
            $counter = 0;
            // Create  while loop and loop through result set
            while($row = pg_fetch_assoc($result)){
              $name    = $row['company_name'];
              $email  = $row['email'];
              $contact = $row['contact'];
              $address = $row['address'];
              $postal_code = $row['postal_code'];
              $approved = $row['identification'];

              echo "<tr>";
                echo "<td align='center'>" .$name . "</td>";
                echo "<td align='center'>" .$email . "</td>";
                echo "<td align='center'>" .$contact . "</td>";
                echo "<td align='center'>" .$address . "</td>";
                echo "<td align='center'>" .$postal_code . "</td>";
                echo "<td align='center'>" .$approved . "</td>";

                echo "
                <div class = 'approve'>
                  <td align='center'>
                    <form name='approve$counter' action='admin_approve.php' method='POST'>
                      <input type='hidden' name='company_name' value='$name'>
                      <input type='hidden' name='email' value='$email'>
                      <input type='hidden' name='contact' value='$contact'>
                      <input type='hidden' name='address' value='$address'>
                      <input type='hidden' name='postal_code' value='$postal_code'>
                      <input type='hidden' name='approved' value='$approved'>

                      <button type='submit' name='approve$counter' class='btn waves-effect waves-light green lighten-2'>Approve</button>
                    </form>
                  </td>
                </div>";
           
                echo "
                <div class = 'disapprove'>
                  <td align='center'>
                    <form name='disapprove$counter' action='admin_disapprove.php' method='POST'>
                      <input type='hidden' name='company_name' value='$name'>
                      <input type='hidden' name='email' value='$email'>
                      <input type='hidden' name='contact' value='$contact'>
                      <input type='hidden' name='address' value='$address'>
                      <input type='hidden' name='postal_code' value='$postal_code'>
                      <input type='hidden' name='approved' value='$approved'>

                      <button type='submit' name='disapprove$counter' class='btn waves-effect waves-light red accent-2'>Disapprove</button>
                    </form>
                  </td>
                </div>";

                echo "</tr>";

                $counter = $counter + 1;
            }
          ?>

        </table>
        </div>
      </div>

    </div>

</body>
</html>