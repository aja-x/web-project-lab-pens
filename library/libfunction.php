<?php
    //fileHandler() function for dynamic link by AJA-X
    function fileHandler($folder,$namefile)
    {
        if (!file_exists($folder.$namefile.'.php') || !is_readable($folder.$namefile.'.php') || !include($folder.$namefile.'.php')) {
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

    // function escape($string)
    // {
    //     $string=$db->real_escape_string($string);
    //     $string=addcslashes($string, '%_');
    //     return $string;
    // }
?>