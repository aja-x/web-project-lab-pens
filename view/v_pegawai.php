<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'view':
?>

 


                <a href="?v=v_pegawai&act=add"><button class="btn btn-primary">Tambah Pegawai</button></a><br><br>
<?php
                require 'config/dbconn.php';
                $query="SELECT * FROM tb_pegawai JOIN tb_lab ON tb_lab.id_lab=tb_pegawai.id_lab JOIN m_jabatan ON m_jabatan.id_jabatan=tb_pegawai.id_jabatan";
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
                            <th>Lab</th>
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
                            <td><?php echo $data['nama_lab']; ?></td>
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
                                    echo "<option value='".$data[0]."'>".$data[1]."</option>";
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
                                            echo ">".$data2['nama_lab']."</option>";
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