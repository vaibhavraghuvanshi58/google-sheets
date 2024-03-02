<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Cricket Database</title>
    <link href= "style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div>
        <table align="center">
            <tr>
                <td colspan="2" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> Add new Lead Type</td>
            </tr>
            <tr>
                <td>Lead Type Name</td>
                <td><input type="text" id="leadTypeName" placeholder="Enter Your Lead Type Name"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;">
                    <button onclick="addLeadType();">Add Lead Type</button>
                 </td>
            </tr>
        </table>

         <table align="center" id="player_run">
                    <tr>
                        <td colspan="6" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> All Lead Type </td>
                    </tr>

                    <tr class="tableheader">
                        <th>LeadType Name</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                       include_once "db.php";
                       $count = 0;
                       $rows = "";
                       try{
                       $conn =  getConnection();
                       $stmt = $conn->query('SELECT * FROM `leadtype`');
                       $rows = $stmt->fetchAll();
                        foreach($rows as $row) {
                         ?>
                          <tr>
                             <td> <?php echo $row['LEADNAME'] ?> </td>
                             <td><a href="deleteleadtype.php?leadtypeid=<?php echo $row['LEADTYPEID'] ?>">Delete</a></td>
                          </tr>
                       <?php }
                        }catch(Exception $e){

                        }
                    ?>
                </table>
    </div>

    <script>
           function addLeadType(){
            var leadTypeName = document.getElementById('leadTypeName').value;
            params = "src=new-lead-type&param1="+leadTypeName;
            var http = new XMLHttpRequest();
            http.onreadystatechange = function() {
                if(http.readyState == 4 && http.status == 200) {
                    var x = http.responseText;
                    location.reload();
                }
            }

            http.open('POST', "controller.php", true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.send(params);

           }
    </script>
</body>
</html>