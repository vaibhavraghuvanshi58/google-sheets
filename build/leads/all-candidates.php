<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Cricket Database</title>
    <link href= "style.css" rel="stylesheet" type="text/css">

</head>
<body>
    <?php include_once "header-menu.php" ?>

    <div>
        </table>
         <table align="center" id="player_run">
                    <tr>
                        <td colspan="6" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> All Candidates </td>
                    </tr>

                    <tr class="tableheader">
                        <th>Name</th>
                        <th>Contact Details</th>
                        <th>Referral</th>
                        <th>Comments</th>
                    </tr>
                    <?php
                       include_once "db.php";
                       $count = 0;
                       $rows = "";
                       try{
                       $conn =  getConnection();
                       $stmt = $conn->query('SELECT * FROM candidates');
                       $rows = $stmt->fetchAll();
                        foreach($rows as $row) {
                         ?>
                          <tr>
                             <td><a  target="_blank" href="candidate-history.php?id=<?php echo $row['CANDIDATEID'] ?>"><?php echo $row['CANDIDATENAME'] ?></td>
                             <td>
                                <?php echo $row['CANDIDATECONTACTNUMBER'] ?>
                                &nbsp;&nbsp;&nbsp;(<?php echo $row['CANDIDIDATEEMAILID'] ?>)
                             </td>
                              <td>
                                <?php echo $row['REFERREDBY'] ?> [<?php echo $row['CANDIDATETIMEZONE'] ?>]
                               </td>
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