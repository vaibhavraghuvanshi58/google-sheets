<?php

    $id =  $_GET["leadtypeid"];

     include_once "db.php";
     $conn = getConnection();
     $sql = "DELETE FROM `leadtype` WHERE LEADTYPEID=?";
     $stmt= $conn->prepare($sql);
     $stmt->execute([$id]);
     header("Location: new-leadtype.php");
 ?>