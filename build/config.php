<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Cricket Database</title>
    <link href= "style.css" rel="stylesheet" type="text/css">
    <style>
    .heading{
        font-size:25px;
        font-weight:800;
        text-transform:uppercase;
        width:300px;
        color:#4bb1e2;
    }
    .headingvalue{
        font-size:25px;
        letter-spacing:1px;
        color:red;
    }
    table#player_run tr:nth-of-type(even) {background: #cdd0db;}
    table#player_run tr:nth-of-type(odd) {background: #e4e8e4;}
    table#player_run td{
    text-align:center;
    }
    </style>
</head>
<body>
    <?php include_once "header-menu.php";

      include_once "db.php";
      $conn = getConnection();

     $sqlArray = array();

      array_push($sqlArray,"CREATE TABLE `PLAYERS` (
                                `PLAYERID` int NOT NULL,
                                `PLAYERNAME` varchar(100) NOT NULL,
                                `PLAYERCOUNTRY` varchar(100) NOT NULL,
                                `PLAYERGENDER` varchar(10) NOT NULL,
                                `PLAYERJOININGYEAR` int NOT NULL
                              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

     array_push($sqlArray,"ALTER TABLE `PLAYERS`
                             ADD PRIMARY KEY (`PLAYERID`),
                             ADD UNIQUE KEY `PLAYERNAME` (`PLAYERNAME`,`PLAYERCOUNTRY`);");

     array_push($sqlArray,"ALTER TABLE `PLAYERS`
                             MODIFY `PLAYERID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;");


     array_push($sqlArray,"CREATE TABLE `RUNS` (
               `RUNID` int NOT NULL,
               `PLAYERID` int NOT NULL,
               `AGAINSTCOUNTRY` varchar(100) NOT NULL,
               `TOTALRUN` int NOT NULL,
               `FOURS` int NOT NULL,
               `SIX` int NOT NULL,
               `BALLS` int NOT NULL,
               `RUNDATE` date NOT NULL
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

       array_push($sqlArray,"ALTER TABLE `RUNS`
                               ADD PRIMARY KEY (`RUNID`),
                               ADD UNIQUE KEY `PLAYERID` (`PLAYERID`,`RUNDATE`);");

       array_push($sqlArray,"ALTER TABLE `RUNS` MODIFY `RUNID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;");

     ?>

    <div>
        <div style="font-size:25px;color:blue;margin-left:100px;margin-top:40px;text-transform:uppercase;">
            <?php
                 foreach($sqlArray as $sql){
                   $stmt= $conn->prepare($sql);
                   try{
                      $stmt->execute();  ?>
                     <div><b>Query Executed Successfully</b></div>
                   <?php  }catch(Exception $e){ ?>
                    <div><b>Already Configured.</b></div>
                   <?php }
                 }
             ?>
        </div>
    </div>

    <div>
        <div style="font-size:14px;color:red;margin-left:100px;margin-top:40px;width:600px;"><b>Disclaimer: This application has been developed exclusively for the purpose of automation testing.
        It is not intended for any commercial or monetary use with any of your resources.
        </b></div>
    </div>

<?php include_once "footer.php" ?>
</body>
</html>