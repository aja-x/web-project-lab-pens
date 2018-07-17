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
                    $id_lab=$_POST['id_lab'];
                    $id_pengajar=$_POST['id_pengajar'];
                    $kelas_jw=$_POST['kelas_jw'];
                    $angkatan_jw=$_POST['angkatan_jw'];
                    $kelas_jw=$kelas_jw." ".$angkatan_jw;
                    $semester_jw=$_POST['semester_jw'];
                    $tahun_jw=$_POST['tahun_jw'];
                    $time_jw=$_POST['time_jw'];
                    $time_akhir_jw=$_POST['time_akhir_jw'];
                    $tgl_jw=$tahun_jw."-01-01 ".$time_jw.":00";

                    $query="INSERT INTO tb_lab_jadwal(id_lab, id_pengajar, kelas_jw, semester_jw, tgl_jw, jam_akhir_jw) VALUES ('$id_lab','$id_pengajar', '$kelas_jw', '$semester_jw', '$tgl_jw', '$time_akhir_jw')";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_jadwal&act=detail&id=$id_lab");
                }
                break;
            case 'edit':
                if (!isset($_POST['edit_jw'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id_jw=$_POST['id_jadwal'];
                    $id_lab=$_POST['id_lab'];
                    $id_pengajar=$_POST['id_pengajar'];
                    $kelas_jw=$_POST['kelas_jw'];
                    $angkatan_jw=$_POST['angkatan_jw'];
                    $kelas_jw=$kelas_jw." ".$angkatan_jw;
                    $semester_jw=$_POST['semester_jw'];
                    $tahun_jw=$_POST['tahun_jw'];
                    $time_jw=$_POST['time_jw'];
                    $time_akhir_jw=$_POST['time_akhir_jw'];
                    $tgl_jw=$tahun_jw."-01-01 ".$time_jw.":00";

                    $query="UPDATE tb_lab_jadwal SET id_lab='$id_lab', id_pengajar='$id_pengajar', kelas_jw='$kelas_jw', semester_jw='$semester_jw', tgl_jw='$tgl_jw', jam_akhir_jw='$time_akhir_jw' WHERE id_jw='$id_jw'";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_jadwal&act=detail&id=$id_lab");
                }
                break;
            case 'delete':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_lab_jadwal WHERE id_jw='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM tb_lab_jadwal WHERE id_jw='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        header("Location:?v=v_jadwal&act=view");
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