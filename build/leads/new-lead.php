<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Lead</title>
    <link href= "style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php include_once "header-menu.php" ?>

    <div>
        <table align="center">
            <tr>
                <td colspan="2" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> Add New Lead</td>
            </tr>
            <tr>
               <td>Lead Type</td>
               <td>
                   <?php
                   include_once "db.php";
                   $conn =  getConnection();
                   $stmt = $conn->query('SELECT * FROM leadtype');
                   $rows = $stmt->fetchAll();
                    ?>
                     <select id="leadtype">
                       <?php
                        foreach($rows as $row) {
                        ?>
                           <option value="<?php echo $row['LEADTYPEID'] ?>"><?php echo $row['LEADNAME'] ?></option>
                           <?php } ?>
                       </select>
                 </td>
           </tr>
           <tr>
               <td>Lead For</td>
                <td>
                   <?php
                   include_once "db.php";
                   $conn =  getConnection();
                   $stmt = $conn->query('SELECT * FROM candidates WHERE CANDIDATETYPE != "GROUP"');
                   $rows = $stmt->fetchAll();
                    ?>
                     <select id="candidate" onChange="check_candidate();";>
                        <option value="-2">Select Your Candidate</option>
                       <?php
                        foreach($rows as $row) {
                        ?>
                           <option value="<?php echo $row['CANDIDATEID'] ?>"><?php echo $row['CANDIDATENAME'] ?></option>
                           <?php } ?>
                           <option value="-1" >Add New Candidate</option>
                       </select>

                       <div id="new-candidate-block" style="display:none;">
                            <div>
                                <input type="text" id="new-candidate-name" placeholder="Enter Your Candidate Name">
                            </div>
                             <div>
                                <input type="radio" name="candidate-type" value="referred" onclick="document.getElementById('referral-block').style.display='block';" />Referred
                                <input type="radio" name="candidate-type" value="direct" onclick="document.getElementById('referral-block').style.display='none';" />Direct
                            </div>
                            <div id="referral-block" style="display:none;">
                                <?php
                                   include_once "db.php";
                                   $conn =  getConnection();
                                   $stmt = $conn->query('SELECT * FROM candidates WHERE CANDIDATETYPE="GROUP"');
                                   $rows = $stmt->fetchAll();
                                  ?>
                                <select id="referral">
                                    <option value="-1">Select Your Referral</option>
                                    <?php
                                    foreach($rows as $row) {
                                    ?>
                                       <option value="<?php echo $row['CANDIDATEID'] ?>"><?php echo $row['CANDIDATENAME'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div>
                                <input type="text" id="contact-details" placeholder="Contact Number">
                            </div>
                            <div>
                                <input type="text" id="contact-email" placeholder="Contact Email">
                            </div>
                            <div>
                                <input type="text" id="contact-timezone" placeholder="Contact Timezone">
                            </div>

                            <div>
                                <button onclick="addNewCandidate();">Add New Candidate</button>
                            </div>
                       </div>

                </td>

           </tr>
           <tr>
               <td>Date and Time (IST)</td>
               <td><input type="datetime-local" id="leadtime" placeholder=""></td>
           </tr>

           <tr>
               <td>Duration (in min)</td>
               <td><input type="number" id="leadduration" placeholder="1,30"></td>
           </tr>

           <tr>
               <td>Amount</td>
               <td><input type="number" id="amount_to_pay" placeholder="10000"></td>
           </tr>

           <tr>
              <td>Comments</td>
              <td><textarea id="lead-comments" placeholder="Comments" style="width:300px;height:200px;"></textarea></td>
          </tr>

          <tr>
              <td colspan="2" style="text-align:center;">
                    <button onclick="addNewLead();">Add New Lead</button>
               </td>
          </tr>

        </table>

    </div>

    <script>

            function addNewLead(){
               var leadtype = document.getElementById('leadtype').value;
               var candidate = document.getElementById('candidate').value;
               var leadtime = document.getElementById('leadtime').value;
               var duration = document.getElementById('leadduration').value;
               var amount = document.getElementById('amount_to_pay').value;
               var comments = encodeURIComponent(document.getElementById('lead-comments').value);

                params = "src=new-lead&param1="+leadtype+"&param2="+candidate+"&param3="+leadtime+"&param4="+duration+"&param5="+amount+"&param6="+comments;
                var http = new XMLHttpRequest();
                http.onreadystatechange = function() {
                    if(http.readyState == 4 && http.status == 200) {
                        var x = http.responseText;
                        alert(x);
                        location.reload();
                    }
                }

                http.open('POST', "controller.php", true);
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                http.send(params);

            }

            function addNewCandidate(){
            var candidate_name = document.getElementById('new-candidate-name').value;
            var candidate_type = "referral";
            var c_types = document.getElementsByName('candidate-type');
            for(var i = 0 ; i < c_types.length ; i++){
                if(c_types[i].checked){
                   candidate_type = c_types[i].value;
                }
            }

            var referral = document.getElementById('referral').value;
            var contact = document.getElementById('contact-details').value;
            var email = document.getElementById('contact-email').value;
            var timezone = document.getElementById('contact-timezone').value;


            params = "src=new-candidate&param1="+candidate_name+"&param2="+candidate_type+"&param3="+referral+"&param4="+contact+"&param5="+email+"&param6="+timezone;
            var http = new XMLHttpRequest();
            http.onreadystatechange = function() {
                if(http.readyState == 4 && http.status == 200) {
                    var x = http.responseText;
                    alert(x);
                    location.reload();
                }
            }

            http.open('POST', "controller.php", true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.send(params);
            }

            function check_candidate(){
                if(document.getElementById('candidate').value == '-1'){
                    document.getElementById('new-candidate-block').style.display='block';
                }else{
                    document.getElementById('new-candidate-block').style.display='none';
                }
            }


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