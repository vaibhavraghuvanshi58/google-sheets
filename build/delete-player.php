<?php

    $id =  $_GET["id"];

     include_once "db.php";
     $conn = getConnection();
     $sql = "DELETE FROM `PLAYERS` WHERE PLAYERID=?";
     $stmt= $conn->prepare($sql);
     $stmt->execute([$id]);
     header("Location: all-player.php");
 ?>