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

    <title>Hasil Audit</title>

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

        background-color: #427D9D; 

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

    textarea{

        text-transform: uppercase;

    }

    

    .bgdanger {

    background-color: rgba(255, 0, 0, 0.3); 

    }

    .bgwarning {

    background-color: rgba(255, 255, 0, 0.3); 

    }

    .bgputih {

    background-color: #fff; 

    }

    .modal-lg {

        max-width: 800px !important; 

    }

    </style>

</head>



<body class="sb-nav-fixed">

    <?php

    if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'legal') {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "error",

            title: "NOT ACCESS ",

            html: "Maaf, Anda tidak memiliki akses sebagai <strong> ADMIN  </strong> dan <strong> LEGAL </strong>. Silahkan lakukan login ulang jika ingin mengakses halaman ini",

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

                        <div class="">

                            <h1 class="mt-3 text-center mb-4" style="color:#427D9D;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">HASIL AUDIT</h1>

                            <a href="export/exporthasilaudit.php" class="btn btn-info mb-2 shadow" style="float: right;"><i class="fas fa-book"></i> Cetak Data Hasil Audit</a>

                            <button type="button" class="btn btn-primary mx-1 mb-3 shadow" data-toggle="modal" data-target="#myModal" style=" float: right;">

                                <i class="fas fa-plus"></i> Tambah Data Audit

                            </button>

                        </div>

                        <div class="">

                            <div class="table-responsive shadow-lg px-4 py-5" style="border-radius: 10px;">

                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">

                                    <thead style="background-color: #427D9D; color:white;">

                                    <tr>

                                        <th>Aksi</th>

                                        <th>Foto/Scan Hasil Audit</th>

                                        <th>Jenis Audit</th>

                                        <th>Tanggal Audit</th>

                                        <th>Badan Audit</th>

                                        <th>Temuan Audit</th>

                                        <th>Hasil Audit</th>

                                        <th>Keterangan</th>

                                    </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                        date_default_timezone_set('Asia/Jakarta');



                                        $query = "SELECT * FROM hasil_audit";

                                        $result = mysqli_query($conn, $query);



                                        while ($row = mysqli_fetch_assoc($result)) {

                                            

                                        $id_audit = $row['id_audit'];

                                        $jenis_audit = $row['jenis_audit'];



                                        $gambar = $row['dokumentasi'];

                                        if($gambar==null){

                                            $gambar='Tidak Ada Photo';

                                        }else {

                                            $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';

                                        }





                                        ?>

                                            <tr>

                                                <td>

                                                <div class="btn-group">

                                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#427D9D; height:30px; font-size:12px; color:white;">

                                                        <span class="sr-only">Toggle Dropdown</span>

                                                    </button>

                                                        <div class="dropdown-menu">

                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#edit<?= $id_audit; ?>" style="margin-left: 5px; width: 140px; color: white;">

                                                            Edit

                                                        </button>

                                                        <input type="hidden" name="idbarangygingindihapus" value="<?= $id_audit; ?>">

                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $id_audit; ?>" style="margin-left: 5px; width: 140px;">

                                                        Hapus

                                                        </button>

                                                        <a href="lihat_detail/lihatdetail_hasilaudit.php?id_audit=<?= $id_audit; ?>" style="text-decoration: none;">

                                                        <button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" style="margin-left: 5px; width: 140px;">

                                                        Lihat Data

                                                        </button></a>

                                                        </div>

                                                </div>

                                                </td>

                                                <td><a href="lihat_detail/lihatdetail_hasilaudit.php?id_audit=<?= $id_audit; ?>"><?= $gambar; ?></a></td>

                                                <td><a href="lihat_detail/lihatdetail_hasilaudit.php?id_audit=<?= $id_audit; ?>"><?= htmlspecialchars($row['jenis_audit']) ?></a></td>

                                                <td><?= htmlspecialchars(TanggalIndo($row['tanggal_audit'])) ?></td>

                                                <td><?= htmlspecialchars($row['badan_audit']) ?></td>

                                                <td><?= htmlspecialchars($row['temuan_audit']) ?></td>

                                                <td><?= htmlspecialchars($row['hasil_audit']) ?></td>

                                                <td><?= htmlspecialchars($row['keterangan']) ?></td>



                                            </tr>



                                            <!--Edit Modal -->

                                            <div class="modal fade" id="edit<?= $id_audit; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data Hasil Audit</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post" enctype="multipart/form-data">

                                                            <div class="modal-body">

                                                                <input type="hidden" name="id_audit" value="<?= $id_audit; ?>">

                                                                Edit Foto/Scan Hasil Audit :

                                                                <input type="file" name="gambardepan"  multiple accept="image/*" class="form-control"><br>

                                                                Jenis Audit : 

                                                                <input type="text" name="jenis_audit" value="<?= $row['jenis_audit'] ?>" class="form-control" required><br>

                                                                Edit File PDF Sertifikat :

                                                                <input type="file" name="fileserti" multiple accept=".pdf" class="form-control"><br>

                                                                Tanggal Audit : 

                                                                <input type="date" name="tanggal_audit" value="<?= $row['tanggal_audit'] ?>" class="form-control" required><br>

                                                                Badan Audit : 

                                                                <input type="text" name="badan_audit" value="<?= $row['badan_audit'] ?>" class="form-control"  required><br>

                                                                Temuan Audit :

                                                                <textarea name="temuan_audit" rows="4" class="form-control" required><?= $row['temuan_audit'] ?></textarea><br>

                                                                Hasil Audit :

                                                                <input type="number" name="hasil_audit" step="0.1" min="0" max="100" class="form-control" value="<?= $row['hasil_audit'] ?>" required><br>

                                                                <button type="submit" class="btn btn-primary" name="edit_hasil_audit" style="float: right;">Submit <i class="fas fa-arrow-circle-right"></i></button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $id_audit; ?>">

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

                                                                Apakah Anda yakin ingin menghapus <strong> <?= $jenis_audit; ?>?</strong>

                                                                <input type="hidden" name="id_audit" value="<?= $id_audit; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapus_hasil_audit">Hapus</button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>

                                        <?php

                                        }

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



    <!-- body belum ada -->

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



<!-- MODAL UNTUK INPUT DATA  -->

<!-- The Modal -->

<div class="modal fade" id="myModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Tambah Data Hasil Audit</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <form method="post" enctype="multipart/form-data">

                <div class="modal-body" style="font-size: 15px;">

                <div class="row">

                    <div class="col-md-6">

                        Unggah Foto/Scan Hasil Audit :

                        <input type="file" name="gambardepan" multiple accept="image/*" class="form-control" required><br>

                        Jenis Audit : 

                        <input type="text" name="jenis_audit" class="form-control" required><br>

                        Unggah File PDF Hasil Audit :

                        <input type="file" name="fileserti" class="form-control" multiple accept=".pdf"><br>

                        Tanggal Audit : 

                        <input type="date" name="tanggal_audit" class="form-control" required><br>

                    </div>

                    <div class="col-md-6">

                        Badan Audit : 

                        <input type="text" name="badan_audit" class="form-control"  required><br>

                        Temuan Audit :

                        <textarea name="temuan_audit" class="form-control" rows="4" required></textarea><br>

                        Hasil Audit :

                        <input type="number" name="hasil_audit" step="0.1" min="0" max="100" class="form-control" value=0 required>

                    </div>

                </div>

                    <button type="submit" class="btn btn-primary form-control" name="submit_hasil_audit">Submit <i class="fas fa-arrow-circle-right"></i></button>

                </div>

            </form>



        </div>

    </div>

</div>





<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<link rel="stylesheet" href="/resources/demos/style.css">

<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



<script>

    $(function() {

        $("#tanggalmasuk").datepicker({

            dateFormat: "dd/mm/yy",

            dateMonth: true,

            dateYear: true



        });

    });



</script>



</html>



<?php

// Menambah data 

if (isset($_POST['submit_hasil_audit'])) {

    $jenis_audit = strtoupper($_POST['jenis_audit']);

    $badan_audit = strtoupper($_POST['badan_audit']);

    $hasil_audit = strtoupper($_POST['hasil_audit']);

    $temuan_audit = strtoupper($_POST['temuan_audit']);

    $tanggal_audit2 = $_POST['tanggal_audit'];



    $tanggal_audit = date('Y-m-d', strtotime($tanggal_audit2));



    if ($hasil_audit >= 0 && $hasil_audit <= 34) {

        $keterangan = "WARNING";

    } elseif ($hasil_audit >= 35 && $hasil_audit <= 60) {

        $keterangan = "POOR";

    }  elseif ($hasil_audit >= 61 && $hasil_audit <= 80) {

        $keterangan = "AVERAGE";

    }  elseif ($hasil_audit >= 81 && $hasil_audit <= 95) {

        $keterangan = "GOOD";

    } elseif ($hasil_audit >= 96 && $hasil_audit <= 100) {

        $keterangan = "EXCELLENT";

    } else {

        $keterangan = "Angka Yang Anda Masukkan Tidak Terdaftar";

    }



    // File handling for image upload

    $gambar_depan = $_FILES['gambardepan']; 

    $nama_gambar_depan = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    // Move uploaded image file to the desired directory

    move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);



     // Check if an file is uploaded

     if (isset($_FILES['fileserti']) && $_FILES['fileserti']['error'] === UPLOAD_ERR_OK) {

        $pdfFiles = $_FILES['fileserti'];

        $pdfFileName = $pdfFiles['name'];

        $pdfFilePath = $pdfFiles['tmp_name'];

        $pdfUploadDir = "lihat_detail/dokumen_hasilaudit/";



    } else {

        $pdfFileName = ""; 

    }



    $newPdfFilePath = $pdfUploadDir . $pdfFileName;

    move_uploaded_file($pdfFilePath, $newPdfFilePath);



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username2 = $rowUsername['username'];



    $query = "INSERT INTO hasil_audit (dokumentasi, jenis_audit, tanggal_audit, badan_audit, hasil_audit, temuan_audit, keterangan, nama_file, pdf_path, user_edit_hasil_audit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);



    if ($stmt) {

        // Bind parameters and execute the prepared statement

        mysqli_stmt_bind_param($stmt, "ssssssssss", $nama_gambar_depan, $jenis_audit, $tanggal_audit, $badan_audit, $hasil_audit, $temuan_audit, $keterangan, $pdfFileName, $newPdfFilePath, $username2);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);



        // Display success notification

        echo '<script type="text/javascript">      

            Swal.fire({

                position: "center",

                icon: "success",

                title: "Data Telah Ditambahkan",

                showConfirmButton: false,

                timer: 1500

            });

            setTimeout(function () { 

                window.location.href = "hasilaudit.php"; 

            }, 1500);

            </script>';

    } else {

        // Display error notification

        echo '<script type="text/javascript">      

            Swal.fire({

                position: "center",

                icon: "error",

                title: "Data Gagal Ditambahkan",

                showConfirmButton: false,

                timer: 1500

            });

            setTimeout(function () { 

                window.location.href = "hasilaudit.php"; 

            }, 1500);

            </script>';

    }

}





//Hapus legal

if (isset($_POST['hapus_hasil_audit'])) {

    $id_audit = $_POST['id_audit'];



    // Select the image name from the database to delete the associated file

    $query_select_image = "SELECT dokumentasi FROM hasil_audit WHERE id_audit = ?";

    $stmt_select_image = mysqli_prepare($conn, $query_select_image);

    mysqli_stmt_bind_param($stmt_select_image, "i", $id_audit);

    mysqli_stmt_execute($stmt_select_image);

    mysqli_stmt_store_result($stmt_select_image);



    if (mysqli_stmt_num_rows($stmt_select_image) > 0) {

        mysqli_stmt_bind_result($stmt_select_image, $image);

        mysqli_stmt_fetch($stmt_select_image);

        

        // Path to the image file

        $image_path = "images/" . $image;



        // Delete the image file

        if (file_exists($image_path)) {

            unlink($image_path);

        }

    }



    mysqli_stmt_close($stmt_select_image);



    // Delete the entry from the database

    $query_delete_entry = "DELETE FROM hasil_audit WHERE id_audit = ?";

    $stmt_delete_entry = mysqli_prepare($conn, $query_delete_entry);

    mysqli_stmt_bind_param($stmt_delete_entry, "i", $id_audit);

    $delete_result = mysqli_stmt_execute($stmt_delete_entry);

    mysqli_stmt_close($stmt_delete_entry);



    if ($delete_result) {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "success",

            title: "Data Berhasil Dihapus",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

            window.location.href = "hasilaudit.php"; 

        }, 1500);

        </script>';

    } else {

        echo 'Gagal';

        header('location:hasilaudit.php');

    }

};





//EDIT DATA LEGAL

if (isset($_POST['edit_hasil_audit'])) {

    $id_audit = $_POST['id_audit'];

    $jenis_audit = strtoupper($_POST['jenis_audit']);

    $badan_audit = strtoupper($_POST['badan_audit']);

    $hasil_audit = strtoupper($_POST['hasil_audit']);

    $temuan_audit = strtoupper($_POST['temuan_audit']);

    $tanggal_audit2 = $_POST['tanggal_audit'];



    $tanggal_audit = date('Y-m-d', strtotime($tanggal_audit2));



    if ($hasil_audit >= 0 && $hasil_audit <= 34) {

        $keterangan = "WARNING";

    } elseif ($hasil_audit >= 35 && $hasil_audit <= 60) {

        $keterangan = "POOR";

    }  elseif ($hasil_audit >= 61 && $hasil_audit <= 80) {

        $keterangan = "AVERAGE";

    }  elseif ($hasil_audit >= 81 && $hasil_audit <= 95) {

        $keterangan = "GOOD";

    } elseif ($hasil_audit >= 96 && $hasil_audit <= 100) {

        $keterangan = "EXCELLENT";

    } else {

        $keterangan = "Angka Yang Anda Masukkan Tidak Terdaftar";

    }





     // File handling for image upload

     $gambar_depan = $_FILES['gambardepan']; 

     $nama_gambar_depan = $gambar_depan['name'];

     $lokasi_gambar_depan = $gambar_depan['tmp_name'];

     $folder_simpan = "images/";

 

     // Move uploaded image file to the desired directory

     move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);

 

      // Check if an file is uploaded

      if (isset($_FILES['fileserti']) && $_FILES['fileserti']['error'] === UPLOAD_ERR_OK) {

         $pdfFiles = $_FILES['fileserti'];

         $pdfFileName = $pdfFiles['name'];

         $pdfFilePath = $pdfFiles['tmp_name'];

         $pdfUploadDir = "lihat_detail/dokumen_hasilaudit/";

 

     } else {

         $pdfFileName = ""; 

     }

 

     $newPdfFilePath = $pdfUploadDir . $pdfFileName;

     move_uploaded_file($pdfFilePath, $newPdfFilePath);



     $role = $_SESSION['role'];



     // Mendapatkan username dari tabel login berdasarkan role

     $ambilUsername = mysqli_prepare($conn, "SELECT username, iduser FROM login WHERE role = ?");

     mysqli_stmt_bind_param($ambilUsername, "s", $role);

     mysqli_stmt_execute($ambilUsername);

     $resultUsername = mysqli_stmt_get_result($ambilUsername);

     $rowUsername = mysqli_fetch_assoc($resultUsername);

 

     $username2 = $rowUsername['username'];



     if (empty($nama_gambar_depan) && !empty($pdfFileName)) {

        $query = "UPDATE hasil_audit SET nama_file=?, pdf_path=?, jenis_audit=?, tanggal_audit=?, badan_audit=?, hasil_audit=?, temuan_audit=?, keterangan=?, user_edit_hasil_audit=? WHERE id_audit=?";

        $stmt = mysqli_prepare($conn, $query);

    

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sssssssssi", $pdfFileName, $newPdfFilePath, $jenis_audit, $tanggal_audit, $badan_audit, $hasil_audit, $temuan_audit, $keterangan, $username2, $id_audit);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

    

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "hasilaudit.php"; 

                }, 1500);

                </script>';

        } else {

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Data Gagal Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "hasilaudit.php"; 

                }, 1500);

                </script>';

        }

    } elseif (!empty($nama_gambar_depan) && empty($pdfFileName)) {

        $query = "UPDATE hasil_audit SET dokumentasi=?, jenis_audit=?, tanggal_audit=?, badan_audit=?, hasil_audit=?, temuan_audit=?, keterangan=?, user_edit_hasil_audit=? WHERE id_audit=?";

        $stmt = mysqli_prepare($conn, $query);    

        

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssssssssi", $nama_gambar_depan, $jenis_audit, $tanggal_audit, $badan_audit, $hasil_audit, $temuan_audit, $keterangan, $username2, $id_audit);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

    

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "hasilaudit.php"; 

                }, 1500);

                </script>';

        } else {

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Data Gagal Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "hasilaudit.php"; 

                }, 1500);

                </script>';

        }

    

    } elseif (!empty($nama_gambar_depan) && !empty($pdfFileName)) {

        $query = "UPDATE hasil_audit SET dokumentasi=?, nama_file=?, pdf_path=?, jenis_audit=?, tanggal_audit=?, badan_audit=?, hasil_audit=?, temuan_audit=?, keterangan=?, user_edit_hasil_audit=? WHERE id_audit=?";

        $stmt = mysqli_prepare($conn, $query);

    

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssssssssssi", $nama_gambar_depan, $pdfFileName, $newPdfFilePath, $jenis_audit, $tanggal_audit, $badan_audit, $hasil_audit, $temuan_audit, $keterangan, $username2, $id_audit);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

    

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "hasilaudit.php"; 

                }, 1500);

                </script>';

        } else {

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Data Gagal Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "hasilaudit.php"; 

                }, 1500);

                </script>';

        }

    

    } else {

        $query = "UPDATE hasil_audit SET jenis_audit=?, tanggal_audit=?, badan_audit=?, hasil_audit=?, temuan_audit=?, keterangan=?, user_edit_hasil_audit=? WHERE id_audit=?";

        $stmt = mysqli_prepare($conn, $query);    

        

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sssssssi", $jenis_audit, $tanggal_audit, $badan_audit, $hasil_audit, $temuan_audit, $keterangan, $username2, $id_audit);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

    

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "hasilaudit.php"; 

                }, 1500);

                </script>';

        } else {

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Data Gagal Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "hasilaudit.php"; 

                }, 1500);

                </script>';

        }

    }

}









//fungsi tanngal 

function InputTgl($tanggal)

{

    $pisah = explode('/', $tanggal);

    $lari = array($pisah[2], $pisah[1], $pisah[0]);

    $satukan = implode("-", $lari);



    return $satukan;

}

//fungsi edit tanngal 

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