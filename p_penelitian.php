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
            case 'add_jn':
             if (!isset($_POST['add_jn'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    require 'config/upconn.php';
                    $id_pn=$_POST['id_pn'];
                    $id_jn=$_POST['id_jn'];
                    $nama_jn=$_POST['nama_jn'];
                    $tglupl_jn=$_POST['tglupl_jn'];

                    $fileName=$_FILES['file_jn']['name'];
                    $tmpName=$_FILES['file_jn']['tmp_name'];
                    $fileSize=$_FILES['file_jn']['size'];
                    $fileType=$_FILES['file_jn']['type'];
                    $ext=substr(strrchr($fileName, "."), 1);

                    $randName=md5(rand()*time());
                    $filePath=$path_jurnal.$randName.'.'.$ext;
                    $result=move_uploaded_file($tmpName, $filePath);

                    if(!$result){
                        echo "Error uploude file";
                        exit;
                    }

                   
                    $query="INSERT INTO tb_jurnal  VALUES ('$id_jn','$id_pn','$nama_jn','$tglupl_jn','$fileType','$fileSize','$filePath','$fileName')";
                      try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_penelitian&act=view");
                
                }
                break;

            case 'download_jn':
                 if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    require 'config/upconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_jurnal WHERE id_jn='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $data=$result->fetch_array(MYSQLI_BOTH);
                        $nama_jn=str_replace(" ","_", $data['nama_jn']).".pdf";
                        $filesize_jn=$data['filesize_jn'];
                        $filetype_jn=$data['filetype_jn'];
                        $filepath_jn=$data['filepath_jn'];

                        header("Content-Disposition: attachment; filename=$nama_jn");
                        header("Content-length: $filesize_jn"); 
                        header("Content-type: $filetype_jn"); 
                        readfile($filepath_jurnal);
                       
                    } else {
                        include '404.php';
                    }
                    $db->close();

                }
                break;
                   case 'delete_jn':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_jurnal WHERE id_jn='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $query="DELETE FROM tb_jurnal WHERE id_jn='$id'";
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