<html>
<head>
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
<div style="margin-left:100px;">
        <table align="left" id="player_run">
            <tr>
                <td colspan="6" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> All Players Runs </td>
            </tr>

            <tr class="tableheader">
                <th>Player Name</th>
                <th>Player Country</th>
                <th>Total Run</th>
            </tr>
            <?php
               include_once "db.php";
               $count = 0;
               $rows = "";
               try{
               $conn =  getConnection();
               $stmt = $conn->query('SELECT PLAYERS.PLAYERID,PLAYERS.PLAYERNAME,PLAYERS.PLAYERCOUNTRY,SUM(RUNS.TOTALRUN) as TOTALRUN FROM `RUNS`, PLAYERS WHERE RUNS.PLAYERID=PLAYERS.PLAYERID  group by RUNS.PLAYERID ;');
               $rows = $stmt->fetchAll();
                foreach($rows as $row) {
                 ?>
                  <tr>
                     <td><a href="view-runs.php?playerid=<?php echo $row['PLAYERID'] ?>" target="_blank"><?php echo $row['PLAYERNAME'] ?></a></td>
                     <td><?php echo $row['PLAYERCOUNTRY'] ?></td>
                     <td><?php echo $row['TOTALRUN'] ?></td>
                  </tr>
               <?php }
                }catch(Exception $e){

                }
            ?>
        </table>
    </div>

   </body>