<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'add':
                if (!isset($_POST['add_lab'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_lab=$_POST['id_lab'];
                    $nama_lab=$_POST['nama_lab'];
                    $id_lokasi=$_POST['id_lokasi'];
                    $query="INSERT INTO tb_lab VALUES ('$id_lab', '$nama_lab', '$id_lokasi')";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_lab&act=view");
                }
                break;
            case 'edit':
                if (!isset($_POST['edit_lab'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_lab=$_POST['id_lab'];
                    $nama_lab=$_POST['nama_lab'];
                    $id_lokasi=$_POST['id_lokasi'];
                    $query="UPDATE tb_lab SET id_lab='$id_lab', nama_lab='$nama_lab', id_lokasi='$id_lokasi' WHERE id_lab='$id_lab'";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_lab&act=view");
                }
                break;
            case 'delete':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_lab WHERE id_lab='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM tb_lab WHERE id_lab='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        header("Location:?v=v_lab&act=view");
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