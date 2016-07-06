<?php

  include("toggle.php");

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand brand"></a>
      <a class="navbar-brand"></a>
      <a class="navbar-brand">Tag Manager</a>
    </div>
    <div class="navbar-collapse collapse">
      <form method="post">
        <ul class="nav navbar-nav">
          <li type="submit" name="active"><a id="active" href="active.php">Active Tags</a></li>
          <li type="submit" name="archive"><a id="archive" href="archived.php">Archived Tags</a></li>
          <!-- <li class ="pull-right"><a href="index.php?logout=1">Log Out</a></li> -->
        </ul>
        <ul class="navbar-nav nav pull-right">
          <li><a href="index.php?logout=1">Log Out</a></li>
        </ul>
      </form>
    </div><!--/.nav-collapse -->
    <!-- <div class="navbar-collapse collapse pull-right">
      <ul class="navbar-nav nav">
        <li><a href="index.php?logout=1">Log Out</a></li>
      </ul>
    </div> -->
  </div>
</nav>
