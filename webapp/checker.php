<?php 
  if (isset($_GET['goji']) && $_GET['goji']=="geje") {  

    if (isset($_GET['do'])) {
      
      $target = $_GET['do'];
      echo "ok";
      exec("nohup bash checker.sh '$target' &");

    } else {
      echo ":)";
    }

  } else {
    echo ":)";
  }
?>