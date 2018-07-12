<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bla</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="asset/raw/datatables.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="asset/raw/Bootstrap-3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="asset/css/custom.css" />
</head>
<body>
    <!-- Side navigation -->
    
    <div class="sidenav">
        <a href="#" style="background:white;color:black;">Gedung D4</a>
        <?php
            require 'config/dbconn.php';
            $query="SELECT id_lab, nama_lab FROM tb_lab WHERE id_lokasi=1";
            $result=$db->query($query);
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_array(MYSQLI_BOTH)) 
                {
                    $rel= $_GET['v'];
                   if ($rel=='v_lab' || $rel=="?v=v_home&act=view" ) 
                   {
                    
                    echo "<a href='?v=v_lab&act=view&id=".$data['id_lab']."'>Lab ".$data['nama_lab']."</a>";
                   }
                   else  if ($rel=='v_jadwal') { 
                      
                       echo "<a href='?v=v_jadwal&act=view&id=".$data['id_lab']."'>Lab ".$data['nama_lab']."</a>";
                   }
                   else 
                   {
                      echo "<a href='?v=v_lab&act=view&id=".$data['id_lab']."'>Lab ".$data['nama_lab']."</a>";
                   }

                }
            } else {
                echo "<h4 style='color:white;'>Tidak ada lab di gedung D4</h4>";
            }
            $db->close();
        ?>
        <a href="#" style="background:white;color:black;">Gedung S2</a>
        <?php
            require 'config/dbconn.php';
            $query="SELECT id_lab, nama_lab FROM tb_lab WHERE id_lokasi=2";
            $result=$db->query($query);
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_array(MYSQLI_BOTH)) 
                {
                    $rel= $_GET['v'];
                   if ($rel=='v_lab' || $rel=="?v=v_home&act=view") 
                   {
                 
                    echo "<a href='?v=v_lab&act=view&id=".$data['id_lab']."'>Lab ".$data['nama_lab']."</a>";
                   }
                   else  if ($rel=='v_jadwal') { 
                      
                       echo "<a href='?v=v_jadwal&act=view&id=".$data['id_lab']."'>Lab ".$data['nama_lab']."</a>";
                   }
                   else
                   {
                      echo "<a href='?v=v_lab&act=view&id=".$data['id_lab']."'>Lab ".$data['nama_lab']."</a>";
                   }

                }
            } else {
                echo "<h4 style='color:white;'>Tidak ada lab di gedung s2</h4>";
            }

            $db->close();
        ?>
        <?php
         if($rel=='v_lab'){
                echo "<a href='?v=v_lab&act=add'><button class='btn btn-primary'>Tambah Lab</button></a>";
            }
            else if ($rel=='v_jadwal'){
                echo "<a href='?v=v_jadwal&act=add'><button class='btn btn-primary'>Tambah Jadwal</button></a>";
            }  
        ?>


    </div>
    <!-- Page content -->
    <div class="main">
        <!-- Top navigation --> 
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="?v=v_home&act=view">Home</a>
            </div>
            <ul class="nav navbar-nav">
                <!-- <li><a href="?v=v_lab&act=view">Lab</a></li> -->
                <li><a href="?v=v_pegawai&act=view">Pegawai</a></li>
                <li><a href='?v=v_jadwal&act=view&id=c102'>Jadwal</a></li>
            </ul>
        </div>
        </nav>
        <h4>Ini header, ada di file header.php</h4>
        <hr>
        <br>