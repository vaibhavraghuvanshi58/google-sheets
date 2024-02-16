<?php

    $playerName =  $_POST["p1"];
    $playerCountry =  $_POST["p2"];
    $playerRun =  $_POST["p3"];
    $playerBalls =  $_POST["p4"];
    $playerFours =  $_POST["p5"];
    $playerSixes =  $_POST["p6"];
    $innDate =  $_POST["p7"];

     include_once "db.php";
     $conn = getConnection();
     $sql = "INSERT INTO `RUNS` (`RUNID`, `PLAYERID`, `AGAINSTCOUNTRY`, `TOTALRUN`, `FOURS`, `SIX`, `BALLS`, `RUNDATE`)
     VALUES (NULL, ? , ?, ?, ?, ?, ?, ?);";
     $stmt= $conn->prepare($sql);
      try {
        $stmt->execute([$playerName, $playerCountry,$playerRun ,$playerFours,$playerSixes,$playerBalls,$innDate]);
        echo "Runs  Added  Successfully";
       } catch (PDOException $e) {
          echo "Issue in Data. Duplicate Entry";
       }



 ?>