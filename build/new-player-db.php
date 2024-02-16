<?php

    $playerName =  $_POST["param1"];
    $playerCountry =  $_POST["param2"];
    $playerYear =  $_POST["param3"];
    $playerGender =  $_POST["param4"];

     include_once "db.php";
     $conn = getConnection();
     $sql = "INSERT INTO `PLAYERS` (`PLAYERID`, `PLAYERNAME`, `PLAYERCOUNTRY`, `PLAYERGENDER`, `PLAYERJOININGYEAR`) VALUES (NULL, ?, ?, ?, ?)";
     $stmt= $conn->prepare($sql);
     $stmt->execute([$playerName, $playerCountry, $playerGender,$playerYear]);
     echo "$playerName  Added  Successfully";


 ?>