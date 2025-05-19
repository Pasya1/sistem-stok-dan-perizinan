<?php

require 'koneksi.php';



?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="description" content="" />

    <meta name="author" content="" />

    <title>Stok Barang</title>

    <link href="css/styles.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="sweetalert2.min.css">

    <style>

        .gambarfoto{

            width:100px;

            

        }

        .gambarfoto:hover{

            transform: scale(1.5);

            transition: 0.5 ease;

        }

   

    .btn-custom {

        background-color: #4045AA; 

        color: #fff; 

        transition: background-color 0.3s ease; 

    }



    .btn-custom:hover {

        opacity : 0.9;

        color: #fff;

    }



    .nav-link.active,

    .nav-link:hover {

        position: relative;

    }





    .nav-link.active::before,

    .nav-link:hover::before {

        content: '';

        position: absolute;

        top: 0;

        bottom: 0;

        left: -20px; 

        width: 4px; 

        background-color: white; 

        border-radius: 0 2px 2px 0; 

    }

    .dropdown-item:hover{

        background-color: #164863;

        color: #fff;

    }

    input[type="text"] {

        text-transform: uppercase;

    }

    </style>

</head>



<body class="sb-nav-fixed">

    <?php

    if ($_SESSION['role'] !== 'admin_mes' && $_SESSION['role'] !== 'logistik_mes') {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "error",

            title: "NOT ACCESS ",

            html: "Maaf, Anda tidak memiliki akses sebagai <strong> ADMIN  </strong> dan <strong> LOGISTIK </strong>. Silahkan lakukan login ulang jika ingin mengakses halaman ini",

            showConfirmButton: true,

            confirmButtonText: "Lanjutkan",

            showCancelButton: true,

            cancelButtonText: "Login Ulang?",

            allowOutsideClick: false,

            reverseButtons: true

        }).then((result) => {

            if (result.isConfirmed) {

                window.location.href = "index.php";

            } else if (result.dismiss === Swal.DismissReason.cancel) {

                window.location.href = "logout.php";

            }

        });

        </script>';



        exit;

    }

    ?>

    <div id="prelouder"></div>



    <?php include 'nav/navmhg.php'; ?>



    <div id="layoutSidenav">

        <?php include 'nav/sidenavmhg.php'; ?>



        <div id="layoutSidenav_content">

            <main>

                <div class="container-fluid">

                    <div class=" mb-4">

                        <div class="" >

                        <h1 class="mt-3 text-center mb-4" style="color:#4045AA;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">STOK BARANG</h1>

                            <a href="export/barangmasuk_keluar.php" class="btn btn-success mb-2 shadow" style="float: right;"><i class="fas fa-history"></i> History</a>
                            <a href="export/export.php" class="btn btn-info  mx-1 mb-2 shadow" style=" float: right;"><i class="fas fa-book"></i> Laporan</a>

                            <button type="button" class="btn btn-custom mb-3 shadow" data-toggle="modal" data-target="#myModal" style="float: right;">

                               <i class="fas fa-plus"></i> Tambah Data

                            </button>

                        </div>

                        <div class="">

                            <div class="table-responsive shadow-lg px-5 py-5" style="border-radius: 10px;">

                            <?php

                            $ambildatastok = mysqli_query($conn_mes, "SELECT * FROM stok WHERE jmlhstok < 1");

                            while ($fetch = mysqli_fetch_array($ambildatastok)) {

                                $barang = $fetch['namabarang'];

                            ?>

                                <div class="alert alert-danger alert-dismissible">

                                    <button type="button" class="close" data-dismiss="alert">&times;</button>

                                    Perhatian! Stok <strong><?= $barang ?></strong> telah habis

                                </div>



                            <?php

                            }

                            ?>

                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">

                                    <thead style="background-color: #4045AA; color:white;">

                                        <tr>

                                            <th>Aksi</th>

                                            <th>No</th>

                                            <th>Gambar</th>

                                            <th>Nama Barang</th>

                                            <th>Stok Saat Ini</th>

                                            <th>Unit</th>

                                            <th>Tanggal Update Stok</th>

                                            <th>Lokasi Penyimpanan</th>

                                            <th>Nama PIC Gudang</th>

                                            <th>Keterangan</th>

                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php

                                        $ambilsemuadata = mysqli_query($conn_mes, "select * from stok s");

                                        $i = 1;

                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {

                                            $namabarang = $data['namabarang'];

                                            $jmlhstok = $data['jmlhstok'];

                                            $unit = $data['unit'];

                                            $update_stok = $data['update_stok'];

                                            $lokasi_penyimpanan = $data['lokasi_penyimpanan'];

                                            $idb = $data['idbarang'];

                                            $keterangan = $data['keterangan'];

                                            $nama_karyawan = $data['namakaryawan'];

                                            $id_karyawan = $data['idkaryawan'];



                                            $gambar = $data['dokumentasi'];

                                            if($gambar==null){

                                                $gambar='Tidak Ada Photo';

                                            }else {

                                                $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';

                                            }



                                            $tanggalupdatestok = TanggalIndo($update_stok);



                                        ?>



                                            <tr>

                                                <td>

                                                <div class="btn-group">

                                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#4045AA; height:30px; font-size:12px; color:white;">

                                                        <span class="sr-only">Toggle Dropdown</span>

                                                    </button>

                                                        <div class="dropdown-menu">

                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#edit<?= $idb; ?>" style="margin-left: 5px; width: 140px; color: white;">

                                                            Edit

                                                        </button>

                                                        <input type="hidden" name="idbarangygingindihapus" value="<?= $idb; ?>">

                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $idb; ?>" style="margin-left: 5px; width: 140px;">

                                                        Hapus

                                                        </button>

                                                        <a href="lihat_detail/lihatdetail_barang.php?id_barang=<?= $idb; ?>" style="text-decoration: none;">

                                                        <button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" style="margin-left: 5px; width: 140px;">

                                                        Lihat Data

                                                        </button></a>

                                                        </div>

                                                </div>

                                                </td>

                                                <td><?= $i++; ?></td>

                                                <td><a href="lihat_detail/lihatdetail_barang.php?id_barang=<?= htmlspecialchars($idb); ?>"><?= $gambar; ?></a></td>

                                                <td><?= htmlspecialchars($namabarang) ?></td>

                                                <td><?= htmlspecialchars($jmlhstok) ?></td>

                                                <td><?= htmlspecialchars($unit) ?></td>

                                                <td><?= htmlspecialchars($tanggalupdatestok) ?></td>

                                                <td><a href="lihat_detail/lihatdetail_barang.php?id_barang=<?= htmlspecialchars($idb); ?>#foto_lokasi"><?= htmlspecialchars($lokasi_penyimpanan) ?></a></td>

                                                <td><?= htmlspecialchars($nama_karyawan) ?></td>

                                                <td><?= htmlspecialchars($keterangan) ?></td>

                                            </tr>

                                            <!--Edit Modal -->

                                            <div class="modal fade" id="edit<?= $idb; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data Barang</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post" enctype="multipart/form-data">

                                                            <div class="modal-body">

                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">

                                                                Edit Gambar Barang :

                                                                <input type="file" name="gambardepan" value="<?= $gambar_depan; ?>" multiple accept="image/*" class="form-control"><br>

                                                                Nama Barang : 

                                                                <input type="text" name="namabarang" value="<?= $namabarang; ?>" class="form-control" required><br>

                                                                Jumlah Stok Saat Ini : 

                                                                <input type="number" name="jmlhstok" value="<?= $jmlhstok; ?>" class="form-control"  required><br>

                                                                Unit :

                                                                <select name="unit" id="unit" class="form-control" required>

                                                                    <?php

                                                                    $units = ["PCS", "ROLL", "PACK", "LUSIN", "KG", "LITER", "GRAM", "TON"]; 

                                                                    foreach ($units as $satuan_bentuk) {

                                                                        $selected = ($satuan_bentuk == $unit) ? 'selected' : ''; 

                                                                        echo '<option value="' . $satuan_bentuk . '" ' . $selected . '>' . ucfirst($satuan_bentuk) . '</option>';

                                                                    }

                                                                    ?>

                                                                </select><br>

                                                                Tanggal Update Stok :

                                                                <input type="date" name="tanggal_update" value="<?= $update_stok; ?>" class="form-control"  required><br>

                                                                Lokasi Penyimpanan :

                                                                <input type="text" name="lokasi_penyimpanan" value="<?= $lokasi_penyimpanan; ?>" class="form-control" required><br>

                                                                <input type="hidden" name="idkaryawan" clas="form-control">

                                                                Nama PIC Gudang:

                                                                <select name="namakaryawan" class="form-control" required>

                                                                    <?php

                                                                        $selected = ($id_karyawan == $id_karyawan) ? 'selected' : ''; 

                                                                        $ambildatakaryawan = mysqli_query($conn_mes, "select * from karyawan ");

                                                                        while ($row = mysqli_fetch_array($ambildatakaryawan)){

                                                                            $nama_karyawan_edit = $row['namakaryawan'];

                                                                            $id_karyawan_edit = $row['idkaryawan'];

                                                                            $selected = ($id_karyawan == $id_karyawan_edit) ? 'selected' : ''; 

                                                                    ?>

                                                                            <option value="<?= $id_karyawan_edit; ?>" <?= $selected; ?>><?= $nama_karyawan_edit; ?></option>

                                                                    <?php

                                                                        }

                                                                    ?>

                                                                </select><br>

                                                                Keterangan :

                                                                <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" valule="-" required><br>

                                                                <button type="submit" class="btn btn-custom" name="updatebarang" style="float: right">Submit <i class="fas fa-arrow-circle-right"></i></button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $idb; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Hapus Barang?</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                Apakah Anda yakin ingin menghapus <strong> <?= $namabarang; ?>?</strong>

                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                        <?php

                                            

                                        };



                                        ?>





                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </main>

            <footer class="py-4 bg-light mt-auto">

                <div class="container-fluid">

                    <div class="d-flex align-items-center justify-content-between small">

                        

                    </div>

                </div>

            </footer>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="js/scripts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <script src="assets/demo/chart-area-demo.js"></script>

    <script src="assets/demo/chart-bar-demo.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

    <script src="assets/demo/datatables-demo.js"></script>



    <script>

        var loader = document.getElementById("prelouder");



        window.addEventListener("load", function() {

            loader.style.display = "none";

        });

        $(document).ready(function() {

            if ($.fn.DataTable.isDataTable('#dataTable')) {

                $('#dataTable').DataTable().destroy(); // Menghancurkan inisialisasi DataTable sebelumnya

            }

            

            $('#dataTable').DataTable({

                "pageLength": 50,

                // Konfigurasi lainnya

            });

        });

    </script>





</body>



<!-- The Modal -->

<div class="modal fade" id="myModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Tambah Data Barang</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <form method="post" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">

                            Unggah Gambar Barang :

                            <input type="file" name="gambardepan" multiple accept="image/*" class="form-control"><br>

                            Nama Barang : 

                            <input type="text" name="namabarang" class="form-control" required><br>

                            Jumlah Stok Saat Ini : 

                            <input type="number" name="jmlhstok" class="form-control"  required><br>

                            Unit :

                            <select name="unit" id="unit" class="form-control" required>

                                <option value="">--Pilih--</option>

                                <option value="PCS">Pcs</option>

                                <option value="ROLL">Roll</option>

                                <option value="PACK">Pack</option>

                                <option value="LUSIN">Lusin</option>

                                <option value="KG">Kilogram (kg)</option>

                                <option value="LITER">Liter (L)</option>

                                <option value="GRAM">Gram (g)</option>

                                <option value="TON">Ton (t)</option>

                            </select><br>



                        </div>

                        <div class="col-md-6">

                            Tanggal Update Stok :

                            <input type="date" name="tanggal_update" class="form-control"  required><br>

                            Lokasi Penyimpanan :

                            <input type="text" name="lokasi_penyimpanan" class="form-control" required><br>

                            <input type="hidden" name="idkaryawan" clas="form-control">

                            Nama PIC Gudang:

                            <div class="input-group">

                                <select name="namakaryawan" class="form-control" required>

                                    <option value="">--Pilih--</option>

                                    <?php

                                        $ambildatakaryawan = mysqli_query($conn_mes, "select * from karyawan ");

                                        while ($row = mysqli_fetch_array($ambildatakaryawan)){

                                            $nama_karyawan = $row['namakaryawan'];

                                            $id_karyawan = $row['idkaryawan'];

                                    ?>

                                        <option value="<?= $id_karyawan; ?>"><?= $nama_karyawan; ?></option>

                                    <?php

                                    }

                                    ?>

                                </select>

                                <a href="karyawan.php" class="input-group-text"><b>+</b></a>

                            </div>

                            <br>

                            Keterangan :

                            <input type="text" name="keterangan" class="form-control" value="-"><br>



                        </div>

                    </div>

                    <button type="submit" class="btn btn-custom form-control" name="addnewbarang" id="btn">Submit <i class="fas fa-arrow-circle-right"></i></button>

                </div>

            </form>



        </div>

    </div>

</div>



</html>



<?php

//menambah barang baru

if (isset($_POST['addnewbarang'])) {

    $namabarang = strtoupper($_POST['namabarang']);

    $jmlhstok = $_POST['jmlhstok'];

    $tanggal_update = $_POST['tanggal_update']; 

    $lokasi_penyimpanan = strtoupper($_POST['lokasi_penyimpanan']);

    $keterangan = strtoupper($_POST['keterangan']);

    $id_karyawan = $_POST['namakaryawan'];

    $unit =  strtoupper($_POST['unit']); 



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_mes, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username = $rowUsername['username'];



    $gambar_depan = $_FILES['gambardepan']; // Informasi gambar depan

    $nama_gambar_depan = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    $query_get_nama = $conn_mes->prepare("SELECT namakaryawan FROM karyawan WHERE idkaryawan = ?");

    $query_get_nama->bind_param("i", $id_karyawan);

    $query_get_nama->execute();

    $result = $query_get_nama->get_result();

    $row = $result->fetch_assoc();

    $nama_karyawan = $row['namakaryawan'];

    $query_get_nama->close();



    move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);



    $check_existing_name = $conn_mes->prepare("SELECT COUNT(*) AS total FROM stok WHERE namabarang = ?");

    $check_existing_name->bind_param("s", $namabarang);

    $check_existing_name->execute();

    $result_name = $check_existing_name->get_result();

    $row_name = $result_name->fetch_assoc();

    $total_names = $row_name['total'];

    $check_existing_name->close();



    if ($total_names > 0) {

        echo '<script type="text/javascript">      

                    Swal.fire({

                        position: "center",

                        icon: "error",

                        title: "Nama Barang Sudah Ada",

                        showConfirmButton: false,

                        timer: 1500

                    });

                    setTimeout(function () { 

                    window.location.href = "barang.php"; 

                    }, 1500);

                    </script>';

        exit(); 

    }



    $addtotable = $conn_mes->prepare("INSERT INTO stok (`idbarang`, `namabarang`, `jmlhstok`, `unit`, `dokumentasi`, `update_stok`, `lokasi_penyimpanan`, `keterangan`, `idkaryawan`, `namakaryawan`, `user_edit_barang`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $addtotable->bind_param("sissssssss", $namabarang, $jmlhstok, $unit, $nama_gambar_depan, $tanggal_update, $lokasi_penyimpanan, $keterangan, $id_karyawan, $nama_karyawan, $username);

    $addtotable_result = $addtotable->execute();



    if ($addtotable_result) {

        echo '<script type="text/javascript">      

                        Swal.fire({

                            position: "center",

                            icon: "success",

                            title: "Data Telah Ditambahkan",

                            showConfirmButton: false,

                            timer: 1500

                        });

                        setTimeout(function () { 

                        window.location.href = "barang.php"; 

                        }, 1500);

                        </script>';

    } else {

        echo 'Gagal';

        header('location:barang.php');

    }

    $addtotable->close();

}

?>



<?php

//Update info barang

if (isset($_POST['updatebarang'])) {

    $idb = $_POST['idb'];

    $namabarang = strtoupper($_POST['namabarang']);

    $jmlhstok = $_POST['jmlhstok'];

    $tanggal_update = $_POST['tanggal_update']; 

    $lokasi_penyimpanan = strtoupper($_POST['lokasi_penyimpanan']);

    $keterangan = strtoupper($_POST['keterangan']);

    $id_karyawan = $_POST['namakaryawan'];

    $unit =  strtoupper($_POST['unit']); 



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_mes, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username = $rowUsername['username'];



    // Query to get the employee name based on employee ID

    $query_get_nama = $conn_mes->prepare("SELECT namakaryawan FROM karyawan WHERE idkaryawan = ?");

    $query_get_nama->bind_param("i", $id_karyawan);

    $query_get_nama->execute();

    $result = $query_get_nama->get_result();

    $row = $result->fetch_assoc();

    $nama_karyawan = $row['namakaryawan'];

    $query_get_nama->close();



    $gambar_depan = $_FILES['gambardepan']; // Front image information

    $nama_gambar_depan = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    // Move the front image to the desired directory

    move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);



    $update_statement = "";

    $update_params = array();



    if ($nama_gambar_depan == NULL) {

        $update_statement = "UPDATE stok SET namabarang=?, jmlhstok=?, update_stok=?, unit=?, lokasi_penyimpanan=?, idkaryawan=?, keterangan=?, namakaryawan=?, user_edit_barang=? WHERE idbarang=?";

        $update_params = array($namabarang, $jmlhstok, $tanggal_update, $unit, $lokasi_penyimpanan, $id_karyawan, $keterangan, $nama_karyawan, $username, $idb);

    } else {

        $update_statement = "UPDATE stok SET namabarang=?, dokumentasi=?, jmlhstok=?, unit=?, update_stok=?, lokasi_penyimpanan=?, idkaryawan=?, keterangan=?, namakaryawan=?, user_edit_barang=? WHERE idbarang=?";

        $update_params = array($namabarang, $nama_gambar_depan, $jmlhstok, $unit, $tanggal_update, $lokasi_penyimpanan, $id_karyawan, $keterangan, $nama_karyawan, $username, $idb);

    }



    // Prepare and execute the update query using prepared statement

    $update_query = $conn_mes->prepare($update_statement);

    if ($update_query) {

        // Dynamically bind parameters based on the update scenario

        $types = str_repeat('s', count($update_params));

        $update_query->bind_param($types, ...$update_params);

        $update_result = $update_query->execute();

        $update_query->close();



        if ($update_result) {

            echo '<script type="text/javascript">      

            Swal.fire({

                position: "center",

                icon: "success",

                title: "Data Telah Diedit",

                showConfirmButton: false,

                timer: 1500

            });

            setTimeout(function () { 

            window.location.href = "barang.php"; 

            }, 1500);

            </script>';

        } else {

            echo 'Gagal';

            header('location:barang.php');

        }

    } else {

        echo 'Gagal';

        header('location:barang.php');

    }

}







//Hapus barang

if (isset($_POST['hapusbarang'])) {

    $idb = $_POST['idb'];



    // Prepare and execute the delete query using a prepared statement

    $delete_query = $conn_mes->prepare("DELETE FROM stok WHERE idbarang = ?");

    $delete_query->bind_param("i", $idb);

    $delete_result = $delete_query->execute();

    $delete_query->close();



    if ($delete_result) {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "success",

            title: "Data Telah Dihapus",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

        window.location.href = "barang.php"; 

        }, 1500);

        </script>';

    } else {

        echo 'Gagal';

        header('location:barang.php');

    }

}





//fungsi tanngal masuk

function InputTgl($tanggal)

{

    $pisah = explode('/', $tanggal);

    $lari = array($pisah[2], $pisah[1], $pisah[0]);

    $satukan = implode("-", $lari);



    return $satukan;

}

//fungsi edit tanngal masuk

function EditTgl($tanggal)

{

    $pisah = explode('/', $tanggal);

    $lari = array($pisah[2], $pisah[1], $pisah[0]);

    $satukan = implode("-", $lari);



    return $satukan;

}

//agar berurutan tanggalnya dan muncul bulannya

function TanggalIndo($tgl)

{

    $tanggal = substr($tgl, 8, 2);

    $bulan = Bulan(substr($tgl, 5, 2));

    $tahun = substr($tgl, 0, 4);



    return $tanggal . " " . $bulan . " " . $tahun;

}



function Bulan($bln)

{

    if ($bln == "01") {

        return "Januari";

    } elseif ($bln == "02") {

        return "Februari";

    } elseif ($bln == "03") {

        return "Maret";

    } elseif ($bln == "04") {

        return "April";

    } elseif ($bln == "05") {

        return "Mei";

    } elseif ($bln == "06") {

        return "Juni";

    } elseif ($bln == "07") {

        return "Juli";

    } elseif ($bln == "08") {

        return "Agustus";

    } elseif ($bln == "09") {

        return "September";

    } elseif ($bln == "10") {

        return "Oktober";

    } elseif ($bln == "11") {

        return "November";

    } elseif ($bln == "12") {

        return "Desember";

    }

}

?>