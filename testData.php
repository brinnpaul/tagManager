<?php

  $conn = new mysqli("ip", "name", "pass", "name");

  $query = "SELECT * FROM jpctags WHERE active = 1";
  $result = mysqli_query($conn, $query);
  // $row = mysqli_fetch_array($result);

  while($row = mysqli_fetch_array($result)) {
    $str = chunk_split($row['url'], 50, "</br>");
    echo $str;
  }


?>
