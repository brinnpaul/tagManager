<?php

  $conn = new mysqli("ip", "name", "pass", "name");

  if ($_POST['submitpubs']) {
    if ($_POST['addpubs'] == "") $error = "</br>Please enter a partner name!";
    else {
      //$conn = new mysqli("217.199.187.200", "cl56-cptag", "df!j/7KFY", "cl56-cptag");

      if (mysqli_connect_error()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

      $partner = $_POST['addpubs'];
      $sql = "SELECT partner FROM pubsads WHERE partner=?";
      $stmt = $conn -> prepare($sql);
      $stmt -> bind_param('s',$partner);
      $stmt -> execute();
      $stmt -> store_result();
      $stmt -> bind_result($partner_exists);
      $stmt -> fetch();

      if ($partner_exists) $error = "This partner already exists within the system, no need to add it twice!";
      else {

        $partner = $_POST['addpubs'];
        $sql = "INSERT INTO pubsads (`partner`) VALUES(?)";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param('s', $partner);
        $stmt -> execute();

        $success = "The partner was successfully added to the database!";

      }
    }
  }

  if ($_POST['submitsources']) {
    if ($_POST['addsources'] == "") $error = "</br>Please enter a source name!";
    else {
      //$conn = new mysqli("217.199.187.200", "cl56-cptag", "df!j/7KFY", "cl56-cptag");

      if (mysqli_connect_error()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

      $source = $_POST['addsources'];
      $sql = "SELECT sources FROM tagsources WHERE sources=?";
      $stmt = $conn -> prepare($sql);
      $stmt -> bind_param('s',$source);
      $stmt -> execute();
      $stmt -> store_result();
      $stmt -> bind_result($source_exists);
      $stmt -> fetch();

      if ($source_exists) $error = "This source already exists within the system, no need to add it twice!";
      else {

        $source = $_POST['addsources'];
        $sql = "INSERT INTO tagsources (`sources`) VALUES(?)";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param('s', $source);
        $stmt -> execute();

        $success = "The tag source was successfully added to the database!";

      }
    }
  }

  $partner_query = "SELECT partner FROM pubsads";
  $partner_result = mysqli_query($conn, $partner_query);
  while ($row = mysqli_fetch_array($partner_result)) {
    $partners[] = $row;
  }



  $source_query = "SELECT sources FROM tagsources";
  $source_result = mysqli_query($conn, $source_query);
  while ($row = mysqli_fetch_array($source_result)) {
    $sources[] = $row;
  }
?>
