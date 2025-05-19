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

    <title>Berkas/ File Barang Masuk</title>

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



    .form-group {

        margin-bottom: 1rem;

    }



    .form-column {

        column-count: 2;

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
                        
                        <h1 class="mt-3 text-center mb-4" style="color:#4045AA;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">BERKAS BARANG MASUK</h1>
                        
                        <div class="col-md-12" style="float: right;">
                            <button type="button" class="btn btn-custom mb-3 shadow" data-toggle="modal" data-target="#Import" style=" float: right;">
                                <i class="fas fa-upload"></i> Upload File
                            </button>
                        </div>

                        <div class="">

                            <div class="table-responsive shadow-lg px-4" style="border-radius: 10px;">
                                <div class="row pt-3" style="font-size: 11px; opacity: 0.9;">
                                    <div class="col-md-2">
                                        Dari Tanggal :
                                    </div>
                                    <div class="col-md-2">
                                        Sampai Tanggal :
                                    </div>
                                </div>
                                <form method="GET" action="arsip_excel_masuk.php" class="form-inline mb-4">
                                    <input type="date" name="start_date" class="form-control shadow-sm" required>
                                    <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                                    <button type="submit" name="cari" class="btn btn-custom shadow form-control" >Search</button>
                                </form>
                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">

                                    <thead style="background-color: #4045AA; color:white;">

                                        <tr>

                                            <th>No</th>

                                            <th>Nama File</th>

                                            <th>File</th>

                                            <th>Tanggal Upload</th>

                                            <th>Download  <i class="fas fa-download"></i></th>

                                            <th>Hapus</th>  

                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php
                                        $i = 1;
                                        if(isset($_GET['cari'])){ 
                                            $mulai = $_GET['start_date']; 
                                            $selesai = $_GET['end_date'];
                                            
                                            if($mulai != null && $selesai != null){
                                                $ambilsemuadata_arsip = mysqli_query($conn_mes, "SELECT * FROM berkas_arsip WHERE jenis_berkas = 'berkas barang masuk' AND tanggal_upload BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata_arsip = mysqli_query($conn_mes, "SELECT * FROM berkas_arsip WHERE jenis_berkas = 'berkas barang masuk' AND tanggal_upload ='$mulai'");
                                            } else {
                                                $ambilsemuadata_arsip = mysqli_query($conn_mes, "select * from berkas_arsip where jenis_berkas = 'berkas barang masuk'");
                                            }
                                        } else {
                                            $ambilsemuadata_arsip = mysqli_query($conn_mes, "select * from berkas_arsip where jenis_berkas = 'berkas barang masuk'");
                                        }
                                        $i= 1;


                                        while ($data_arsip = mysqli_fetch_array($ambilsemuadata_arsip)) {
                                            $nama_file_arsip = $data_arsip["nama_file"];
                                            $excel_path = $data_arsip["file_path"];
                                            $tanggal_upload = $data_arsip["tanggal_upload"];
                                            $id_arsip = $data_arsip["id_arsip"];


                                            $tanggal_upload_excel = TanggalIndo($tanggal_upload);

                                        ?>



                                            <tr>

                                                <td><?= $i++ ?></td>
                                                <td><?= htmlspecialchars($nama_file_arsip) ?></td>
                                                <td><a href="<?php echo $data_arsip['file_path']; ?>"><?php echo $data_arsip['nama_file']; ?></a></td>
                                                <td><?= $tanggal_upload_excel; ?></td>
                                                <td>
                                                    <a href="<?php echo $data_arsip['file_path']; ?>" style="text-decoration: underline;">
                                                        Download File
                                                    </a>
                                                </td>
                                                <td class="justify-content-center text-center align-items-center d-flex">
                                                    <button type="button" class="btn btn-danger btn-block justify-content-center text-center align-items-center" style="width: 30px; height: 30px; font-size: 13px;" data-toggle="modal" data-target="#delete<?= $id_arsip; ?>" style="margin-left: 5px; width: 140px;">
                                                        <i class="fas fa-trash-alt" style="margin-left: -3px;"></i>
                                                    </button>
                                      
                                                    
                                                </td>

                                            </tr>

                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $id_arsip; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Hapus Berkas?</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                Apakah Anda Yakin Ingin Menghapus Berkas <strong> <?= $nama_file_arsip; ?></strong> Tanggal Upload<strong><?= $tanggal_upload_excel?>?</strong>

                                                                <input type="hidden" name="id_arsip" value="<?= $id_arsip; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapus_arsip">Hapus</button>

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



    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="/resources/demos/style.css">

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script> -->

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" crossorigin="anonymous"></script>



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

                    

                    "order": [

                        [1, 'asc']

                    ]

                });

            });

        </script>



</body>

<!-- Import Excel Modal -->

<div class="modal fade" id="Import">
    <div class="modal-dialog " >
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Upload File Excel/ PDF</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body mx-3 my-2">
                    <div class="row">
                    <input type="file" name="file_arsip[]" accept=".xlsx, .xls, .pdf" multiple required>
                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-custom form-control mt-4" name="upload_arsip_masuk">Upload <i class="fas fa-upload"></i></button>
                    </div>
                </div>
            </form>

            <div class="modal-footer" style="font-size: 12px;">
                <p>*Silahkan input file Excel atau PDF yang telah dibuat. Format .xls .xlsx atau .pdf</p>
            </div>


        </div>
    </div>
</div>

<script>

    jQuery(function($) {

        $("#tanggalkeluar").datepicker({

            dateFormat: "dd/mm/yy",

            dateMonth: true,

            dateYear: true



        });

    });

</script>



</html>



<?php
if(isset($_POST['upload_arsip_masuk'])) {
    $upload_directory = "file_arsip/";

    $role = $_SESSION['role'];

    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_mes, "SELECT username, iduser FROM login WHERE role = ?");
    mysqli_stmt_bind_param($ambilUsername, "s", $role);
    mysqli_stmt_execute($ambilUsername);
    $resultUsername = mysqli_stmt_get_result($ambilUsername);
    $rowUsername = mysqli_fetch_assoc($resultUsername);
    $username2 = $rowUsername['username'];

    foreach($_FILES['file_arsip']['tmp_name'] as $key => $tmp_name) {
        // Nama file yang diunggah
        $file_name = $_FILES['file_arsip']['name'][$key];
        
        // Path lengkap penyimpanan file
        $target_file = $upload_directory . basename($file_name);
        
        // Cek tipe file
        $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Cek apakah file sudah ada
        if (file_exists($target_file)) {
            echo '<script type="text/javascript">      

                        Swal.fire({

                            position: "center",

                            icon: "error",

                            title: "Maaf File Sudah Ada",

                            showConfirmButton: false,

                            timer: 1500

                        });

                        setTimeout(function () { 

                        window.location.href = "arsip_excel_masuk.php"; 

                        }, 1500);

                        </script>';
        } else {
            // Cek tipe file yang diperbolehkan
            if($file_type != "xlsx" && $file_type != "xls" && $file_type != "pdf") {
                echo '<script type="text/javascript">      

                        Swal.fire({

                            position: "center",

                            icon: "error",

                            title: "Maaf, hanya file Excel (.xls, .xlsx) atau PDF yang diperbolehkan.",

                            showConfirmButton: false,

                            timer: 1500

                        });

                        setTimeout(function () { 

                        window.location.href = "arsip_excel_masuk.php"; 

                        }, 1500);

                        </script>';
            } else {
                // Proses upload file
                if (move_uploaded_file($_FILES["file_arsip"]["tmp_name"][$key], $target_file)) {
                    // Simpan informasi file ke database
                    $nama_file = $_FILES["file_arsip"]["name"][$key];
                    $file_path = $target_file;
                    $jenis_berkas = "berkas barang masuk";
                    
                    // Query untuk menyimpan informasi file ke database
                    $sql = "INSERT INTO berkas_arsip (nama_file, file_path, jenis_berkas, user_tambah_arsip) VALUES ('$nama_file', '$file_path', '$jenis_berkas', '$username2')";
                    
                    if ($conn_mes->query($sql) === TRUE) {
                        echo '<script type="text/javascript">      

                        Swal.fire({

                            position: "center",

                            icon: "success",

                            title: "File berhasil diunggah dan disimpan ke database",

                            showConfirmButton: false,

                            timer: 1500

                        });

                        setTimeout(function () { 

                        window.location.href = "arsip_excel_masuk.php"; 

                        }, 1500);

                        </script>';
                    } else {
                        echo '<script type="text/javascript">      

                        Swal.fire({

                            position: "center",

                            icon: "error",

                            title: "Maaf, terjadi kesalahan saat minyampan informasi file ke database",

                            showConfirmButton: false,

                            timer: 1500

                        });

                        setTimeout(function () { 

                        window.location.href = "arsip_excel_masuk.php"; 

                        }, 1500);

                        </script>';
                    }
                } else {
                    echo '<script type="text/javascript">      

                    Swal.fire({

                        position: "center",

                        icon: "error",

                        title: "Maaf, terjadi kesalahan saat mengunggah file",

                        showConfirmButton: false,

                        timer: 1500

                    });

                    setTimeout(function () { 

                    window.location.href = "arsip_excel_masuk.php"; 

                    }, 1500);

                    </script>';
                }
            }
        }
    }
}

//Hapus barang

if (isset($_POST['hapus_arsip'])) {

    $id_arsip = $_POST['id_arsip'];
    
    $query_get_file_path = mysqli_query($conn_mes, "SELECT file_path FROM berkas_arsip WHERE id_arsip='$id_arsip'");
    $data = mysqli_fetch_assoc($query_get_file_path);
    $file_path = $data['file_path'];

    // Hapus file fisik dari direktori
    if (unlink($file_path)) {
        $hapus = mysqli_query($conn_mes, "DELETE FROM berkas_arsip WHERE id_arsip='$id_arsip'");

        if ($hapus) {

            echo '<script type="text/javascript">      

            Swal.fire({

                position: "center",

                icon: "success",

                title: "Berkas Telah Dihapus",

                showConfirmButton: false,

                timer: 1500

            });

            setTimeout(function () { 

            window.location.href = "arsip_excel_masuk.php"; 

            }, 1500);

            </script>';

        } else {
            echo 'Gagal';

            header('location:arsip_excel_masuk.php');

        }   
    }    
}



?>


<?php

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