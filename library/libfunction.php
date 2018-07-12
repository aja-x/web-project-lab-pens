<?php
    //fileHandler() function for dynamic link by AJA-X
    function fileHandler($folder,$namefile)
    {
        if (!is_readable($folder.$namefile.'.php') || !include($folder.$namefile.'.php')) {
            throw new Exception(include('404.php'));
        }
    }
    
    function convDateDMY($date)
    {
        return date("d-m-Y", strtotime($date));
    }

    function convDateYMD($date)
    {
        return date("Y-m-d", strtotime($date));
    }
        
    function autoID($id, $table, $primaryKey)
    {
        require 'config/dbconn.php';
        $sql="SELECT max($primaryKey) as maxID FROM $table";
        $data=$db->query($sql)->fetch_array(MYSQLI_BOTH);
        $noUrut=(int)substr($data['maxID'], 3, 7);
        return $id.'-'.sprintf("%07s", $noUrut+1);
    }
    // function escape($string)
    // {
    //     $string=$db->real_escape_string($string);
    //     $string=addcslashes($string, '%_');
    //     return $string;
    // }
?>