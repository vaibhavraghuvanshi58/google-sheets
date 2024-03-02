<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Cricket Database</title>
    <link href= "style.css" rel="stylesheet" type="text/css">
       <?php
            $candidateId = $_GET['id'];

        ?>
</head>
<body>
    <?php include_once "header-menu.php" ?>

    <div>
        </table>
         <table align="center" id="player_run">
                    <tr>
                        <td colspan="6" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> All Lead Type </td>
                    </tr>

                    <tr class="tableheader">
                        <th>Lead Name</th>
                        <th>Time-Duration</th>
                        <th>Status</th>
                        <th>Comments</th>
                    </tr>
                    <?php
                       include_once "db.php";
                       $count = 0;
                       $rows = "";
                       try{
                       $conn =  getConnection();
                       $stmt = $conn->query('SELECT leads.LEADID,leadtype.LEADNAME, leads.LEADEXECUTIONDATETIME, leads.LEADEXECUTIONDURATION, leads.LEADAMOUNT, leads.AMOUNTSTATUS, leads.COMMENTS FROM `leads`, leadtype  where leads.LEADTYPEID = leadtype.LEADTYPEID and LEADPERSONID = '.$candidateId.' order  by leads.LEADEXECUTIONDATETIME desc');
                       $rows = $stmt->fetchAll();
                        foreach($rows as $row) {
                         ?>
                          <tr>
                             <td><a href="edit-lead.php?id=<?php echo $row['LEADID'] ?>"><?php echo $row['LEADNAME'] ?></a></td>
                             <td>
                                <?php echo $row['LEADEXECUTIONDATETIME'] ?>
                                &nbsp;&nbsp;&nbsp;[ + <?php echo $row['LEADEXECUTIONDURATION'] ?> min(s) ]
                             </td>
                              <td><?php echo $row['LEADAMOUNT'] ?> [<?php echo $row['AMOUNTSTATUS'] ?>]</td>
                              <td><?php echo $row['COMMENTS'] ?></td>
                          </tr>
                       <?php }
                        }catch(Exception $e){

                        }
                    ?>
                </table>
    </div>

</body>
</html>