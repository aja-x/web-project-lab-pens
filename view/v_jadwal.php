<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'view':
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
                        $query="SELECT * FROM tb_lab_jadwal JOIN tb_lab ON tb_lab_jadwal.id_lab=tb_lab.id_lab JOIN tb_pengajar ON tb_lab_jadwal.id_pengajar=tb_pengajar.id_pengajar JOIN tb_matakuliah ON tb_matakuliah.id_matkul=tb_pengajar.id_matkul JOIN tb_pegawai ON tb_pengajar.nip=tb_pegawai.nip where tb_lab_jadwal.id_lab='$id'";
                        $result=$db->query($query);
                        $i=1;
                        if ($result->num_rows > 0) {
?>
                        <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Dosen</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?>
                      <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['nama_pg']; ?></td>
                            <td><?php echo $data['nama_matkul']; ?></td>
                            <td><?php echo $data['kelas_jw']; ?></td>
                            <td><?php echo $data['semester_jw']; ?></td>
                            <td><?php echo date('H:i:s', strtotime($data['tgl_jw'])); ?></td>
                            <td><?php echo $data['jam_akhir_jw']; ?></td>
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
                <?php
                    global $ID;
                    $id_matkul=0;
                ?>
                <form name="matkul" method="post" action="?v=v_jadwal&act=add">
                    Mata Kuliah: <select name="id_matkul" onchange="matkul.submit();">
                        <option value="">Pilih Mata Kuliah</option>
                        <?php
                            require 'config/dbconn.php';
                            $query="SELECT * FROM tb_matakuliah";
                            $result=$db->query($query);
                            while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                echo "<option value='".$data[0]."'";
                                if (isset($_POST['id_matkul'])) {
                                    if ($_POST['id_matkul']==$data[0]) { echo "selected"; }
                                }
                                echo ">".$data[1]."</option>";
                            }
                            $db->close();
                        ?>
                    </select><br>
                </form>
                <?php
                    if (isset($_POST['id_matkul'])) {
                        $id_matkul=$_POST['id_matkul'];
                        require 'config/dbconn.php';
                        $query="SELECT * FROM tb_pengajar JOIN tb_pegawai ON tb_pengajar.nip=tb_pegawai.nip WHERE id_matkul='$id_matkul'";
                        $result=$db->query($query);
                        if ($result->num_rows > 0) {
                ?>
                        <form action="?p=p_jadwal&act=add" method="post">
                            <input type="hidden" name="id_matkul" value="<?php echo $id_matkul; ?>">
                            Lab:
                                <select name="id_lab">
                                    <?php
                                        require 'config/dbconn.php';
                                        $query2="SELECT id_lab, nama_lab FROM tb_lab";
                                        $result2=$db->query($query2);
                                        while ($data2=$result2->fetch_array(MYSQLI_BOTH)) {
                                            echo "<option value='".$data2[0]."'>".$data2[0]." - ".$data2[1]."</option>";
                                            $ID= $data2[0];
                                        }
                                    ?>
                                </select><br>
                            Dosen:
                                <select name="id_pengajar">
                                    <?php
                                        while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                            echo "<option value='".$data['id_pengajar']."'>".$data['nama_pg']."</option>";
                                        }
                                        $db->close();
                                    ?>
                                </select><br>
                            Kelas:
                                <select name="kelas_jw">
                                    <option value="D3 IT A">D3 IT A</option>
                                    <option value="D3 IT B">D3 IT B</option>
                                    <option value="D4 IT A">D4 IT A</option>
                                    <option value="D4 IT B">D4 IT B</option>
                                </select>
                                <input type="number" name="angkatan_jw" placeholder="angkatan"><br>
                            Semester: <input type="number" name="semester_jw"><br>
                            Tahun: <input type="number" name="tahun_jw" value="<?php echo date('Y'); ?>"><br>
                            Jam: <input type="time" name="time_jw"> - <input type="time" name="time_akhir_jw"><br>
                            <a href="?v=v_jadwal&act=view&id=<?php echo $ID; ?>"><button class="btn btn-success">Batal</button></a>
                            <button type="reset">Reset</button>
                            <input type="submit" name="add_jw" value="Tambah">
                        </form>
<?php
                        }
                    }
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
                    } else {echo "<option value='".$data2[0]."'";
                        if ($data2[0]==$data[2]) { echo "selected"; }
                        echo ">".$data2[1]."</option>";
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

