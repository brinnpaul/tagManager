<?php

  $conn = new mysqli("ip", "name", "pass", "name");

  if($_POST['submit']) {
    if ($_POST['tagname']=="") $error.="<br />Please enter a tag name!";
    if ($_POST['tagtype']=="") $error.="<br />Please enter a tag type!";
    if ($_POST['brokered']=="") $error.="<br />Please enter broker type!";
    if ($_POST['company']=="") $error.="<br />Please enter a company!";
    if ($_POST['identifier']=="") $error.="<br />Please enter an ID!";
    if ($_POST['rate']=="") $error.="<br />Please enter the CPM rate!";
    if ($_POST['datebrokered']=="") $error.="<br />Please enter the date brokered!";
    else {
      //$conn = new mysqli("217.199.187.200", "cl56-cptag", "df!j/7KFY", "cl56-cptag");

      if (mysqli_connect_error()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

        $identifier = $_POST['identifier'];
        $sql = "SELECT uniqueid FROM tags WHERE identifier=?";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param('i',$identifier);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($uniqueid);
        $stmt -> fetch();

        if ($uniqueid) $error = "This tag already exits within the system, please edit the tag instead.";
        else {

            $tagname = $_POST['tagname'];
            $tagtype = $_POST['tagtype'];
            $brokered = $_POST['brokered'];
            $company = $_POST['company'];
            $identifier = $_POST['identifier'];
            $rate = $_POST['rate'];
            $datebrokered = $_POST['datebrokered'];
            $sql = "INSERT INTO tags (`tagname`, `tagtype`, `brokered`, `company`, `identifier`, `rate`, `datebrokered`) VALUES(?,?,?,?,?,?,?)";
            $stmt = $conn -> prepare($sql);
            $stmt -> bind_param('sssssis',$tagname, $tagname, $brokered, $company, $identifier, $rate, $datebrokered);
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
    $brokered = $_POST['brokeredModal'];
    $company = $_POST['companyModal'];
    $rate = $_POST['rateModal'];
    $datebrokered = $_POST['datebrokeredModal'];
    $uniqueid = $_POST['uniqueid'];

    $sql = "UPDATE tags SET tagname=?, tagtype=?, brokered=?, company=?, rate=?, datebrokered=? WHERE uniqueid=?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('ssssisi', $tagname, $tagtype, $brokered, $company, $rate, $datebrokered, $uniqueid);
    $stmt -> execute();

  }

  if($_POST['archiveTag']) {

    //$conn = new mysqli("217.199.187.200", "cl56-cptag", "df!j/7KFY", "cl56-cptag");

    if (mysqli_connect_error()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }
    if($_POST[''])
    $dateEnded = $_POST['dateEndedModal'];
    $active = 1;
    $uniqueidArchive = $_POST['uniqueidArchive'];

    $sql = "UPDATE tags SET active=?, dateended=? WHERE uniqueid=?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('isi', $active, $dateEnded, $uniqueidArchive);
    $stmt -> execute();

  }

  $query = "SELECT * FROM tags WHERE active = 0";
  $result = mysqli_query($link, $query);
?>
