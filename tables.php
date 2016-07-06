<?php

  include("connection.php");

  if(!$link) {
    die("Error: ".mysql_error());
  }
 
  if($_POST['submit']) {
    if ($_POST['tagname']=="") $error.="<br />Please enter a tag name!";
    if ($_POST['tagtype']=="") $error.="<br />Please enter a tag type!";
    if ($_POST['brokered']=="") $error.="<br />Please enter broker type!";
    if ($_POST['company']=="") $error.="<br />Please enter a company!";
    if ($_POST['identifier']=="") $error.="<br />Please enter an ID!";
    if ($_POST['rate']=="") $error.="<br />Please enter the CPM rate!";
    if ($_POST['datebrokered']=="") $error.="<br />Please enter the date brokered!";
    else {
      $query = "SELECT * FROM tags WHERE identifier='".mysqli_real_escape_string($link,$_POST['identifier'])."'";
      $result = mysqli_query($link, $query);
      $results = mysqli_num_rows($result);

      if ($results) $error = "This tag already exits within the system, please edit the tag instead.";
        else {
          $query="INSERT INTO tags (`tagname`, `tagtype`, `brokered`, `company`, `identifier`, `rate`, `datebrokered`)
          VALUES(
          '".mysqli_real_escape_string($link, $_POST['tagname'])."',
          '".mysqli_real_escape_string($link, $_POST['tagtype'])."',
          '".mysqli_real_escape_string($link, $_POST['brokered'])."',
          '".mysqli_real_escape_string($link, $_POST['company'])."',
          '".mysqli_real_escape_string($link, $_POST['identifier'])."',
          '".mysqli_real_escape_string($link, $_POST['rate'])."',
          '".mysqli_real_escape_string($link, $_POST['datebrokered'])."'
          )";

          mysqli_query($link, $query);
        }
      }
    }

    if($_POST['edit-tag']) {

      $query="UPDATE tags SET
      tagname='".mysqli_real_escape_string($link, $_POST['tagnameModal'])."',
      tagtype='".mysqli_real_escape_string($link, $_POST['tagtypeModal'])."',
      brokered='".mysqli_real_escape_string($link, $_POST['brokeredModal'])."',
      company='".mysqli_real_escape_string($link, $_POST['companyModal'])."',
      rate='".mysqli_real_escape_string($link, $_POST['rateModal'])."',
      datebrokered='".mysqli_real_escape_string($link, $_POST['datebrokeredModal'])."'
      WHERE uniqueid='".mysqli_real_escape_string($link, $_POST['uniqueid'])."'";
      // var_dump($query);
      // exit;
      mysqli_query($link, $query);
    }

    $query = "SELECT * FROM tags";
    $result = mysqli_query($link, $query);
?>
