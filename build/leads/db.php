<?php
function getConnection(){
    $dsn = "mysql:host=db;dbname=cricdb;charset=UTF8";
    try {
        $pdo = new PDO($dsn, 'USER', 'PASS');
         return $pdo;
    } catch (PDOException $e) {
         echo "Failure. Not Added Successfully";
         return null;
    }
 }

?>