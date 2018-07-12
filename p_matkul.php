<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'add':
                if (!isset($_POST['add_matkul'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_matkul=$_POST['id_matkul'];
                    $nama_matkul=$_POST['nama_matkul'];
                    $sks_matkul=$_POST['sks_matkul'];
                    $query="INSERT INTO tb_matakuliah VALUES ('$id_matkul', '$nama_matkul', '$sks_matkul')";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_matkul&act=view");
                }
                break;
            case 'edit':
                if (!isset($_POST['edit_matkul'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_matkul=$_POST['id_matkul'];
                    $nama_matkul=$_POST['nama_matkul'];
                    $sks_matkul=$_POST['sks_matkul'];
                    $query="UPDATE tb_matakuliah SET nama_matkul='$nama_matkul', sks_matkul='$sks_matkul' WHERE id_matkul='$id_matkul'";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_matkul&act=view");
                }
                break;
            case 'delete':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_matakuliah WHERE id_matkul='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM tb_matakuliah WHERE id_matkul='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        header("Location:?v=v_matkul&act=view");
                    } else {
                        include '404.php';
                    }
                    $db->close();
                }
                break;
            default:
                include '404.php';
                break;
        }
    }
?>