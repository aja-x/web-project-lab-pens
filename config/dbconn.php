<?php
    $config=parse_ini_file('db.ini');
    $host=$config['host'];
    $username=$config['username'];
    $password=$config['password'];
    $dbname=$config['dbname'];
    try{
        $db=new mysqli($host, $username, $password, $dbname);
    } catch (Exception $e){
        echo $e->connect_error;
        exit('Error connecting to database');
    }
?>