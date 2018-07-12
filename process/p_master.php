<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'add_jabatan':
                if (!isset($_POST['add_jabatan'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $nama_jabatan=$_POST['nama_jabatan'];
                    $query="INSERT INTO m_jabatan(nama_jabatan) VALUES ('$nama_jabatan')";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_master&act=view");
                }
                break;
            case 'edit_jabatan':
                if (!isset($_POST['edit_jabatan'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_jabatan=$_POST['id_jabatan'];
                    $nama_jabatan=$_POST['nama_jabatan'];
                    $query="UPDATE m_jabatan SET nama_jabatan='$nama_jabatan' WHERE id_jabatan='$id_jabatan'";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_master&act=view");
                }
                break;
            case 'delete_jabatan':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM m_jabatan WHERE id_jabatan='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM m_jabatan WHERE id_jabatan='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        header("Location:?v=v_master&act=view");
                    } else {
                        include '404.php';
                    }
                    $db->close();
                }
                break;
            case 'add_lokasi':
                if (!isset($_POST['add_lokasi'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $nama_lokasi=$_POST['nama_lokasi'];
                    $query="INSERT INTO m_lokasi(nama_lokasi) VALUES ('$nama_lokasi')";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_master&act=view");
                }
                break;
            case 'edit_lokasi':
                if (!isset($_POST['edit_lokasi'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_lokasi=$_POST['id_lokasi'];
                    $nama_lokasi=$_POST['nama_lokasi'];
                    $query="UPDATE m_lokasi SET nama_lokasi='$nama_lokasi' WHERE id_lokasi='$id_lokasi'";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_master&act=view");
                }
                break;
            case 'delete_lokasi':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM m_lokasi WHERE id_lokasi='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM m_lokasi WHERE id_lokasi='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        header("Location:?v=v_master&act=view");
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