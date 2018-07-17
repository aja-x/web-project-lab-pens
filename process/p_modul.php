<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'add':
                if (!isset($_POST['add_modul'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    require 'config/upconn.php';

                    $id_modul=$_POST['id_modul'];
                    $id_matkul=$_POST['id_matkul'];
                    // $id_uploader=$_SESSION['nip'];
                    $id_uploader=2110171010;
                    $tglupl_modul=date('Y-m-d H:i:s');
                    $nama_modul=$_POST['nama_modul'];
                    
                    $fileName=$_FILES['file_modul']['name'];
                    $tmpName=$_FILES['file_modul']['tmp_name'];
                    $fileSize=$_FILES['file_modul']['size'];
                    $fileType=$_FILES['file_modul']['type'];
                    $ext=substr(strrchr($fileName, "."), 1);
                    
                    $randName=md5(rand()*time());
                    $filePath=$path_modul.$randName.'.'.$ext;
                    $result=move_uploaded_file($tmpName, $filePath);
                    
                    if(!$result){
                        echo "Error uploading file";
                        exit;
                    }

                    if(!get_magic_quotes_gpc()) 
                    {
                        $fileName=addslashes($fileName);
                        $filePath=addslashes($filePath);
                    }
                    $query="INSERT INTO tb_modulkuliah VALUES ('$id_modul', '$id_matkul', '$id_uploader', '$nama_modul', '$tglupl_modul', '$fileName', '$fileType', '$fileSize', '$filePath')";
                    try {
                        $db->query($query);
                    } catch (Exeption $e) {
                        echo $e->error;
                    }
                    $db->close();
                    header("Location:?v=v_modul&act=view");
                }
                break;
            case 'download':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_modulkuliah WHERE id_modul='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $data=$result->fetch_array(MYSQLI_BOTH);
                        $nama_modul=str_replace(" ","_", $data['nama_modul']).".pdf";
                        $filesize_modul=$data['filesize_modul'];
                        $filetype_modul=$data['filetype_modul'];
                        $filepath_modul=$data['filepath_modul'];

                        header("Content-Disposition: attachment; filename=$nama_modul");
                        header("Content-length: $filesize_modul"); 
                        header("Content-type: $filetype_modul"); 
                        readfile($filepath_modul);
                        header("Location:?v=v_modul&act=view");
                    } else {
                        include '404.php';
                    }
                    $db->close();
                }
                break;
            case 'delete':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_modulkuliah WHERE id_modul='$id'";
                    $result=$db->query($query);
                    if($result->num_rows===1) {
                        $data=$result->fetch_array(MYSQLI_BOTH);
                        $query="DELETE FROM tb_modulkuliah WHERE id_modul='$id'";
                        try {
                            $db->query($query);
                        } catch (Exeption $e) {
                            echo $e->error;
                        }
                        unlink($data['filepath_modul']);
                        header("Location:?v=v_modul&act=view");
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