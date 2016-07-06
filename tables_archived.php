<?php

  $conn = new mysqli("ip", "name", "pass", "name");

  include("login.php");


  if($_POST['edit-tag']) {

    //$conn = new mysqli("217.199.187.200", "cl56-cptag", "df!j/7KFY", "cl56-cptag");

    if (mysqli_connect_error()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }
    $tagname = $_POST['tagnameModal'];
    $tagtype = $_POST['tagtypeModal'];
    $identifier = $_POST['identifierModal'];
    $url = $_POST['urlModal'];
    $publisher = $_POST['publisherModal'];
    $advertiser = $_POST['advertiserModal'];
    $ecpm = $_POST['ecpmModal'];
    $ccpm = $_POST['ccpmModal'];
    $datebrokered = $_POST['datebrokeredModal'];
    $uniqueid = $_POST['uniqueid'];

    $sql = "UPDATE jpctags SET tagname=?, tagtype=?, identifier=?, url=?, publisher=?, advertiser=?, ecpm=?, ccpm=?, datebrokered=? WHERE unique_id=?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('ssssssiisi', $tagname, $tagtype, $identifier, $url, $publisher, $advertiser, $ecpm, $ccpm, $datebrokered, $uniqueid);
    $stmt -> execute();


  }

  if($_POST['activateTag']) {

    //$conn = new mysqli("217.199.187.200", "cl56-cptag", "df!j/7KFY", "cl56-cptag");

    if (mysqli_connect_error()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    $dateEnded = "0000-00-00";
    $active = 1;
    $uniqueidActivate = $_POST['uniqueidActivate'];

    $sql = "UPDATE jpctags SET active=?, dateend=? WHERE unique_id=?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('isi', $active, $dateEnded, $uniqueidActivate);
    $stmt -> execute();

  }

  $query = "SELECT * FROM jpctags WHERE active = 0 AND user_id='".$user_id."'";
  $result = mysqli_query($link, $query);

?>
