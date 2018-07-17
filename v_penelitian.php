<?php
    if (!isset($_GET['act'])) {
        include '404.php';
    } else {
        $page=$_GET['act'];
        switch ($page) {
            case 'view':
?>
                <a href="?v=v_penelitian&act=add"><button class="btn btn-primary">Tambah penelitian </button></a><br><br>
<?php
                require 'config/dbconn.php';
                $query="SELECT * FROM tb_penelitian JOIN tb_penelitian_anggota ON tb_penelitian.id_pn=tb_penelitian_anggota.id_pn JOIN tb_pegawai ON tb_penelitian_anggota.nip=tb_pegawai.nip WHERE tb_penelitian_anggota.jabatan_pn='ketua'";
                $result=$db->query($query);
                if ($result->num_rows > 0) {
?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID Penelitian</th>
                            <th>Nama Penelitian</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Ketua</th>
                        </tr>
                    </thead>
                    <tbody>
<?php

                    while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?> 
                        <tr>
                            <td><?php echo $data['id_pn']; ?></td>
                            <td><?php echo $data['nama_pn']; ?></td>
                            <td><?php echo $data['tgl_mulai_pn']; ?></td>
                            <td><?php echo $data['tgl_selesai_pn']; ?></td>
                            <td><?php echo $data['nama_pg']; ?></td>

                            <td>
                                <a href="?v=v_penelitian&act=detail&id=<?php echo $data['id_pn']; ?>"><button class="btn btn-success">Detail</button></a>
                                <a href="?v=v_penelitian&act=edit&id=<?php echo $data['id_pn']; ?>"><button class="btn btn-danger">Edit</button></a>
                            </td>
                        </tr>
<?php
                    }
?> 
                    </tbody>
                </table>
<?php

                } else {
                    echo "Data not found<br>";
                }
                $db->close();
                break;
            case 'add':
            $id=autoID('PN','tb_penelitian', 'id_pn');
?>
                <form action="?p=p_penelitian&act=add" method="post">
                    ID Penelitian: <input type="text" name="id_pn"><br>
                    Nama Penelitian: <input type="text" name="nama_pn"><br>
                    Tanggal Mulai Penelitian: <input type="date" name="tgl_mulai_pn"><br>
                    Tanggal Selesai Penelitian: <input type="date" name="tgl_selesai_pn"><br>
                    Nama Ketua :
                     <select name="nip">
                            <?php
                                require 'config/dbconn.php';
                                $query="SELECT nip,nama_pg FROM tb_pegawai";
                                $result=$db->query($query);
                                while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                    echo "<option value='".$data[0]."'>".$data[1]."</option>";
                                }
                                $db->close();
                            ?>
                        </select><br>

                    <a href="?v=v_penelitian&act=view" class="btn btn-danger">Batal</a>
                    <button type="reset">Reset</button>
                    <button type="submit" name="add_penelitian">Tambah</button>
                </form>
<?php
                break;
            case 'edit':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_penelitian WHERE id_pn='$id'";
                    $result=$db->query($query);
                    if ($result->num_rows != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                        <form action="?p=p_penelitian&act=edit" method="post"><br>
                            ID penelitian: <input type="text" name="id_pn" value="<?php echo $data['id_pn']; ?>"><br>
                            Nama Penelitian: <input type="text" name="nama_pn" value="<?php echo $data['nama_pn']; ?>"><br>
                            Tanggal Mulai Penelitian: <input type="date" name="tgl_mulai_pn" value="<?php echo $data['tgl_mulai_pn']; ?>"><br>
                            Tanggal Selesai Penelitian: <input type="date" name="tgl_selesai_pn" value="<?php echo $data['tgl_selesai_pn']; ?>"><br>
                            <a href="?v=v_penelitian&act=view" class="btn btn-danger">Batal</a>
                            <button type="submit" name="edit_penelitian">Edit</button>
                        </form>
<?php
                    }
                }
                break;
?>
<?php
            
            case 'detail':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_pegawai JOIN tb_penelitian_anggota ON tb_penelitian_anggota.nip=tb_pegawai.nip JOIN tb_penelitian ON tb_penelitian.id_pn=tb_penelitian_anggota.id_pn WHERE tb_penelitian_anggota.id_pn='$id' AND tb_penelitian_anggota.jabatan_pn='ketua'";
                    $result=$db->query($query);
                    if ($result->num_rows  != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?> 
                    <!-- <a href="?v=v_lab&act=add"><button class="btn btn-primary">Tambah Lab</button></a><br><br> -->
                    <h3>Detail Penelitian </h3>
                    <div class="container col-lg-12">
                        <div class="col-lg-12">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>ID Penelitian</th>
                                    <td>: </td>
                                    <td><?php echo $data['id_pn']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Penelitian</th>
                                    <td>: </td>
                                    <td><?php echo $data['nama_pn']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Mulai Penelitian</th>
                                    <td>: </td>
                                    <td><?php echo $data['tgl_mulai_pn']; ?></td>
                                </tr>
                                 <tr>
                                    <th>Tanggal Selesai Penelitian</th>
                                    <td>: </td>
                                    <td><?php echo $data['tgl_selesai_pn']; ?></td>
                                </tr>
                                  <tr>
                                    <th>Ketua Penelitian</th>
                                    <td>: </td>
                                    <td><?php echo $data['nama_pg']; ?></td>
                                </tr>

                            </table>
                            <a href="?v=v_penelitian&act=edit&id=<?php echo $data['id_pn']; ?>"><button class="btn btn-success">Edit</button></a>
                            <a href="?p=p_penelitian&act=delete&id=<?php echo $data['id_pn']; ?>"><button class="btn btn-danger">Delete</button></a>
                        </div>
                    </div>
                    <div class="container col-lg-12">
                        <h4>Anggota Penelitian</h4>
                         <a href="?v=v_penelitian&act=tmbaggt&id=<?php echo $data['id_pn']; ?>"><button class="btn btn-primary">TambahAnggota penelitian </button></a><br><br>
<?php
                        require 'config/dbconn.php';
                        $query="SELECT * FROM tb_pegawai JOIN tb_penelitian_anggota ON tb_penelitian_anggota.nip=tb_pegawai.nip WHERE tb_penelitian_anggota.id_pn='$id' AND tb_penelitian_anggota.jabatan_pn='Anggota'";
                        $result=$db->query($query);
                        if ($result->num_rows > 0) {
?>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>TTL</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No. Telp</th>
                                        <th>Email</th>
                                        <th>Jabatan Peneliti</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?>
                                            <tr>
                                                <td><?php echo $data['nip']; ?></td>
                                                <td><?php echo $data['nama_pg']; ?></td>
                                                <td><?php echo $data['alamat_pg']; ?></td>
                                                <td><?php echo $data['tmp_lahir_pg'].", ".convDateDMY($data['tgl_lahir_pg']); ?></td>
                                                <td><?php if ($data['jk_pg']=='l') {echo "Laki-laki";} else {echo "Perempuan";} ?>
                                                <td><?php echo $data['no_telp_pg']; ?></td>
                                                <td><?php echo $data['email_pg']; ?></td>
                                                <td><?php echo $data['jabatan_pn']; ?></td>
                                                <td>
                                                    <a href="?v=v_penelitian&act=editagt&id=<?php echo $data['nip']; ?>"><button class="btn btn-success">Edit</button></a>
                                                    <a href="?p=p_penelitian&act=deleteagt&id=<?php echo $data['nip']; ?>"><button class="btn btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
<?php
                                    }
?>
                                </tbody>
                            </table>
<?php
                        } else {
                            echo "Data not found<br>";
                        }
?>
                    <h4>Jurnal Penelitian</h4>
                         <a href="?v=v_penelitian&act=tmbjnrl&id=<?php echo $data['id_pn']; ?>"><button class="btn btn-primary">Tambah Jurnal </button></a><br><br>
<?php
                        require 'config/dbconn.php';
                        $query="SELECT * FROM tb_jurnal JOIN tb_penelitian ON tb_penelitian.id_pn=tb_jurnal.id_pn WHERE tb_penelitian.id_pn='$id'";
                        $result=$db->query($query);
                        if ($result->num_rows > 0) {
?>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                            
                                        <th>ID Jurnal</th>
                                        <th>ID Peneliti</th>
                                        <th>Nama Jurnal </th>
                                        <th>Tanggal Uploud Jurnal</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    while ($data=$result->fetch_array(MYSQLI_BOTH)) {
?>
                                            <tr>
                                                <td><?php echo $data['id_jn']; ?></td>
                                                <td><?php echo $data['id_pn']; ?></td>
                                                <td><?php echo $data['nama_jn']; ?></td>
                                                <td><?php echo $data['tglupl_jn']?></td>
                                                <td>
                                                    <a href="?p=p_penelitian&act=download_jn&id=<?php echo $data['id_jn']; ?>"><button class="btn btn-success">Download</button></a>
                                                    <a href="?p=p_penelitian&act=delete_jn&id=<?php echo $data['id_jn']; ?>"><button class="btn btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
<?php
                                    }
?>
                                </tbody>
                            </table>
<?php
                        } else {
                            echo "Data not found<br>";
                        }
                         $db->close();
?>


                       
                    </div>
                    </div>
<?php
                    }
                }
                  break; 
?>
<?php   
           
            case 'tmbaggt':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                 require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query=" SELECT * FROM tb_penelitian_anggota WHERE id_pn='$id'";
                    $result=$db->query($query);
                     if ($result->num_rows < 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                        <form action="?p=p_penelitian&act=tmbaggt" method="post"><br>
                            ID penelitian: <input type="text" name="id_pn" value="<?php echo $data['id_pn']; ?>"><br>
                             Jabatan Peneliti: <input type="text" name="jabatan_pn" value="Anggota"><br>
                            Nama Anggota:
                         <select name="nip">
                            <?php
                                require 'config/dbconn.php';
                                $query="SELECT * FROM tb_pegawai";
                                $result=$db->query($query);
                                while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                    echo "<option value='".$data[0]."'>".$data[1]."</option>";
                                }
                                $db->close();
                            ?>
                        </select><br>
                           
                            <a href="?v=v_penelitian&act=view" class="btn btn-danger">Batal</a>
                              <button type="submit" name="add_agt_penelitian">Tambah</button>
                        </form>               
<?php
            }   
        }
            break;
?>
<?php
            case 'editagt':
                if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                    require 'config/dbconn.php';
                    $id=$_GET['id'];
                    $query="SELECT * FROM tb_penelitian_anggota WHERE nip='$id'";
                    $result=$db->query($query);
                    if ($result->num_rows != 1) {
                        include '404.php';
                    } else {
                        $data=$result->fetch_array(MYSQLI_BOTH);
?>
                        <form action="?p=p_penelitian&act=editagt" method="post"><br>
                            ID penelitian: <input type="text" name="id_pn" value="<?php echo $data['id_pn']; ?>"><br>
                            Jabatan Peneliti: <input type="text" name="jabatan_pn" value="<?php echo $data['jabatan_pn']; ?>"><br>
                            NAma Peneliti <select name="nip">
                            <?php
                                require 'config/dbconn.php';
                                $query="SELECT * FROM tb_pegawai JOIN tb_penelitian_anggota ON tb_penelitian_anggota.nip=tb_pegawai.nip WHERE  tb_penelitian_anggota.jabatan_pn='Anggota'";
                                $result=$db->query($query);
                                while ($data=$result->fetch_array(MYSQLI_BOTH)) {
                                    echo "<option value='".$data[0]."'>".$data[1]."</option>";
                                }
                                $db->close();
                            ?>
                        </select><br>
                           
                            <a href="?v=v_penelitian&act=view" class="btn btn-danger">Batal</a>
                            <button type="submit" name="edit_agt_penelitian">Edit</button>
                        </form>
<?php
                    }
                }
                break;
?>
<?php
                case 'tmbjnrl':
                $id=autoID('JN', 'tb_jurnal', 'id_jn');
                 if (!isset($_GET['id'])) {
                    include '404.php';
                } else {
                $id2=$_GET['id'];
?>
                 <form action="?p=p_penelitian&act=add_jn" method="post" enctype="multipart/form-data" >
                  ID Penelitian: <input type="text" name="id_pn" value="<?php echo "$id2";?>" readonly ><br>
                  ID Jurnal: <input type="text" name="id_jn" value="<?php echo $id; ?>" required readonly><br>
                  Nama Jurnal: <input type="text" name="nama_jn"><br>
                  Tanggal Uploud Jurnal: <input type="date" name="tglupl_jn"><br>
                  Pilih file (.pdf): <input type="file" name="file_jn" accept=".pdf" required>
                 <a href="?v=v_penelitian&act=view" class="btn btn-danger">Batal</a>
                    <button type="reset">Reset</button>
                 <button type="submit" name="add_jn">Tambah</button>

<?php
                }
                    break;
?>
<?php

            default:
                include '404.php';
                break;
        }
    }
?> 

