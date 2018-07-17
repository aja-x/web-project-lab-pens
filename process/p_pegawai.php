<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'add':
                if (!isset($_POST['add_pg'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $nip=$_POST['nip'];
                    $nama_pg=$_POST['nama_pg'];
                    $alamat_pg=$_POST['alamat_pg'];
                    $tgl_lahir_pg=convdateYMD($_POST['tgl_lahir_pg']);
                    $tmp_lahir_pg=$_POST['tmp_lahir_pg'];
                    $no_telp_pg=$_POST['no_telp_pg'];
                    $email_pg=$_POST['email_pg'];
                    $jk_pg=$_POST['jk_pg'];
                    $id_lab=$_POST['id_lab'];
                    $id_jabatan=$_POST['id_jabatan'];
                    $password_ag=hash('sha512', '12345');
                    $status_ag=0;
                    $query="INSERT INTO tb_pegawai VALUES ('$nip', '$nama_pg', '$alamat_pg', '$tgl_lahir_pg', '$tmp_lahir_pg', '$no_telp_pg', '$email_pg', '$jk_pg', '$id_lab', '$id_jabatan', '$password_ag', '$status_ag')";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_pegawai&act=view");
                }
                break;
            case 'edit':
                if (!isset($_POST['edit_pg'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $nip=$_POST['nip'];
                    $nama_pg=$_POST['nama_pg'];
                    $alamat_pg=$_POST['alamat_pg'];
                    $tgl_lahir_pg=convdateYMD($_POST['tgl_lahir_pg']);
                    $tmp_lahir_pg=$_POST['tmp_lahir_pg'];
                    $no_telp_pg=$_POST['no_telp_pg'];
                    $email_pg=$_POST['email_pg'];
                    $jk_pg=$_POST['jk_pg'];
                    $id_lab=$_POST['id_lab'];
                    $id_jabatan=$_POST['id_jabatan'];
                    $query="UPDATE tb_pegawai SET nip='$nip', nama_pg='$nama_pg', alamat_pg='$alamat_pg', tgl_lahir_pg='$tgl_lahir_pg', tmp_lahir_pg='$tmp_lahir_pg', no_telp_pg='$no_telp_pg', email_pg='$email_pg', jk_pg='$jk_pg', id_lab='$id_lab', id_jabatan='$id_jabatan' WHERE nip='$nip'";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_pegawai&act=view");
                }
                break;
            case 'delete':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_pegawai WHERE nip='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM tb_pegawai WHERE nip='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        header("Location:?v=v_pegawai&act=view");
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