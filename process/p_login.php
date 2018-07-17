<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'login':
                if (!isset($_POST['login'])) {
                    include '404.php';
                } else {
                    session_start();
                    require 'config/dbconn.php';
                    $email_pg=$db->real_escape_string($_POST['email']);
                    $password_pg=$db->real_escape_string($_POST['password']);
                    $password_pg=hash('sha512', $password_pg);
                    $query="SELECT * FROM tb_pegawai WHERE email_pg='$email_pg' AND password_pg='$password_pg'";
                    $result=$db->query($query);
                    if ($result->num_rows===1) {
                        $data=$result->fetch_array(MYSQLI_BOTH);
                        $_SESSION['nip']=$data['nip'];
                        if ($data['status_ag']==1) {
                            $_SESSION['level']='admin';
                        } else {
                            $_SESSION['level']='nonadmin';
                        }
                        header("Location:?v=v_home");
                    } else {
                        header("location:login.php");
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