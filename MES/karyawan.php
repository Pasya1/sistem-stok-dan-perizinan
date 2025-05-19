<?php

require 'koneksi.php';



if ($_SESSION['role'] !== 'admin_mes' && $_SESSION['role'] !== 'logistik_mes' && $_SESSION['role'] !== 'legal_mes' && $_SESSION['role'] !== 'supply_mes') {

    header("Location: login.php");

    exit;

}

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="description" content="" />

    <meta name="author" content="" />

    <title>Data Karyawan</title>

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

    .modal-lg {

        max-width: 800px !important; 

    }

    </style>

</head>



<body class="sb-nav-fixed">

    <div id="prelouder"></div>



    <?php include 'nav/navmhg.php'; ?>



    <div id="layoutSidenav">

    <?php include 'nav/sidenavmhg.php'; ?>

        

        <div id="layoutSidenav_content">

            <main>

                <div class="container-fluid">

                    <div class=" mb-4">

                        <div class="">

                            <h1 class="mt-3 text-center mb-4" style="color:#4045AA;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">DATA KARYAWAN</h1>

                            <a href="export/exportkaryawan.php" class="btn btn-info shadow mb-2" style="float: right;"><i class="fas fa-book"></i> Cetak Data Karyawan</a>

                            <button type="button" class="btn btn-custom mx-1 shadow mb-3" data-toggle="modal" data-target="#myModal2" style="float: right;">

                                <i class="fas fa-plus"></i> Tambah Data Karyawan

                            </button>

                        </div>

                        <div class="">

                            <div class="table-responsive shadow-lg px-4 py-5" style="border-radius: 10px;">

                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">

                                    <thead style="background-color: #4045AA; color:white;">

                                        <tr>

                                            <th>Aksi</th>

                                            <th>Foto</th>

                                            <th>Nama Karyawan</th>

                                            <th>Nomor Induk Karyawan</th>

                                            <th>Departemen</th>

                                            <th>No Telepon</th>

                                            <th>No KTP</th>

                                            <th>Alamat</th>

                                            <th>Status Kepegawaian</th>

                                            <th>Keterangan</th>

                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php

                                        $ambilsemuadata = mysqli_query($conn_mes, "select * from karyawan");

                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {

                                            $namakaryawan = $data['namakaryawan'];

                                            $alamat = $data['alamat_karyawan'];

                                            $no_telepon = $data['no_telepon_karyawan'];

                                            $no_ktp = $data['no_ktp'];

                                            $divisi = $data['divisi'];

                                            $idkaryawan = $data['idkaryawan'];

                                            $keterangan = $data['keterangan_karyawan'];

                                            $status = $data['status'];

                                            $nik = $data['nik'];

                                            

                                            $gambar = $data['foto_karyawan'];

                                            if($gambar==null){

                                                $gambar='Tidak Ada Photo';

                                            }else {

                                                $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';

                                            }



                                        ?>



                                            <tr>

                                                <td>

                                                <div class="btn-group">

                                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#4045AA; height:30px; font-size:12px; color:white;">

                                                        <span class="sr-only">Toggle Dropdown</span>

                                                    </button>

                                                        <div class="dropdown-menu">

                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#editkaryawan<?= $idkaryawan; ?>" style="margin-left: 5px; width: 140px; color: white;">

                                                            Edit

                                                        </button>

                                                        <input type="hidden" name="idbarangygingindihapus" value="<?= $idkaryawan; ?>">

                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $idkaryawan; ?>" style="margin-left: 5px; width: 140px;">

                                                        Hapus

                                                        </button>

                                                        <a href="lihat_detail/lihatdetail_karyawan.php?idkaryawan=<?= $idkaryawan; ?>" style="text-decoration: none;">

                                                        <button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" style="margin-left: 5px; width: 140px;">

                                                        Lihat Data

                                                        </button></a>

                                                        </div>

                                                </div>

                                                </td>

                                                <td><a href="lihat_detail/lihatdetail_karyawan.php?idkaryawan=<?= $idkaryawan; ?>"><?= $gambar; ?></a></td>

                                                <td><?= htmlspecialchars($namakaryawan) ?></td>

                                                <td><?= htmlspecialchars($nik) ?></td>

                                                <td><?= htmlspecialchars($divisi) ?></td>

                                                <td><?= htmlspecialchars($no_telepon) ?></td>

                                                <td><?= htmlspecialchars($no_ktp) ?></td>

                                                <td><?= htmlspecialchars($alamat) ?></td>

                                                <td>

                                                    <?php

                                                    if ($status == 'PKWTT') {

                                                        echo '<span style="color: orange;">' . htmlspecialchars($status) . '</span>';

                                                    } elseif ($status == 'PKWT') {

                                                        echo '<span style="color: green;">' . htmlspecialchars($status) . '</span>';

                                                    } elseif ($status == 'HARIAN LEPAS') {

                                                        echo '<span style="color: #12372A;">' . htmlspecialchars($status) . '</span>';

                                                    }

                                                    ?>

                                                </td>

                                                <td><?= htmlspecialchars($keterangan) ?></td>

                

                                            </tr>

                                            <!--Edit Modal -->

                                            <div class="modal fade" id="editkaryawan<?= $idkaryawan; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data Karyawan</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post" enctype="multipart/form-data">

                                                            <div class="modal-body">

                                                                Edit Foto Karyawan :

                                                                <input type="file" name="gambardepan" value="<?= $gambar_depan; ?>" class="form-control"><br>

                                                                Nama Karyawan : <br>

                                                                <input type="text" name="karyawan" value="<?= $namakaryawan; ?>" class="form-control" required><br>

                                                                Nomor Induk Karyawan :

                                                                <input type="text" name="nik" class="form-control" value="<?= $nik; ?>" required><br>

                                                                Departemen :

                                                                <input type="text" name="divisi" value="<?= $divisi; ?>" class="form-control" required><br>

                                                                No Telepon :

                                                                <input type="text" name="no_telepon" value="<?= $no_telepon; ?>" class="form-control"  required><br>

                                                                No KTP :

                                                                <input type="text" name="no_ktp" value="<?= $no_ktp; ?>" class="form-control" required><br>                                                               

                                                                Alamat : 

                                                                <input type="text" name="alamat" value="<?= $alamat; ?>" class="form-control"  required><br>

                                                                Status Kepegawaian : 

                                                                <select name="status" id="status" class="form-control" required>

                                                                    <?php

                                                                    $statuss = ["PKWTT", "PKWT", "HARIAN LEPAS"]; 

                                                                    foreach ($statuss as $statusOption) {

                                                                        $selected = ($statusOption == $status) ? 'selected' : ''; 

                                                                        if ($statusOption == 'PKWTT') {

                                                                            $color = 'orange'; 

                                                                        } elseif ($statusOption == 'PKWT') {

                                                                            $color = 'green';

                                                                        } elseif ($statusOption == 'HARIAN LEPAS') {

                                                                            $color = '#12372A';

                                                                        }

                                                                        echo '<option value="' . $statusOption . '" ' . $selected . ' style="color: ' . $color . ';">' . ucfirst($statusOption) . '</option>';

                                                                    }

                                                                    ?>

                                                                </select><br>

                                                                Keterangan : <br>

                                                                <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" required><br>

                                                                <input type="hidden" name="idkaryawan" value="<?= $idkaryawan; ?>">

                                                                <button type="submit" class="btn btn-custom" name="updatekaryawan" style="float:right;">Submit <i class="fas fa-arrow-circle-right"></i></button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $idkaryawan; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Hapus Data?</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                Apakah Anda yakin ingin menghapus <strong><?= $namakaryawan; ?>?</strong>

                                                                <input type="hidden" name="idkaryawan" value="<?= $idkaryawan; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapuskaryawan">Hapus</button>

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

<div class="modal fade" id="myModal2">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Tambah Data Karyawan</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <form method="post" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">

                            Unggah Foto Karyawan :

                            <input type="file" name="gambardepan" multiple accept="image/*" class="form-control"><br>

                            Nama Lengkap Karyawan :

                            <input type="text" name="karyawan" class="form-control" required><br>

                            Nomor Induk Karyawan :

                            <input type="text" name="nik" class="form-control" required><br>

                            Departemen :

                            <input type="text" name="divisi" class="form-control" required><br>

                            No Telepon :

                            <input type="text" name="no_telepon" class="form-control"  required><br>



                        </div>

                        <div class="col-md-6">

                            No KTP :

                            <input type="text" name="no_ktp" class="form-control" required><br>

                            Alamat : 

                            <input type="text" name="alamat" class="form-control"  required><br>                  

                            Status Kepegawaian : 

                            <select name="status" id="status" class="form-control" required>

                                <option value="">--Pilih--</option>

                                <option value="PKWTT" style="color: orange;">PKWTT</option>

                                <option value="PKWT" style="color: green;">PKWT</option>

                                <option value="HARIAN LEPAS" style="color: #12372A;">HARIAN LEPAS</option>

                            </select><br>

                            Keterangan :

                            <input type="text" name="keterangan" class="form-control" value="-"><br>



                        </div>

                    </div>

                    <button type="submit" class="btn btn-custom form-control" name="addnewkaryawan">Submi <i class="fas fa-arrow-circle-right"></i></button>

                </div>

            </form>



        </div>

    </div>

</div>



</html>



<?php

// Menambah data karyawan dengan prepared statement

if (isset($_POST['addnewkaryawan'])) {

    $karyawan = strtoupper($_POST['karyawan']);

    $divisi = strtoupper($_POST['divisi']);

    $alamat = strtoupper($_POST['alamat']);

    $no_telepon = $_POST['no_telepon'];

    $no_ktp = $_POST['no_ktp'];

    $keterangan = strtoupper($_POST['keterangan']);

    $status = strtoupper($_POST['status']);

    $nik = strtoupper($_POST['nik']);





    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_mes, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username = $rowUsername['username'];



    // Simpan gambar depan

    $gambar_depan = $_FILES['gambardepan'];

    $nama_gambar_depan = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    // Move gambar depan ke direktori yang diinginkan

    move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);



    // Prepared statement untuk INSERT data karyawan

    $query = "INSERT INTO karyawan (`foto_karyawan`, `namakaryawan`, `divisi`, `alamat_karyawan`, `no_telepon_karyawan`, `no_ktp`, `keterangan_karyawan`, `status`, `nik`, `user_edit_karyawan`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn_mes->prepare($query);

    $stmt->bind_param("ssssssssss", $nama_gambar_depan, $karyawan, $divisi, $alamat, $no_telepon, $no_ktp, $keterangan, $status, $nik, $username);



    if ($stmt->execute()) {

        // Operasi berhasil

        echo '<script type="text/javascript">      

                    Swal.fire({

                        position: "center",

                        icon: "success",

                        title: "Data Telah Ditambahkan",

                        showConfirmButton: false,

                        timer: 1500

                    });

                    setTimeout(function () { 

                    window.location.href = "karyawan.php"; 

                    }, 1500);

                    </script>';

    } else {

        // Operasi gagal

        echo 'Gagal';

        header('location:karyawan.php');

    }

    $stmt->close();

}





//Update info

if (isset($_POST['updatekaryawan'])) {

    $idkaryawan = $_POST['idkaryawan'];

    $karyawan = strtoupper($_POST['karyawan']);

    $divisi = strtoupper($_POST['divisi']);

    $alamat = strtoupper($_POST['alamat']);

    $no_telepon = $_POST['no_telepon'];

    $no_ktp = $_POST['no_ktp'];

    $keterangan = strtoupper($_POST['keterangan']);

    $status = strtoupper($_POST['status']);

    $nik = strtoupper($_POST['nik']);



    $role = $_SESSION['role'];



     // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_mes, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username = $rowUsername['username'];



    // Simpan gambar depan

    $gambar_depan = $_FILES['gambardepan']; // Informasi gambar depan

    $nama_gambar_depan = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    if (!empty($nama_gambar_depan)) {

        move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);



        $update_query = "UPDATE karyawan SET foto_karyawan=?, namakaryawan=?, divisi=?, alamat_karyawan=?, no_telepon_karyawan=?, no_ktp=?, keterangan_karyawan=?, nik=?, user_edit_karyawan=?, status=? WHERE idkaryawan=?";

        $stmt = $conn_mes->prepare($update_query);

        $stmt->bind_param("ssssssssssi", $nama_gambar_depan, $karyawan, $divisi, $alamat, $no_telepon, $no_ktp, $keterangan, $nik, $username, $status, $idkaryawan);

    } else {

        $update_query = "UPDATE karyawan SET namakaryawan=?, divisi=?, alamat_karyawan=?, no_telepon_karyawan=?, no_ktp=?, keterangan_karyawan=?, nik=?, user_edit_karyawan=?, status=?  WHERE idkaryawan=?";

        $stmt = $conn_mes->prepare($update_query);

        $stmt->bind_param("sssssssssi", $karyawan, $divisi, $alamat, $no_telepon, $no_ktp, $keterangan, $nik, $username, $status, $idkaryawan);

    }



    if ($stmt->execute()) {

        // Operasi berhasil

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "success",

            title: "Data Telah Diedit",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

            window.location.href = "karyawan.php"; 

        }, 1500);

        </script>';

    } else {

        // Operasi gagal

        echo 'Gagal';

        header('location:karyawan.php');

    }

    $stmt->close();

}



//Hapus 

if (isset($_POST['hapuskaryawan'])) {

    $idkaryawan = $_POST['idkaryawan'];



    $query = "DELETE FROM karyawan WHERE idkaryawan=?";

    $stmt = $conn_mes->prepare($query);

    $stmt->bind_param("i", $idkaryawan);



    if ($stmt->execute()) {

        // Operasi berhasil

        echo '<script type="text/javascript">      

                    Swal.fire({

                        position: "center",

                        icon: "success",

                        title: "Data Berhasil Dihapus",

                        showConfirmButton: false,

                        timer: 1500

                    });

                    setTimeout(function () { 

                    window.location.href = "karyawan.php"; 

                    }, 1500);

                    </script>';

    } else {

        // Operasi gagal

        echo 'Gagal';

        header('location:karyawan.php');

    }

    $stmt->close();

}

?>