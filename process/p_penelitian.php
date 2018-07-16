<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'add':
                if (!isset($_POST['add_penelitian'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_pn=$_POST['id_pn'];
                    $nama_pn=$_POST['nama_pn'];
                    $tgl_mulai_pn=$_POST['tgl_mulai_pn'];
                    $tgl_selesai_pn=$_POST['tgl_selesai_pn'];
                    $nip=$_POST['nip'];
                    $query1="INSERT INTO tb_penelitian VALUES ('$id_pn', '$nama_pn', '$tgl_masuk_pn','$tgl_selesai_pn')";
                    try {
                        $db->query($query1);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                     $query2="INSERT INTO tb_penelitian_anggota VALUES ('$id_pn', '$nip', 'Ketua')";
                    try {
                        $db->query($query2);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_penelitian&act=view");
                }
                break;
            case 'edit':
                if (!isset($_POST['edit_penelitian'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_pn=$_POST['id_pn'];
                    $nama_pn=$_POST['nama_pn'];
                    $tgl_mulai_pn=$_POST['tgl_mulai_pn'];
                    $tgl_selesai_pn=$_POST['tgl_selesai_pn'];
                    $query="UPDATE tb_penelitian SET nama_pn='$nama_pn', tgl_mulai_pn='$tgl_mulai_pn',tgl_selesai_pn='$tgl_selesai_pn' WHERE id_pn='$id_pn'";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_penelitian&act=view");
                }
                break;
            case 'delete':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_penelitian WHERE id_pn='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM tb_penelitian WHERE id_pn='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        header("Location:?v=v_penelitian&act=view");
                    } else {
                        include '404.php';
                    }
                    $db->close();
                }
                break;
            case 'tmbaggt':
             if (!isset($_POST['add_agt_penelitian'])) {
                    include '404.php';
                } else {
                 require 'config/dbconn.php';
                    $id_pn=$_POST['id_pn'];
                    $nip=$_POST['nip'];
                    $jabatan_pn=$_POST['jabatan_pn'];
                    $query="INSERT INTO tb_penelitian_anggota VALUES ('$id_pn','$nip','$jabatan_pn')";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_penelitian&act=view");
                }
                break;
             case 'editagt':
                if (!isset($_POST['edit_agt_penelitian'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_pn=$_POST['id_pn'];
                    $nip=$_POST['nip'];
                    $jabatan_pn=$_POST['jabatan_pn'];
                    $query="UPDATE tb_penelitian_anggota SET nip='$nip', jabatan_pn='$jabatan_pn' WHERE id_pn='$id_pn'";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_penelitian&act=view");
                }
                 break;
            case 'deleteagt':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_penelitian_anggota WHERE nip='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM tb_penelitian_anggota WHERE nip='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        header("Location:?v=v_penelitian&act=view");
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