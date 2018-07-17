<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EEPIS Informatics Laboratoium</title>
    <link rel="shortcut icon" href="logo.png" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="asset/raw/datatables.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="asset/raw/Bootstrap-3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="asset/css/custom.css" />
    <link href="asset/css/animate.min.css" rel="stylesheet">
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="asset/dataTabel/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="asset/dataTabel/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="asset/dataTabel/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="asset/dataTabel/css/responsive.bootsrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Indie Flower">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic SC">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Caveat Brush">
    <link rel="stylesheet" type="text/css" href="asset/DataTables/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="asset/DataTables/dataTables.bootstrap.css">
    <style>
        .announce{
            background-color:rgba(102, 204, 255, 0.4);
        }
    </style>
    
</head>
<header>
   <div class="container container-fluid animated bounceIn">
   <div class="header section small-padding bg-dark bg-image" style="background-image: url(asset/img/bag.jpg);  background-size: cover;">

        <div class="cover">
            <br>
            <br>
            <br>
             <br>
            <br>
            <br>
            <div class="header-inner section-inner">
                <center><font face="Indie Flower" size="6" color="black"><b> EEPIS Informatics Laboratorium </b></font></center>
                <center><font face="Indie Flower" size="4" color="white"><b> Pusat Informasi Laboratorium Informatika PENS </b></font></center>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
       
    </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
         <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav" style="font-family: candara">
            <li><a class="active" href="?v=v_home&act=view" ><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="?v=v_lab&act=view"><span class="glyphicon glyphicon-blackboard"></span> Laboratorium</a></li>
            <li><a href="?v=v_jadwal&act=view"><span class="glyphicon glyphicon-calendar"></span> Jadwal</a></li>
            <li><a href="?v=v_penelitian&act=view"><span class="glyphicon glyphicon-education"></span> Penelitian</a></li>
            <li><a href='?v=v_master&act=view'><span class="glyphicon glyphicon-knight"></span> Master</a></li>
            <li><a href='?v=v_matkul&act=view'><span class="glyphicon glyphicon-book"></span> Matkul</a></li>
            <li><a href="?v=v_pegawai&act=view"><span class="glyphicon glyphicon-briefcase"></span> Pegawai</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" style="font-family: candara">
                <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Login </a></li>
            </ul>
        </div>
            </div>
    </div>
    </nav>
    </div>
    <!-- Side navigation -->
   <div class="container container-fluid">
        <div class="col-md-15 col-lg-25 animated bounceIn">
                          <button class="statistic_item statistic_item" style="width: 100%; background: #33cccc; height: 300px;" data-toggle="collapse" data-target="#" aria-expanded="true" aria-controls="collapseOne">
                               
                            <font class="animated bounceIn" face="Amatic SC" color="black" size="6"><b>Gedung D4 </b></font>
        <?php
            require 'config/dbconn.php';
            $query="SELECT id_lab, nama_lab FROM tb_lab WHERE id_lokasi=1";
            $result=$db->query($query);
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_array(MYSQLI_BOTH)) {
                    echo "<b><h3 style='font-family: Agency FB'>"."<a href='?v=v_lab&act=view&id=".$data['id_lab']."'>Lab ".$data['nama_lab']."</a>"."</b></h3>";
                }
            } else {
                echo "<h5 style='font-family: Agency FB';color:white;'>Tidak ada lab di gedung D4</h5>";
            }
            $db->close();
        ?>
       <b><font class="animated bounceIn" face="Amatic SC" color="black" size
       ="6"> Gedung S2 </font></b>
        <?php
            require 'config/dbconn.php';
            $query="SELECT id_lab, nama_lab FROM tb_lab WHERE id_lokasi=2";
            $result=$db->query($query);
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_array(MYSQLI_BOTH)) {
                    echo "<b><h3> style='font-family: Agency FB'><a href='?v=v_lab&act=view&id=".$data['id_lab']."'>Lab ".$data['nama_lab']."</a></b></h3>";
                }
            } else {
                echo "<h5 style='font-family: Agency FB; color:black;'>Tidak ada lab di gedung S2</h5>";
            }
            $db->close();
        ?>
</div>
    <center><b><font face="Amatic SC" size="6"><a href="?v=v_lab&act=add"> Tambah Lab</a></font></b></center>
        </button>
    </div>
                        
       
    </div>
    <hr>
    </header>
  

</html>