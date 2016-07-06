<?php

  session_start();

  include("connection.php");

  $query = "SELECT thought FROM users WHERE id='".$_SESSION['id']."' LIMIT 1";

  $result = mysqli_query($link, $query);

  $row = mysqli_fetch_array($result);

  $thought = $row['thought'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <title>Fyfe: On The Inside</title>

  <style>
  #topContainer {
    background-image: url("bridge.jpg");
    height:700px;
    width:100%;
    background-size: cover;
  }
  #topRow {
    margin-top:200px;
  }
  #topRow h1 {
    font-family:georgia, sans-serif;
    font-size: 3em;
    color: #848484;
    text-align: left;
  }
  a {
    font-family:georgia, sans-serif;
  }
  .form-control {
    font-family:georgia, sans-serif;
    font-size: 1em;
    font-weight: bold;
    text-align: center;
    vertical-align: text-bottom;
    border-color: #C8C5C2;
    background-color: rgba(97,131,159,0.5);
  }
  .mytext{
    padding-top: 100px;
    height: 200px;
    font-size: 20px;
    box-sizing: border-box;
    color: #ffffff;
  }
  </style>

  </head>
  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header pull-left">
          <a class="navbar-brand">Fyfe</a>
        </div>
        <div class="pull-right">
          <ul class="navbar nav">
            <li><a href="index.php?logout=1">Log Out</a></li>

          </ul>
        </div>
      </div>
    </nav>

    <div class="container contentContainer" id="topContainer">

      <div class="row">

        <div class="col-md-6 col-md-offset-3" id="topRow">

          <textarea class="form-control mytext" name="thought" placeholder="Where can we help your business go?"><?php echo $thought; ?></textarea>

        </div>

      </div>

    </div>

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(".contentContainer").css("min-height",$(window).height());
    $("textarea").css("height",0.36*$(window).height());
    $("textarea").keyup(function() {
      $.post("updatethought.php", {thought:$("textarea").val()});
    });
  </script>
  </body>
</html>
