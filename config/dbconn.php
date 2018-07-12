<?php
 
    $host='localhost';
    $username='root';
    $password="";
    $dbname='laboratorium2';
    try{
        $db=new mysqli($host, $username, $password, $dbname);
    } catch (Exception $e){
        echo $e->connect_error;
        exit('Error connecting to database');
    }
?>