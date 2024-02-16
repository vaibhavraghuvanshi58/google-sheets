<?php

    $id =  $_GET["id"];
     $pid =  $_GET["pid"];
     include_once "db.php";
     $conn = getConnection();
     $sql = "DELETE FROM `RUNS` WHERE RUNID=?";
     $stmt= $conn->prepare($sql);
     $stmt->execute([$id]);
     header("Location: view-runs.php?playerid=$pid");
 ?>