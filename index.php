<?php
    //menambahkan file header dan file berisi fungsi2 php
    require_once 'header.php';
    require_once 'library/libfunction.php';

    //dynamic link php, membuat link menjadi dinamis,
    //jadi cuma perlu include isi dari folder process & view, pakai GET & fungsi fileHandler()
    //biar lebih jelas, coba cek address bar di browser
    if (isset($_GET['v'])) {
        //coba cari fungsi dari try catch di php.net
        try {
            //fungsi fileHandler() ada di libfunction.php
            fileHandler("view/", $_GET['v']);
        } catch (Exception $e) {
            $e->getMessage();
        }
    } elseif (isset($_GET['p'])) {
        try {
            fileHandler("process/", $_GET['p']);
        } catch (Exception $e) {
            $e->getMessage();
        }
    } else {
        require 'view/v_home.php';
    }
    
    //menambahkan file footer
    require_once 'footer.php';
?>