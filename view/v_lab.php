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
                    <!-- <a href="?v=v_lab&act=add"><button class="btn btn-primary">Tambah Lab</button></a><br><br> -->
                    <h3>Profile Laboratorium <?php echo $data['id_lab']; ?></h3>
                    <div class="container col-lg-12">
                        <div class="col-lg-6">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>ID Lab</th>
                                    <td>: </td>
                                    <td><?php echo $data['id_lab']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Lab</th>
                                    <td>: </td>
                                    <td><?php echo $data['nama_lab']; ?></td>
                                </tr>
                                <tr>
                                    <th>Lokasi Lab</th>
                                    <td>: </td>
                                    <td><?php echo $data['nama_lokasi']; ?></td>
                                </tr>
                            </table>
                            <a href="?v=v_lab&act=edit&id=<?php echo $data[0]; ?>"><button class="btn btn-success">Edit</button></a>
                            <a href="?p=p_lab&act=delete&id=<?php echo $data[0]; ?>"><button class="btn btn-danger">Delete</button></a>
                        </div>

                        <div class="col-lg-6 jumbotron">
                            <h3>Area buat foto lab</h3>
                        </div>
                    </div>
                    <div class="container col-lg-12">
                        <h4>Penghuni Lab</h4>
<?php
                        require 'config/dbconn.php';
                        $query="SELECT * FROM tb_pegawai JOIN m_jabatan ON m_jabatan.id_jabatan=tb_pegawai.id_jabatan WHERE id_lab='$id'";
                        $result=$db->query($query);
                        if ($result->num_rows > 0) {
?>
                        <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>TTL</th>
                                <th>Jenis Kelamin</th>
                                <th>No. Telp</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?>
                                    <tr>
                                        <td><?php echo $data['nip']; ?></td>
                                        <td><?php echo $data['nama_pg']; ?></td>
                                        <td><?php echo $data['alamat_pg']; ?></td>
                                        <td><?php echo $data['tmp_lahir_pg'].", ".convDateDMY($data['tgl_lahir_pg']); ?></td>
                                        <td><?php if ($data['jk_pg']=='l') {echo "Laki-laki";} else {echo "Perempuan";} ?>
                                        <td><?php echo $data['no_telp_pg']; ?></td>
                                        <td><?php echo $data['email_pg']; ?></td>
                                        <td><?php echo $data['nama_jabatan']; ?></td>
                                        <td>
                                            <a href="?v=v_pegawai&act=edit&id=<?php echo $data['nip']; ?>"><button class="btn btn-success">Edit</button></a>
                                            <a href="?p=p_pegawai&act=delete&id=<?php echo $data['nip']; ?>"><button class="btn btn-danger">Delete</button></a>
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
                <form action="?p=p_lab&act=add" method="post"><br>
                    ID Lab: <input type="text" name="id_lab"><br>
                    Nama Lab: <input type="text" name="nama_lab"><br>
                    Lokasi:
                        <select name="id_lokasi">
                            <?php
                                require 'config/dbconn.php';
                                $query="SELECT * FROM m_lokasi";
                                $result=$db->query($query);
                                while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                    echo "<option value='".$data[0]."'>".$data[1]."</option>";
                                }
                            ?>
                        </select><br>
                    <a href="?v=v_lab&act=view" class="btn btn-danger">Batal</a>
                    <button type="reset">Reset</button>
                    <button type="submit" name="add_lab">Tambah</button>
                </form>
<?php
                break;
            case 'edit':
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
                        <form action="?p=p_lab&act=edit" method="post"><br>
                            ID Lab: <input type="text" name="id_lab" value="<?php echo $data[0] ?>"><br>
                            Nama Lab: <input type="text" name="nama_lab" value="<?php echo $data[1] ?>"><br>
                            Lokasi:
                                <select name="id_lokasi">
                                    <?php
                                        require 'config/dbconn.php';
                                        $query="SELECT * FROM m_lokasi";
                                        $result=$db->query($query);
                                        while ($data2=$result->fetch_array(MYSQLI_BOTH)) {
                                            echo "<option value='".$data2[0]."'";
                                            if ($data2[0]==$data[2]) { echo "selected"; }
                                            echo ">".$data2[1]."</option>";
                                        }
                                    ?>
                                </select><br>
                            <a href="?v=v_lab&act=view" class="btn btn-danger">Batal</a>
                            <button type="submit" name="edit_lab" class="btn btn-primary">Edit</button>
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