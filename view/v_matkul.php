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
                $query="SELECT * FROM tb_matakuliah";
                $result=$db->query($query);
                if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="asset/dataTabel/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="asset/dataTabel/css/jquery.dataTables.min.css">
</head>
<body>
                <table  id="table_id" class="table table-striped table-bordered table-hover responsive display" style="width:100% ;font-family: candara; text-align=center">
                    <thead>
                        <tr>
                            <th>ID Matkul</th>
                            <th>Nama</th>
                            <th>SKS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php

                    while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?>
                        <tr>
                            <td><?php echo $data['id_matkul']; ?></td>
                            <td><?php echo $data['nama_matkul']; ?></td>
                            <td><?php echo $data['sks_matkul']; ?></td>
                            <td>
                                <a href="?v=v_matkul&act=edit&id=<?php echo $data['id_matkul']; ?>"><button class="btn btn-success">Edit</button></a>
                                <a href="?p=p_matkul&act=delete&id=<?php echo $data['id_matkul']; ?>"><button class="btn btn-danger">Delete</button></a>
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
            $id=autoID('MK', 'tb_matakuliah', 'id_matkul');
?>
                <form action="?p=p_matkul&act=add" method="post">
                    ID Matkul: <input type="text" name="id_matkul" value='<?php echo $id; ?>' required readonly><br>
                    Nama: <input type="text" name="nama_matkul"><br>
                    SKS: <input type="number" name="sks_matkul"><br>
                    <a href="?v=v_matkul&act=view" class="btn btn-danger">Batal</a>
                    <button type="reset">Reset</button>
                    <button type="submit" name="add_matkul">Tambah</button>
                </form>
<?php
                break;
            case 'edit':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_matakuliah WHERE id_matkul='$id'";
                    $result=$db->query($query);
                    if ($result->num_rows != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                        <form action="?p=p_matkul&act=edit" method="post"><br>
                            ID Matkul: <input type="text" name="id_matkul" value="<?php echo $data['id_matkul']; ?>"><br>
                            Nama: <input type="text" name="nama_matkul" value="<?php echo $data['nama_matkul']; ?>"><br>
                            SKS: <input type="number" name="sks_matkul" value="<?php echo $data['sks_matkul']; ?>"><br>
                            <a href="?v=v_matkul&act=view" class="btn btn-danger">Batal</a>
                            <button type="submit" name="edit_matkul">Edit</button>
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
    <a href="?v=v_matkul&act=add"><button class="btn btn-primary">Tambah Matkul</button></a><br><br>

