<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'view':
?>
<div class="container container-fluid">
<?php
                require 'config/dbconn.php';
                $query="SELECT * FROM tb_modulkuliah JOIN tb_matakuliah ON tb_modulkuliah.id_matkul=tb_matakuliah.id_matkul JOIN tb_pegawai ON tb_modulkuliah.id_uploader=tb_pegawai.nip";
                $result=$db->query($query);
                if ($result->num_rows > 0) {
?>
                <table id="table_id" class="table table-striped table-bordered table-hover display">
                    <thead>
                        <tr>
                            <th>ID Modul</th>
                            <th>Nama</th>
                            <th>Matkul</th>
                            <th>Uploader</th>
                            <th>Tgl Upload</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php

                    while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?>
                        <tr>
                            <td><?php echo $data['id_modul']; ?></td>
                            <td><?php echo $data['nama_modul']; ?></td>
                            <td><?php echo $data['nama_matkul']; ?></td>
                            <td><?php echo $data['nama_pg']; ?></td>
                            <td><?php echo convDateDMY($data['tglupl_modul']); ?></td>
                            <td><?php echo $data['filesize_modul']/1000 .' kB'; ?></td>
                            <td>
                                <a href="?p=p_modul&act=download&id=<?php echo $data['id_modul']; ?>"><button class="btn btn-primary">Download</button></a>
                                <a href="?p=p_modul&act=delete&id=<?php echo $data['id_modul']; ?>"><button class="btn btn-danger">Delete</button></a>
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
            $id=autoID('MD', 'tb_modulkuliah', 'id_modul');
?>
                <form action="?p=p_modul&act=add" method="post" enctype="multipart/form-data">
                    ID Modul: <input type="text" name="id_modul" value="<?php echo $id; ?>" required readonly><br>
                    Nama: <input type="text" name="nama_modul" required><br>
                    Matkul:
                        <select name="id_matkul" required>
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
                    Pilih file (.pdf): <input type="file" name="file_modul" accept=".pdf" required>
                    <a href="?v=v_modul&act=view" class="btn btn-danger">Batal</a>
                    <button type="reset">Reset</button>
                    <button type="submit" name="add_modul">Tambah</button>
                </form>
<?php
                break;
            case 'edit':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_modulkuliah WHERE nip='$id'";
                    $result=$db->query($query);
                    if ($result->num_rows != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                        <form action="?p=p_modul&act=edit" method="post" enctype="multipart/form-data">
                            ID Modul: <input type="text" name="id_modul" value="<?php echo $data['id_modul']; ?>" required readonly><br>
                            Nama: <input type="text" name="nama_modul" value="<?php echo $data['nama_modul']; ?>" required><br>
                            Matkul:
                                <select name="id_matkul" required>
                                    <?php
                                        require 'config/dbconn.php';
                                        $query="SELECT id_matkul, nama_matkul FROM tb_matakuliah";
                                        $result=$db->query($query);
                                        while ($data2=$result->fetch_array(MYSQLI_BOTH)) {
                                            echo "<option value='".$data2['id_matkul']."'";
                                            if ($data2['id_matkul']==$data['id_matkul']) { echo "selected"; }
                                            echo ">".$data2['nama_matkul']."</option>";
                                        }
                                        $db->close();
                                    ?>
                                </select><br>
                            Pilih file (.pdf): <input type="file" name="file_modul" accept=".pdf" value="<?php echo $data['file_modul']; ?>" required>
                            <a href="?v=v_modul&act=view" class="btn btn-danger">Batal</a>
                            <button type="submit" name="edit_modul">Tambah</button>
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
 <a href="?v=v_modul&act=add"><button class="btn btn-primary">Tambah Modul</button></a><br><br>