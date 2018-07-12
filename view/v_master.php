<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'view':
?>
                <a href="?v=v_master&act=add_jabatan"><button class="btn btn-primary">Tambah Jabatan</button></a><br><br>
<?php
                require 'config/dbconn.php';
                $query="SELECT * FROM m_jabatan";
                $result=$db->query($query);
                $i=1;
                if ($result->num_rows > 0) {
?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
<?php

                    while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['nama_jabatan']; ?></td>
                            <td>
                                <a href="?v=v_master&act=edit_jabatan&id=<?php echo $data['id_jabatan']; ?>"><button class="btn btn-success">Edit</button></a>
                                <a href="?p=p_master&act=delete_jabatan&id=<?php echo $data['id_jabatan']; ?>"><button class="btn btn-danger">Delete</button></a>
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
?>
                <a href="?v=v_master&act=add_lokasi"><button class="btn btn-primary">Tambah Lokasi</button></a><br><br>
<?php
                require 'config/dbconn.php';
                $query="SELECT * FROM m_lokasi";
                $result=$db->query($query);
                $i=1;
                if ($result->num_rows > 0) {
?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
<?php

                    while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['nama_lokasi']; ?></td>
                            <td>
                                <a href="?v=v_master&act=edit_lokasi&id=<?php echo $data['id_lokasi']; ?>"><button class="btn btn-success">Edit</button></a>
                                <a href="?p=p_master&act=delete_lokasi&id=<?php echo $data['id_lokasi']; ?>"><button class="btn btn-danger">Delete</button></a>
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
            case 'add_jabatan':
?>
                <form action="?p=p_master&act=add_jabatan" method="post">
                    Nama Jabatan: <input type="text" name="nama_jabatan"><br>
                    <a href="?v=v_master&act=view" class="btn btn-danger">Batal</a>
                    <button type="reset">Reset</button>
                    <button type="submit" name="add_jabatan">Tambah</button>
                </form>
<?php
                break;
            case 'edit_jabatan':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM m_jabatan WHERE id_jabatan='$id'";
                    $result=$db->query($query);
                    if ($result->num_rows != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                        <form action="?p=p_master&act=edit_jabatan" method="post"><br>
                            <input type="hidden" name="id_jabatan" value="<?php echo $data['id_jabatan']; ?>"><br>
                            Nama Jabatan: <input type="text" name="nama_jabatan" value="<?php echo $data['nama_jabatan']; ?>"><br>
                            <a href="?v=v_master&act=view" class="btn btn-danger">Batal</a>
                            <button type="submit" name="edit_jabatan">Edit</button>
                        </form>
<?php
                    }
                }
                break;
            case 'add_lokasi':
?>
                <form action="?p=p_master&act=add_lokasi" method="post">
                    Nama Lokasi: <input type="text" name="nama_lokasi"><br>
                    <a href="?v=v_master&act=view" class="btn btn-danger">Batal</a>
                    <button type="reset">Reset</button>
                    <button type="submit" name="add_lokasi">Tambah</button>
                </form>
<?php
                break;
            case 'edit_lokasi':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM m_lokasi WHERE id_lokasi='$id'";
                    $result=$db->query($query);
                    if ($result->num_rows != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                        <form action="?p=p_master&act=edit_lokasi" method="post"><br>
                            <input type="hidden" name="id_lokasi" value="<?php echo $data['id_lokasi']; ?>"><br>
                            Nama Lokasi: <input type="text" name="nama_lokasi" value="<?php echo $data['nama_lokasi']; ?>"><br>
                            <a href="?v=v_master&act=view" class="btn btn-danger">Batal</a>
                            <button type="submit" name="edit_lokasi">Edit</button>
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