<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Leads Database</title>
    <link href= "style.css" rel="stylesheet" type="text/css">
    <style>

    </style>
</head>
<body>
            <?php include_once "header-menu.php" ?>


    <div style="margin-top:10px;margin-bottom:40px;">
            <span style="font-size:25px;padding:0px 50px;font-weight:800;">Convert to</span>
            <?php
                $timezone = "IST";
                if(isset($_GET['timezone'])){
                    $timezone = $_GET['timezone'];
                }
             ?>
            <select onchange="settimezone();" id="timezone">
                <option  value="IST" <?php if($timezone == 'IST'){echo "selected"; } ?>>IST</option>
                <option  value="CST" <?php if($timezone == 'CST'){echo "selected"; } ?>>CST</option>
                <option  value="EST" <?php if($timezone == 'EST'){echo "selected"; } ?>>EST</option>
                <option  value="PST" <?php if($timezone == 'PST'){echo "selected"; } ?>>PST</option>
            </select>
    </div>
    <div>
        <div style="display:flex;">
            <div style="width:50%;" id="timeline-div">

                     <?php
                                  include_once "db.php";
                                  $count = 0;
                                  $rows = "";
                                  try{
                                  $conn =  getConnection();
                                  $stmt = $conn->query('SELECT leads.LEADID,candidates.CANDIDATEID ,candidates.CANDIDATENAME, candidates.CANDIDATECONTACTNUMBER, candidates.CANDIDATETYPE, leadtype.LEADNAME,
                                                                      leads.LEADEXECUTIONDATETIME,leads.LEADEXECUTIONDURATION, leads.AMOUNTSTATUS FROM `leads`, candidates, leadtype
                                                                      where leadtype.LEADTYPEID = leads.LEADTYPEID and leads.LEADPERSONID = candidates.CANDIDATEID and AMOUNTSTATUS not in ("COMPLETED","CANCELLED") order by LEADEXECUTIONDATETIME asc;');
                                  $rows = $stmt->fetchAll();
                                  $earlierDate = "";
                                  foreach($rows as $row) {
                                      date_default_timezone_set('Asia/Kolkata');
                                      $datetime = new DateTime($row['LEADEXECUTIONDATETIME']);
                                      //echo $datetime->format('d-M h:i A e');
                                      $la_time = new DateTimeZone('Asia/Kolkata');
                                      if($timezone == "CST"){
                                          $la_time = new DateTimeZone('America/Chicago');
                                      }
                                      if($timezone == "EST"){
                                          $la_time = new DateTimeZone('America/New_York');
                                      }
                                      if($timezone == "PST"){
                                          $la_time = new DateTimeZone('America/Los_Angeles');
                                      }
                                      $datetime->setTimezone($la_time);
                                      $executionDate =  $datetime->format('d-M h:i A');
                                      $thisdate =  $datetime->format('d-M-y ( D )');

                                  ?>
                                   <?php  if($earlierDate != $thisdate){ ?>
                                        <?php if($earlierDate != ""){ ?>
                                            </div>
                                        <?php } ?>
                                       <div style="font-size:20px;margin-left:50px;font-weight:800;"> <?php echo $thisdate ?> </div>
                                       <div style="display:flex;">
                                   <?php
                                        $earlierDate = $thisdate;
                                    }else{ ?>

                                    <?php } ?>

                                       <div style="margin-left:50px;margin-top:10px;margin-bottom:10px;width: 40%;background-color: #eae6e6;padding: 10px;">
                                       <div>
                                               <span style="font-size:30px;color:#fa7171;font-weight:800;"><a target="_blank" href="candidate-history.php?id=<?php echo $row['CANDIDATEID']; ?>"><?php echo $row['CANDIDATENAME']; ?></a></span>
                                               <span style="font-size:15px;color:blue;letter-spacing:1px;">[<?php echo $row['CANDIDATETYPE'] ?>]</span>
                                               <span style="font-weight:800;color:black;"><?php echo $row['LEADNAME'] ?></span>
                                       </div>

                                       <div>
                                              <span style="font-size:20px;color:#6c5ded;font-weight:800;">
                                              <?php echo $executionDate; ?>

                                              ( +  <?php echo $row['LEADEXECUTIONDURATION'] ?> min )</span>
                                      </div>

                                        <div>
                                              <span style="font-size:20px;color:#6c5ded;font-weight:800;">
                                              <a  href="wa.me?" target="_blank"><?php echo $row['CANDIDATECONTACTNUMBER'] ?></a>
                                              </span>
                                              <span style="padding: 3px 10px;background-color: #70e598;border-radius: 5px;font-size: 15px;"><?php echo $row['AMOUNTSTATUS'] ?></span>
                                              <span><button style="font-size:15px;height:20px;border:0px;background:none;color:blue;padding:0px 10px;" onclick="editLead(<?php echo $row['LEADID'] ?>)"><u>Update</u></button></span>
                                      </div>


                                    </div>

                                  <?php }
                                   }catch(Exception $e){

                                   }
                            ?>

            </div>
            </div>
            <div style="width:50%" id="supporting-frame-div">
                <iframe id="edit-lead" style="width:100%;height:750px;border:0px;"></iframe>
            </div>
        </div>
     </div>

    <script>
        function editLead(id){
            document.getElementById('edit-lead').src = "edit-lead.php?id="+id;
        }

        function settimezone(){
            var timezone = document.getElementById('timezone').value;
            window.location.href="index.php?timezone="+timezone;
        }
    </script>

</body>
</html>