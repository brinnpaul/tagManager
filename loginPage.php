<?php include("login.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title>fyfe</title>

  <style>
  #topContainer {
    background-image: url("paraboloid.jpg");
    height:400px;
    width:100%;
    background-size: cover;
  }
  #topRow {
    margin-top:100px;
  }
  #topRow h1 {
    font-family:georgia, sans-serif;
    font-size: 3em;
    color: #848484;
    text-align: left;
  }
  .btn-success {
    border-color: #04c9d3;
    background-color: #5ec1d1;
    font-family:georgia, sans-serif;
  }
  .btn-success:hover {
    border-color: #06c2c9;
    background-color: #39a9ba;
  }
  .btn-success:active:focus {
    border-color: #06c2c9;
    background-color: #39a9ba;
  }
  .navbar-toggle {
    border-color: #04c9d3;
    background-color: #5ec1d1;
  }
  .navbar-default .navbar-toggle:hover {
    border-color: #06c2c9;
    background-color: #39a9ba;
  }
  .text {
    font-family:georgia, sans-serif;
    font-size: 1em;
    font-weight:bold;
    color: #848484;
    text-align: left;
  }
  #btn {
    text-align: center;
  }
  a {
    font-family:georgia, sans-serif;
  }
  .form-group {
    font-family:georgia, sans-serif;
  }
  .navbar-default .navbar-toggle .icon-bar {
    color: #ffffff;
    background-color: #ffffff;
  }
  .input-group-addon {
    width:40px;
    font-family:georgia, sans-serif;
    font-size: 1em;
    font-weight:bold;
    color: #848484;
    text-align: center;
  }
  </style>

  </head>
  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">CPM</a>
        </div>

        <div class="collapse navbar-collapse">
          <form class="navbar-form navbar-right" method="post">
            <div class="form-group">
              <input type="email" placeholder="Email" class="form-control" name="loginEmail" id="loginEmail" value="<?php echo addslashes($_POST['loginEmail']); ?>" />
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="loginPassword" value="<?php echo addslashes($_POST['loginPassword']); ?>" />
            </div>
              <input type="submit" class="btn btn-success" name="submit" value="Log In"/>
          </form>
        </div>
      </div>
    </nav>

    <div class="container contentContainer" id="topContainer">

      <div class="row">
        <div class="col-md-6 col-md-offset-3" id="topRow">
          <h1>CPM</h1>
          <p class="text">Tag Management System</p>
          <p class="text">Sign up to get your own account.</p>

          <?php
            if($error) {
              echo '<div class="alert alert-danger">'.addslashes($error).'</div>';
            }
            if($signup) {
              echo '<div class="alert alert-success">'.addslashes($signup).'</div>';
            }
            if($message) {
              echo '<div class="alert alert-success">'.addslashes($message).'</div>';
            }
           ?>
         </div>
       </div>
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <form class="marginTop center form-horizontal" method="post">
            <div class="form-group">
              <div class="input-group col-md-12"><span class="input-group-addon">@</span>
                <input type="email" class="form-control" name="email" id="email" placeholder="Your email" value="<?php echo addslashes($_POST['email']); ?>" />
              </div>
            </div>
            <div class="form-group" id="btn">
              <div class="input-group col-md-12"><span class="input-group-addon">*</span>
                <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo addslashes($_POST['password']); ?>" />
              </div>
            </div>
              <input type="submit" class="btn btn-success marginTop" name="submit" value="Sign Up" />
          </form>
        </div>
      </div>

    </div>

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <script>
    $(".contentContainer").css("min-height",$(window).height());

    // window.location.href = 'http://www.yahoo.com';

    // window.setTimeout(function(){ window.location = "http://www.yahoo.com"; },3000);
  </script>
  </body>
</html>
