<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'add':
                if (!isset($_POST['add_jw'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_jadwal=$_POST['id_jadwal'];
                    $id_lab=$_POST['id_lab'];
                    $id_matkul=$_POST['id_matkul'];
                    $semester_jw=$_POST['semester_jw'];
                    $tgl_jw=$_POST['tgl_jw'];
                   
                    $query="INSERT INTO tb_lab_jadwal VALUES ('$id_jadwal', '$id_lab', '$id_matkul', '$semester_jw', '$tgl_jw')";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_jadwal&act=view&id=$id_lab");
                }
                break;
            case 'edit':
                if (!isset($_POST['edit_jw'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_jadwal=trim($_POST['id_jadwal']);
                    $id_lab=trim($_POST['id_lab']);
                    $id_matkul=trim($_POST['id_matkul']);
                    $semester_jw=trim($_POST['semester_jw']);
                    $tgl_jw=trim($_POST['tgl_jw']);

                    $query="UPDATE tb_lab_jadwal SET id_jadwal='$id_jadwal', id_lab='$id_lab', id_matkul='$id_matkul',semester_jw='$semester_jw', tgl_jw='tgl_jw' WHERE id_jadwal='$id_jadwal'";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    echo "berhasil di ubah";
                    header("Location:?v=v_jadwal&act=view&id=$id_lab");
                }
                break;
            case 'delete':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_lab_jadwal WHERE id_jadwal='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM tb_lab_jadwal WHERE id_jadwal='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        header("Location:?v=v_home&act=view");
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