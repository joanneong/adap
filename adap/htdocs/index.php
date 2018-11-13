<?php
   session_start();
   if(!isset($_SESSION[email]) || empty($_SESSION[email])) {
    include('homepage/navbar_before_login_index.php');
   } else {
   	include ('homepage/navbar_after_login_index.php');
	//include('homepage/navbar_before_login_index.php');
   }
?>

<!DOCTYPE html>  
<html lang="en">
  <head>
    <title>ADAP</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
      li {list-style: none;}
    /*  body {
        background-color: grey;
        text-align: center;
        color: #fff;
      }*/
      body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
      }
      main {
        flex: 1 0 auto;
        background-image: url("img/background.jpg");
        background-repeat: no-repeat;
        background-size: 1368px 912px;
      }
      * { 
        color: #fff; 
        text-decoration: none;
      }
      .wrap {
        font-family: monospace;
      }
      img {
        height: 50%;
        width: 50%;
      }
      h5 {
        padding-top: 3em;
        padding-bottom: 2em;
      }
      .company_links {
        padding-top: 15em;
      }
      .user_btn {
        padding-bottom: 3em;
      }
    </style>
  </head>
  <main>
    <div class="row">
      <div class="col offset-s1">
        <h5 class="left">
          <a href="" class="typewrite" data-period="2000" data-type='[ "Hi, welcome to ADAP.", "Attack and Defence for Access Points."]'>
            <span class="wrap"></span>
          </a>
        </h5>
      </div>
    </div>
    
    <!-- <div class="carousel carousel-slider">
      <a class="carousel-item" href="#one!"><img src="img/company.jpg" height="50" width="50"></a>
      <a class="carousel-item" href="#two!"><img src="img/adap_logo.png" height="50"></a>
    </div> -->
    <?php
      if(!isset($_SESSION[email]) || empty($_SESSION[email])) {
    ?>
      <div class="row">
        <div class="col s4 offset-s1">
          <h6 class="company_links white-text">For organisations:</h5>
          <a href="account/login.php" class="waves-effect waves-light btn orange">
            <i class="material-icons left">account_circle</i>Login
          </a>
          <a href="account/register.php" class="waves-effect waves-light btn orange">
            <i class="material-icons left">create</i>Sign up
          </a>  
        </div>
      </div>
      <div class="row user_btn">
        <div class="col s4 offset-s1">
          <h6 class="white-text">For end users:</h5>
          <a href="user_page/check_mac.php" class="waves-effect waves-light btn orange ">
            <i class="material-icons left">perm_scan_wifi</i>Verify Access Points
          </a>
        </div>
      </div>
    <?php
      }
    ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
        var TxtType = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };

        TxtType.prototype.tick = function() {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
            } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
            }

            this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

            var that = this;
            var delta = 200 - Math.random() * 100;

            if (this.isDeleting) { delta /= 2; }

            if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
            } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
            }

            setTimeout(function() {
            that.tick();
            }, delta);
        };

        window.onload = function() {
            var elements = document.getElementsByClassName('typewrite');
            for (var i=0; i<elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-type');
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                  new TxtType(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
            document.body.appendChild(css);
        };

        $('.carousel.carousel-slider').carousel({
          fullWidth: true,
          indicators: true
        });
        autoplay();
        function autoplay() {
            $('.carousel').carousel('next');
            setTimeout(autoplay, 5000);
        }
    </script>
  </main>
  <footer class="page-footer grey darken-1">
    <div class="footer-copyright grey darken-1">
      <div class="container">
        © 2018 Copyright CS3235 Team 4
        <?php
          if(!isset($_SESSION[email]) || empty($_SESSION[email])) {
        ?>
        <a class="grey-text text-lighten-4 right" href="admin/admin_login.php">Log in as Admin</a>
        <?php
          }
        ?>
      </div>
    </div>
  </footer>
</html>
