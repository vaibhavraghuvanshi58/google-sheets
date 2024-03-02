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
        <table align="center">
            <tr>
                <td colspan="2" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;">Add Group Name</td>
            </tr>
            <tr>
                <td>Group Support Person</td>
                <td><input type="text" id="leadsupportperson" placeholder="Support Person Name"></td>
            </tr>
            <tr>
                <td>Group Contact Number</td>
                <td><input type="text" id="leadcontactnumber" placeholder="Contact details"></td>
            </tr>
            <tr>
                <td>Group Comments</td>
                <td>
                    <textarea id="leadcomments" placeholder="Comments" style="width:300px;height:200px;"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;">
                    <button onclick="addGroup();">Add Lead Type</button>
                 </td>
            </tr>
        </table>

         <table align="center" id="player_run">
                    <tr>
                        <td colspan="6" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> All Lead Type </td>
                    </tr>

                    <tr class="tableheader">
                        <th>Group Name</th>
                        <th>Group Contact Person</th>
                        <th>Contract</th>
                    </tr>
                    <?php
                       include_once "db.php";
                       $count = 0;
                       $rows = "";
                       try{
                       $conn =  getConnection();
                       $stmt = $conn->query('SELECT * FROM `candidates` WHERE CANDIDATETYPE="GROUP"');
                       $rows = $stmt->fetchAll();
                        foreach($rows as $row) {
                         ?>
                          <tr>
                             <td> <?php echo $row['CANDIDATENAME'] ?> </td>
                             <td> <?php echo $row['CANDIDATECONTACTNUMBER'] ?> </td>
                             <td> <?php echo $row['COMMENTS'] ?> </td>
                          </tr>
                       <?php }
                        }catch(Exception $e){

                        }
                    ?>
                </table>
    </div>

    <script>
           function addGroup(){
            var leadPerson = encodeURIComponent(document.getElementById('leadsupportperson').value);
            var leadContact = encodeURIComponent(document.getElementById('leadcontactnumber').value);
            var leadComments = encodeURIComponent(document.getElementById('leadcomments').value);


            params = "src=new-group&param1="+leadPerson+"&param2="+leadContact+"&param3="+leadComments;
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