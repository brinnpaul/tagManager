<?php
  $link = mysqli_connect("ip", "name", "pass", "name");

  $user_email = "jclark@centerpointmedia.com";

  $user_query = "SELECT id FROM users WHERE email = '".$user_email."'";
  $user_ids = mysqli_query($link, $user_query);
  $user_id = mysqli_fetch_array($user_ids);
  $user_id = $user_id['id'];

  print_r($user_id);

  $query = "SELECT * FROM jpctags WHERE active = 1 AND user_id='".$user_id."'";
  $result = mysqli_query($link, $query);
?>
