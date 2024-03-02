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
    <?php include_once "header-menu.php" ?>

    <div>
        <div style="font-size:25px;color:blue;margin-left:100px;margin-top:40px;text-transform:uppercase;"><b>Current Statistics</b></div>

        <div style="margin-left:50px;">
                <table>
                    <tr>
                        <td class="heading">Maximum Run</td>
                        <?php
                             include_once "db.php";
                             $conn =  getConnection();
                             $count = 0;
                             $rows = "";
                             try{
                             $stmt = $conn->query('SELECT PLAYERS.PLAYERNAME,PLAYERS.PLAYERCOUNTRY,SUM(RUNS.TOTALRUN) as TOTALRUN FROM `RUNS`, PLAYERS WHERE RUNS.PLAYERID=PLAYERS.PLAYERID  group by RUNS.PLAYERID order by TOTALRUN DESC limit 1;');
                                 $count = $stmt->rowCount();
                                 $rows = $stmt->fetchAll();
                             }catch(Exception $e){

                             }
                            if($count == 0){
                        ?>
                        <td class="headingvalue">No Data Added</td>
                        <?php }else{ ?>
                        <td class="headingvalue"><?php echo $rows[0]['PLAYERNAME'] ?> - <?php echo $rows[0]['PLAYERCOUNTRY'] ?> [<?php echo $rows[0]['TOTALRUN'] ?>]</td>
                        <?php }  ?>
                    </tr>

                    <tr>
                        <td class="heading">Maximum Fours</td>
                        <?php
                             include_once "db.php";
                             $conn =  getConnection();
                             $rows = "";
                             $count = 0;
                             try{
                             $stmt = $conn->query('SELECT PLAYERS.PLAYERNAME,PLAYERS.PLAYERCOUNTRY,SUM(RUNS.FOURS) as TOTALRUN FROM `RUNS`, PLAYERS WHERE RUNS.PLAYERID=PLAYERS.PLAYERID  group by RUNS.PLAYERID order by TOTALRUN DESC limit 1;');
                             $count = $stmt->rowCount();
                             $rows = $stmt->fetchAll();
                             }catch(Exception $e){
                             }
                            if($count == 0){
                        ?>
                        <td class="headingvalue">No Data Added</td>
                        <?php }else{ ?>
                        <td class="headingvalue"><?php echo $rows[0]['PLAYERNAME'] ?> - <?php echo $rows[0]['PLAYERCOUNTRY'] ?> [<?php echo $rows[0]['TOTALRUN'] ?>]</td>
                        <?php }  ?>
                    </tr>

                       <tr>
                        <td class="heading">Maximum Six</td>
                        <?php
                             include_once "db.php";
                             $conn =  getConnection();
                             $count= 0;
                             $row = "";
                             try{
                                $stmt = $conn->query('SELECT PLAYERS.PLAYERNAME,PLAYERS.PLAYERCOUNTRY,SUM(RUNS.SIX) as TOTALRUN FROM `RUNS`, PLAYERS WHERE RUNS.PLAYERID=PLAYERS.PLAYERID  group by RUNS.PLAYERID order by TOTALRUN DESC limit 1;');
                                $count = $stmt->rowCount();
                                 $rows = $stmt->fetchAll();
                             }catch(Exception $e){
                             }
                            if($count == 0){
                        ?>
                        <td class="headingvalue">No Data Added</td>
                        <?php }else{ ?>
                        <td class="headingvalue"><?php echo $rows[0]['PLAYERNAME'] ?> - <?php echo $rows[0]['PLAYERCOUNTRY'] ?> [<?php echo $rows[0]['TOTALRUN'] ?>]</td>
                        <?php }  ?>
                    </tr>
                </table>
        </div>
    </div>
    <iframe src="allplayer-run.php" style="width:100%;height:400px;border:0px;" scrolling></iframe>
  </div>
<?php include_once "footer.php" ?>
</body>
</html>