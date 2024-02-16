<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Cricket Database</title>
    <link href= "style.css" rel="stylesheet" type="text/css">
    <style>
    .tableheader td{
        font-weight:800;
        background-color:#080d44;
        color:white;
        text-indent:10px;
        text-transform:uppercase;
    }
    </style>
</head>
<body>
    <?php include_once "header-menu.php";
    include_once "db.php";
     $playerId = $_GET['playerid'];
     $conn =  getConnection();
     $stmt = $conn->query('SELECT * FROM PLAYERS WHERE PLAYERID = '.$playerId);
     $data = $stmt->fetchAll();
    ?>

    <div>
        <table align="center">
            <tr>
                <td colspan="6" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> View Run [<?php echo $data[0]['PLAYERNAME'] ?>] </td>
            </tr>

            <tr class="tableheader">
                <td>Date</td>
                <td>Against Country</td>
                <td>Run</td>
                <td>Four/Sixes</td>
                <td>Balls</td>
                <td>Actions</td>
            </tr>
            <?php

               $conn =  getConnection();
               $stmt = $conn->query('SELECT * FROM RUNS WHERE PLAYERID='.$playerId);
               $rows = $stmt->fetchAll();
                foreach($rows as $row) {
                 ?>
                  <tr>
                     <td><?php echo $row['RUNDATE'] ?></td>
                     <td><?php echo $row['AGAINSTCOUNTRY'] ?></td>
                     <td><?php echo $row['TOTALRUN'] ?></td>
                     <td><?php echo $row['FOURS'] ?> Four(s)/ <?php echo $row['SIX'] ?> Six(s)</td>
                     <td><?php echo $row['BALLS'] ?></td>
                     <td><button onclick="removeRun(<?php echo $row['RUNID'] ?>);">Delete</button></td>
                 </tr>

               <?php }
            ?>
        </table>
    </div>
<?php include_once "footer.php" ?>
    <script>
           function removeRun(id){
               if( confirm("Are you sure! you want to delete this Runs ?")){
                window.location.href="delete-run.php?id="+id+"&pid=<?php echo $playerId ?>";
               }
           }
    </script>
</body>
</html>