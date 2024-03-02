<?php

    $src =  $_POST["src"];
    date_default_timezone_set('Asia/Kolkata');
    if($src == "new-lead-type"){
        $typeName =  $_POST["param1"];
        include_once "db.php";
        $conn = getConnection();
        $sql = "INSERT INTO `leadtype` (`LEADTYPEID`, `LEADNAME`, `LEADCREATIONDATE`) VALUES (NULL, ?, CURRENT_TIMESTAMP());";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$typeName]);
        echo "added successfully";
     }

     if($src == "new-group"){
             $candidateName =  $_POST["param1"];
             $candidateContact =  $_POST["param2"];
             $comments =  $_POST["param3"];
             include_once "db.php";
             $conn = getConnection();
             $sql = "INSERT INTO `candidates` (`CANDIDATEID`, `CANDIDATETYPE`, `CANDIDATENAME`, `CANDIDATECONTACTNUMBER`,
              `CANDIDIDATEEMAILID`, `CANDIDATETIMEZONE`, `REFERREDBY`, `COMMENTS`, `CANDIDATETIME`)
             VALUES (NULL, 'GROUP', ?, ?, '', '', '-1', ?, CURRENT_TIMESTAMP());";
             $stmt= $conn->prepare($sql);
             $stmt->execute([$candidateName,$candidateContact,$comments]);
             echo "added successfully";
          }

        if($src == "new-candidate"){
             $candidate_name = $_POST['param1'];
             $candidate_type = $_POST['param2'];
             $referral = $_POST['param3'];
             $contact = $_POST['param4'];
             $email = $_POST['param5'];
             $timezone = $_POST['param6'];

             include_once "db.php";
             $conn = getConnection();
             $sql = "INSERT INTO `candidates` (`CANDIDATEID`, `CANDIDATETYPE`, `CANDIDATENAME`, `CANDIDATECONTACTNUMBER`,
              `CANDIDIDATEEMAILID`, `CANDIDATETIMEZONE`, `REFERREDBY`, `COMMENTS`, `CANDIDATETIME`)
             VALUES (NULL, ?, ?, ?, ?, ?, ?, '', CURRENT_TIMESTAMP());";
             $stmt= $conn->prepare($sql);
             $stmt->execute([$candidate_type,$candidate_name,$contact,$email,$timezone,$referral]);
             echo "added successfully";
          }


        if($src == "new-lead"){
            $leadtype = $_POST['param1'];
             $candidate = $_POST['param2'];
             $leadtime = $_POST['param3'];
             $duration = $_POST['param4'];
             $amount = $_POST['param5'];
             $comments = $_POST['param6'];

             include_once "db.php";
             $conn = getConnection();
             $sql = "INSERT INTO `leads` (`LEADID`, `LEADTYPEID`, `LEADPERSONID`, `LEADEXECUTIONDATETIME`, `LEADEXECUTIONDURATION`, `LEADAMOUNT`, `AMOUNTSTATUS`, `COMMENTS`, `LEADADDDAETE`)
              VALUES (NULL, ?, ?, ?, ?, ?, 'SCHEDULED', ?, CURRENT_TIMESTAMP());";

             $stmt= $conn->prepare($sql);
             $stmt->execute([$leadtype,$candidate,$leadtime,$duration,$amount,$comments]);
             echo "added successfully";
          }

        if($src == "edit-lead"){
            $leadtype = $_POST['param1'];
             $candidate = $_POST['param2'];
             $leadtime = $_POST['param3'];
             $duration = $_POST['param4'];
             $amount = $_POST['param5'];
             $comments = $_POST['param6'];
              $status = $_POST['param7'];
              $leadid = $_POST['param8'];

             include_once "db.php";
             $conn = getConnection();
             $sql = "UPDATE `leads` SET `LEADTYPEID`=?, `LEADPERSONID`=?, `LEADEXECUTIONDATETIME`=?, `LEADEXECUTIONDURATION`=?, `LEADAMOUNT`=?, `AMOUNTSTATUS`=?, `COMMENTS`=? WHERE LEADID=?";

             $stmt= $conn->prepare($sql);
             $stmt->execute([$leadtype,$candidate,$leadtime,$duration,$amount,$status,$comments,$leadid]);
             echo "edited successfully";
          }

 ?>