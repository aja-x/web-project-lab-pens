<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'view':
?>
                <a href="?v=v_pegawai&act=add"><button class="btn btn-primary">Tambah Pegawai</button></a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Dosen</button><br><br>
<?php
                require 'config/dbconn.php';
                $query="SELECT * FROM tb_pegawai LEFT JOIN tb_lab ON tb_lab.id_lab=tb_pegawai.id_lab LEFT JOIN m_jabatan ON m_jabatan.id_jabatan=tb_pegawai.id_jabatan ORDER BY nip";
                $result=$db->query($query);
                if ($result->num_rows > 0) {
?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Lab</th>
                            <th>Jabatan</th>
                            <th>Status</th>
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
                            <td><?php echo $data['email_pg']; ?></td>
                            <td><?php if ($data['nama_lab']==NULL) { echo "-"; } else { echo $data['nama_lab']; } ?></td>
                            <td><?php if ($data['nama_jabatan']==NULL) { echo "-"; } else { echo $data['nama_jabatan']; } ?></td>
                            <td>
                                <?php
                                    $nip=$data['nip'];
                                    $query2="SELECT * FROM tb_pengajar WHERE nip='$nip'";
                                    $num_rows=$db->query($query2)->num_rows;
                                    if ($num_rows>0) { echo "Dosen"; } else { echo "Bukan Dosen"; }
                                ?>
                            </td>
                            <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="ModalLabel">Detail Dosen</h5>
                                </div>
                                <div class="modal-body">
                                    NIP: <?php echo $data['nip']; ?><br>
                                    Nama: <?php echo $data['nama_pg']; ?><br>
                                    Alamat: <?php echo $data['alamat_pg']; ?><br>
                                    TTL: <?php echo $data['tmp_lahir_pg'].", ".convDateDMY($data['tgl_lahir_pg']); ?><br>
                                    Jenis Kelamin: <?php if ($data['jk_pg']=='l') {echo "Laki-laki";} else {echo "Perempuan";} ?><br>
                                    No. Telp: <?php echo $data['no_telp_pg']; ?><br>
                                    Email: <?php echo $data['email_pg']; ?><br>
                                    Lab: <?php if ($data['nama_lab']==NULL) { echo "-"; } else { echo $data['nama_lab']; } ?><br>
                                    Jabatan: <?php if ($data['nama_jabatan']==NULL) { echo "-"; } else { echo $data['nama_jabatan']; } ?><br>
                                    <?php
                                            if ($num_rows>0) {
                                                echo "Dosen Mata Kuliah:<br>";
                                                $query3="SELECT * FROM tb_matakuliah JOIN tb_pengajar ON tb_matakuliah.id_matkul=tb_pengajar.id_matkul WHERE tb_matakuliah.id_matkul IN (SELECT id_matkul FROM tb_pengajar WHERE nip='$nip')";
                                                $result3=$db->query($query3);
                                                    echo "<ol>";
                                                    while ($data3=$result3->fetch_array(MYSQLI_BOTH)) {
                                                        echo "<li>".$data3['nama_matkul'];
                                    ?>
                                                        <a href="?p=p_pegawai&act=delete_dosen&id=<?php echo $data3['id_pengajar']; ?>"><button class="btn btn-danger">Delete</button></a></li>
                                    <?php
                                                    }
                                                    echo "</ol>";
                                            }
                                    ?>

                                </div>
                                </div>
                            </div>
                            </div>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal2">Detail</button>
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
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen</h5>
                    </div>
                    <div class="modal-body">
                        <form action="?p=p_pegawai&act=add_dosen" method="post">
                            Pegawai:
                                <select name="nip">
                                    <?php
                                        require 'config/dbconn.php';
                                        $query="SELECT nip, nama_pg FROM tb_pegawai";
                                        $result=$db->query($query);
                                        while ($data2=$result->fetch_array(MYSQLI_BOTH)) {
                                            echo "<option value='".$data2[0]."'>".$data2[0]." - ".$data2[1]."</option>";
                                        }
                                        $db->close();
                                    ?>
                                </select><br>
                            Mata Kuliah: 
                                <select name="id_matkul">
                                    <?php
                                        require 'config/dbconn.php';
                                        $query="SELECT id_matkul, nama_matkul FROM tb_matakuliah";
                                        $result=$db->query($query);
                                        while ($data2=$result->fetch_array(MYSQLI_BOTH)) {
                                            echo "<option value='".$data2[0]."'>".$data2[1]."</option>";
                                        }
                                        $db->close();
                                    ?>
                                </select><br>
                            <button type="reset">Reset</button>
                            <button type="submit" name="add_dosen">Tambah</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">Tambah</button>
                    </div>
                    </div>
                </div>
                </div>
<?php
                break;
            case 'add':
?>
                <form action="?p=p_pegawai&act=add" method="post">
                    NIP: <input type="number" name="nip" required><br>
                    Nama: <input type="text" name="nama_pg"><br>
                    Alamat: <input type="text" name="alamat_pg"><br>
                    TTL: <input type="text" name="tmp_lahir_pg">, <input type="date" name="tgl_lahir_pg"><br>
                    Jenis Kelamin: 
                        <select name="jk_pg">
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>
                        </select><br>
                    No. Telp: <input type="number" name="no_telp_pg"><br>
                    Email: <input type="email" name="email_pg"><br>
                    Lab:
                        <select name="id_lab">
                            <?php
                                require 'config/dbconn.php';
                                $query="SELECT id_lab, nama_lab FROM tb_lab";
                                $result=$db->query($query);
                                while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                    echo "<option value='".$data[0]."'>".$data['id_lab']." - ".$data[1]."</option>";
                                }
                                $db->close();
                            ?>
                        </select><br>
                    Jabatan: 
                        <select name="id_jabatan">
                            <?php
                                require 'config/dbconn.php';
                                $query="SELECT * FROM m_jabatan";
                                $result=$db->query($query);
                                while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                    echo "<option value='".$data[0]."'>".$data[1]."</option>";
                                }
                                $db->close();
                            ?>
                        </select><br>
                    <a href="?v=v_pegawai&act=view" class="btn btn-danger">Batal</a>
                    <button type="reset">Reset</button>
                    <button type="submit" name="add_pg">Tambah</button>
                </form>
<?php
                break;
            case 'edit':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_pegawai WHERE nip='$id'";
                    $result=$db->query($query);
                    if ($result->num_rows != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                        <form action="?p=p_pegawai&act=edit" method="post"><br>
                            NIP: <input type="text" name="nip" value="<?php echo $data['nip']; ?>"><br>
                            Nama: <input type="text" name="nama_pg" value="<?php echo $data['nama_pg']; ?>"><br>
                            Alamat: <input type="text" name="alamat_pg" value="<?php echo $data['alamat_pg']; ?>"><br>
                            TTL: <input type="text" name="tmp_lahir_pg" value="<?php echo $data['tmp_lahir_pg']; ?>">, <input type="date" name="tgl_lahir_pg"  value="<?php echo $data['tgl_lahir_pg']; ?>"><br>
                            Jenis Kelamin: 
                                <select name="jk_pg">
                                    <option value="l" <?php if ($data['jk_pg']=='l') {echo "selected";} ?>>Laki-laki</option>
                                    <option value="p" <?php if ($data['jk_pg']=='p') {echo "selected";} ?>>Perempuan</option>
                                </select><br>
                            No. Telp: <input type="number" name="no_telp_pg" value="<?php echo $data['no_telp_pg']; ?>"><br>
                            Email: <input type="email" name="email_pg" value="<?php echo $data['email_pg']; ?>"><br>
                            Lab:
                                <select name="id_lab">
                                    <?php
                                        require 'config/dbconn.php';
                                        $query="SELECT id_lab, nama_lab FROM tb_lab";
                                        $result=$db->query($query);
                                        while ($data2=$result->fetch_array(MYSQLI_BOTH)) {
                                            echo "<option value='".$data2['id_lab']."'";
                                            if ($data2['id_lab']==$data['id_lab']) { echo "selected"; }
                                            echo ">".$data2['id_lab']." - ".$data2['nama_lab']."</option>";
                                        }
                                        $db->close();
                                    ?>
                                </select><br>
                            Jabatan: 
                                <select name="id_jabatan">
                                    <?php
                                        require 'config/dbconn.php';
                                        $query="SELECT * FROM m_jabatan";
                                        $result=$db->query($query);
                                        while ($data2=$result->fetch_array(MYSQLI_BOTH)) {
                                            echo "<option value='".$data2['id_jabatan']."'";
                                            if ($data2['id_jabatan']==$data['id_jabatan']) { echo "selected"; }
                                            echo ">".$data2['nama_jabatan']."</option>";
                                        }
                                        $db->close();
                                    ?>
                                </select><br>
                            <a href="?v=v_pegawai&act=view" class="btn btn-danger">Batal</a>
                            <button type="submit" name="edit_pg">Edit</button>
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