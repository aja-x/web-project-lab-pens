<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'view':        
?>
        <div class="container container-fluid">
                 <h1>Silahkan pilih lab di navigasi bar bagian kiri</h1>
                <h3>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In ratione cum consequuntur reprehenderit maxime nisi, facere, consectetur, deserunt culpa accusamus ex nesciunt nostrum doloribus facilis explicabo id! Laboriosam, provident numquam?</h3>
                <a href="?v=v_lab&act=add"><button class="btn btn-primary">Tambah Lab
                </button></a>
<?php
                break;
            case 'detail':
                if (!isset($_GET['id'])) {
                         include '404.php';
                    
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_lab JOIN m_lokasi ON m_lokasi.id_lokasi=tb_lab.id_lokasi WHERE id_lab='$id'";
                    $result=$db->query($query);
                    if ($result->num_rows != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                  
                    
                    <div class="container col-lg-12">
                        <h4>jadwal Lab <?php echo $data['id_lab'];?></h4>
<?php
                        require 'config/dbconn.php';
                        $query="SELECT * FROM tb_lab_jadwal JOIN tb_matakuliah ON tb_lab_jadwal.id_matkul=tb_matakuliah.id_matkul JOIN tb_pengajar ON tb_matakuliah.id_matkul=tb_pengajar.id_matkul JOIN tb_pegawai ON tb_pengajar.nip=tb_pegawai.nip where tb_lab_jadwal.id_lab='$id'";
                        $result=$db->query($query);
                        if ($result->num_rows > 0) {
?>
                        <table id="table_id" class="table table-striped table-bordered table-hover display">
                        <thead>
                            <thead>
                        <tr>
                            <th>Jam</th>
                            <th>Matakuliah</th>
                            <th>Dosen</th>
                            <th>Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        </thead>
                        <tbody>
<?php
                            while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?>
                      <tr>
                            <?php 
                                 $file=$data['tgl_jw'];
                                 $file2=split(" ", $file);

                            ?>
                            <td><?php echo $file2['1']; ?></td>
                            <td><?php echo $data['nama_matkul']; ?></td>
                            <td><?php echo $data['nama_pg']; ?></td>
                             <td><?php echo $data['semester_jw']; ?></td>
                            <td>
                                <a href="?v=v_jadwal&act=edit&id=<?php echo $data['id_jadwal']; ?>"><button class="btn btn-success">Edit</button></a>
                                <a href="?p=p_jadwal&act=delete&id=<?php echo $data['id_jadwal']; ?>"><button class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>
<?php
                                }
?>
                        </tbody>
                    </table>
<?php
                } else {
                    echo "Data not found<br>";
                }
                $db->close();
?>
                    </div>
<?php
                    }
                }
                break;
            case 'add':
?>
                <?php global $ID;?>
                <form action="?p=p_jadwal&act=add" method="post">
                 ID Jadwal : <input type="text" name="id_jadwal" required><br>
                 ID Lab:
                        <select name="id_lab">
                            <?php
                                require 'config/dbconn.php';
                                $query="SELECT id_lab, nama_lab FROM tb_lab";
                                $result=$db->query($query);
                                while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                    echo "<option value='".$data[0]."'>".$data[1]."</option>";
                                     $ID= $data[0];
                                }
                                $db->close();
                            ?>
                        </select><br>
                    ID MataKuliah:
                     <select name="id_matkul">
                            <?php
                                require 'config/dbconn.php';
                                $query="SELECT id_matkul, nama_matkul FROM tb_matakuliah";
                                $result=$db->query($query);
                                while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                    echo "<option value='".$data[0]."'>".$data[1]."</option>";
                                }
                                $db->close();
                            ?>
                        </select><br>

                    Sememster: <input type="text" name="semester_jw"><br>
                    Tanggal:  <input type="timestamp" name="tgl_jw"><br>
                    
                    <a href="?v=v_jadwal&act=view&id=<?php echo $ID; ?>"><button class="btn btn-success">Batal</button></a>
                    <button type="reset">Reset</button>
                    <input type="submit" name="add_jw" id="add_jw" value="Tambah">
                </form>    
<?php
                break;
            case 'edit':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_lab_jadwal WHERE id_jadwal='$id'";
                    $result=$db->query($query);
                    if ($result->num_rows != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                        <form action="?p=p_jadwal&act=edit" method="post"><br>
                            ID Jadwal: <input type="text" name="id_jadwal" value="<?php echo $data['id_jadwal']; ?>"><br>
                            Lab:
                                <select name="id_lab">
                                    <?php
                                        require 'config/dbconn.php';
                                        $query="SELECT id_lab, nama_lab FROM tb_lab";
                                        $result=$db->query($query);
                                        while ($data2=$result->fetch_array(MYSQLI_BOTH)) {
                                            echo "<option value='".$data2['id_lab']."'";
                                            if ($data2['id_lab']==$data['id_lab']) { echo "selected"; }
                                            echo ">".$data2['nama_lab']."</option>";
                                        }
                                        $db->close();
                                    ?>
                                </select><br>
                                 ID MataKuliah:
                                  <select name="id_matkul" id="id_matkul">
                                    <?php
                                         require 'config/dbconn.php';
                                        $query="SELECT id_matkul, nama_matkul FROM tb_matakuliah";
                                         $result=$db->query($query);
                                        while ($data2=$result->fetch_array(MYSQLI_BOTH)) {
                                         echo "<option value='".$data2[0]."'";
                                         if ($data2[0]==$data['id_matkul']) {echo "selected";}
                                         echo ">".$data2[1]."</option>";
                                }
                                $db->close();
                            ?>
                                 </select><br>
 
                             Status : <input type="text" name="semester_jw" value="<?php echo $data['semester_jw']; ?>"><br>
                             Tanggal : <input type="timestamp" name="tgl_jw" value="<?php echo $data['tgl_jw']; ?>"><br>
                            <a href="?v=v_jadwal&act=view" class="btn btn-danger">Batal</a>
                           <input type="submit" name="edit_jw" id="edit_jw" value='Edit' class='btn- btn-success'>
                        </form>
<?php
                    }
                }
                break;

            default:
                include '404.php';
                break;
        }
    }
?>

