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
    <?php include_once "header-menu.php" ?>

    <div>
        <table align="center">
            <tr>
                <td colspan="6" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> View All Players </td>
            </tr>

            <tr class="tableheader">
                <td>Player ID</td>
                <td>Player Name</td>
                <td>Player Country</td>
                <td>Player Gender</td>
                <td>Player Year</td>
                <td>Actions</td>
            </tr>
            <?php
               include_once "db.php";
               $conn =  getConnection();
               $stmt = $conn->query('SELECT * FROM PLAYERS');
               $rows = $stmt->fetchAll();
                foreach($rows as $row) {
                 ?>
                  <tr>
                     <td><?php echo $row['PLAYERID'] ?></td>
                     <td><a href="view-runs.php?playerid=<?php echo $row['PLAYERID'] ?>"><?php echo $row['PLAYERNAME'] ?></a></td>
                     <td><?php echo $row['PLAYERCOUNTRY'] ?></td>
                     <td><?php echo $row['PLAYERGENDER'] ?></td>
                     <td><?php echo $row['PLAYERJOININGYEAR'] ?></td>
                     <td><button onclick="removePlayer(<?php echo $row['PLAYERID'] ?>);">Delete</button></td>
                 </tr>

               <?php }
            ?>
        </table>
    </div>
<?php include_once "footer.php" ?>
    <script>
           function removePlayer(id){
               if( confirm("Are you sure! you want to delete this player ?")){
                window.location.href="delete-player.php?id="+id;
               }
           }
    </script>
</body>
</html>