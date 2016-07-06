<?php

  $conn = new mysqli("ip", "name", "pass", "name");

  include('login.php');

  if($_POST['submit']) {
    if ($_POST['tagname']=="") $error.="<br />Please enter a tag name!";
    if ($_POST['tagtype']=="") $error.="<br />Please enter a tag type!";
    if ($_POST['url']=="") $error.="<br />Please enter a tag URL!";
    if ($_POST['publisher']=="") $error.="<br />Please enter a publisher!";
    if ($_POST['advertiser']=="") $error.="<br />Please enter an advertiser!";
    if ($_POST['identifier']=="") $error.="<br />Please enter an ID!";
    if ($_POST['ecpm']=="") $error.="<br />Please enter the eCPM rate!";
    if ($_POST['ccpm']=="") $error.="<br />Please enter the eCPM rate!";
    if ($_POST['datebrokered']=="") $error.="<br />Please enter the date brokered!";
    else {


      if (mysqli_connect_error()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

        $identifier = $_POST['identifier'];
        $sql = "SELECT unique_id FROM jpctags WHERE identifier=?";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param('s',$identifier);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($uniqueid);
        $stmt -> fetch();

        if ($uniqueid) $error = "This tag already exits within the system, please edit the tag instead.";
        else {

            $tagname = $_POST['tagname'];
            $tagtype = $_POST['tagtype'];
            $identifier = $_POST['identifier'];
            $url = $_POST['url'];
            $publisher = $_POST['publisher'];
            $advertiser = $_POST['advertiser'];
            $ecpm = $_POST['ecpm'];
            $ccpm = $_POST['ccpm'];
            $datebrokered = $_POST['datebrokered'];

            $sql = "INSERT INTO jpctags (`tagname`, `tagtype`, `identifier`, `url`, `publisher`, `advertiser`, `ecpm`, `ccpm`, `datebrokered`, `user_id`) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn -> prepare($sql);
            $stmt -> bind_param('ssssssiisi',$tagname, $tagtype, $identifier, $url, $publisher, $advertiser, $ecpm, $ccpm, $datebrokered, $user_id);
            $stmt -> execute();

        }
      }
    }

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

  if($_POST['archiveTag']) {

    //$conn = new mysqli("217.199.187.200", "cl56-cptag", "df!j/7KFY", "cl56-cptag");

    if (mysqli_connect_error()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    $dateEnded = $_POST['dateEndedModal'];
    $active = 0;
    $uniqueidArchive = $_POST['uniqueidArchive'];

    $sql = "UPDATE jpctags SET active=?, dateend=? WHERE unique_id=?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('isi', $active, $dateEnded, $uniqueidArchive);
    $stmt -> execute();
  }

  // $query = "SELECT * FROM jpctags WHERE active = 1 AND user_id='".$user_id."'";
  $query = "SELECT tagname, tagtype, identifier, url, publisher, advertiser, ecpm, ccpm, datebrokered, unique_id FROM jpctags WHERE active = 1 AND user_id='".$user_id."'";
  $result = mysqli_query($link, $query);
?>
