<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'visitor_ahg' && $_SESSION['role'] !== 'keuangan_ahg' && $_SESSION['role'] !== 'management_ahg' && $_SESSION['role'] !== 'owner_ahg' && $_SESSION['role'] !== 'ketua_operasional_ahg') {
    header("Location: ../login.php");
    exit;
}
$role = $_SESSION['role'];
?>



<!DOCTYPE html>

<html lang="en">



<head>

<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Arsip Barang Keluar</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <style>
    .btn-custom {
        background-color: #DD5555; 
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
    
</style>
</head>



<body class="sb-nav-fixed">


    <div id="prelouder"></div>



    <?php include 'navvisit/navvisit.php'; ?>

    <div id="layoutSidenav">
        <?php include 'navvisit/sidenavvisit.php'; ?>



        <div id="layoutSidenav_content">

            <main>

                <div class="container-fluid">

                    <div class=" mb-4">
                        
                        <h1 class="mt-3 text-center mb-4" style="color:#DD5555;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">BERKAS BARANG KELUAR</h1>
                        
                    

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
                                <form method="GET" action="arsip_excel_visitor.php" class="form-inline mb-4">
                                    <input type="date" name="start_date" class="form-control shadow-sm" required>
                                    <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                                    <button type="submit" name="cari" class="btn btn-custom shadow form-control" >Search</button>
                                </form>
                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">

                                    <thead style="background-color: #DD5555; color:white;">

                                        <tr>

                                            <th>No</th>

                                            <th>Nama File</th>

                                            <th>File</th>

                                            <th>Tanggal Upload</th>

                                            <th>Download  <i class="fas fa-download"></i></th>

                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php
                                        $i = 1;
                                        if(isset($_GET['cari'])){ 
                                            $mulai = $_GET['start_date']; 
                                            $selesai = $_GET['end_date'];
                                            
                                            if($mulai != null && $selesai != null){
                                                $ambilsemuadata_arsip = mysqli_query($conn_ahg, "SELECT * FROM berkas_arsip WHERE jenis_berkas = 'berkas barang keluar' AND tanggal_upload BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata_arsip = mysqli_query($conn_ahg, "SELECT * FROM berkas_arsip WHERE jenis_berkas = 'berkas barang keluar' AND tanggal_upload ='$mulai'");
                                            } else {
                                                $ambilsemuadata_arsip = mysqli_query($conn_ahg, "select * from berkas_arsip where jenis_berkas = 'berkas barang keluar'");
                                            }
                                        } else {
                                            $ambilsemuadata_arsip = mysqli_query($conn_ahg, "select * from berkas_arsip where jenis_berkas = 'berkas barang keluar'");
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
                                                <td><a href="<?php echo '../' . $data_arsip['file_path']; ?>"><?php echo $data_arsip['nama_file']; ?></a></td>
                                                <td><?= $tanggal_upload_excel; ?></td>
                                                <td>
                                                    <a href="<?php echo '../' . $data_arsip['file_path']; ?>" style="text-decoration: underline;">
                                                        Download File
                                                    </a>
                                                </td>

                                            </tr>

                                        

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