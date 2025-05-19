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

    <title>Barang Keluar</title>

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

        background-color: #3E578D; 

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

    if ($_SESSION['role'] !== 'admin_aph' && $_SESSION['role'] !== 'logistik_aph') {

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

                        <div class="">

                            <h1 class="mt-3 text-center mb-4" style="color:#3E578D;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">BARANG KELUAR</h1>

                            <a href="export/exportkeluar.php" class="btn btn-info mb-2 shadow" style="float: right;"><i class="fas fa-book"></i> Buat Laporan</a>
                            
                            <a href="arsip_excel.php" class="btn btn-success  mx-1 mb-3 shadow" style="float: right;"><i class="fas fa-folder-open"></i> Berkas Arsip</a>

                            <button type="button" class="btn btn-custom mb-3 shadow" data-toggle="modal" data-target="#myModal" style=" float: right;">

                                <i class="fas fa-plus"></i> Tambah

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
                                <form method="GET" action="keluar.php" class="form-inline mb-4">
                                    <input type="date" name="start_date" class="form-control shadow-sm" required>
                                    <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                                    <button type="submit" name="cari" class="btn btn-custom shadow form-control" >Search</button>
                                </form>
                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">

                                    <thead style="background-color: #3E578D; color:white;">

                                        <tr>

                                            <th>Aksi</th>

                                            <th>No Transaksi</th>

                                            <th>Tanggal Keluar</th>

                                            <th>Nama Barang</th>

                                            <th>Gambar Barang</th>

                                            <th>Qty</th>

                                            <th>Unit</th>

                                            <th>Keperluan</th>

                                            <th>Tujuan/Penerima</th>

                                            <th>Keterangan</th>

                                            <th>Status ACC</th>

                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php
                                        if(isset($_GET['cari'])){ 
                                            $mulai = $_GET['start_date']; 
                                            $selesai = $_GET['end_date'];
                                            
                                            if($mulai != null && $selesai != null){
                                                $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) ORDER BY k.kode_transaksi ASC");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar ='$mulai' ORDER BY k.kode_transaksi ASC");
                                            } else {
                                                $ambilsemuadata = mysqli_query($conn_aph, "select * from keluar k, stok s where s.idbarang = k.idbarang ORDER BY k.kode_transaksi ASC");
                                            }
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn_aph, "select * from keluar k, stok s where s.idbarang = k.idbarang ORDER BY k.kode_transaksi ASC");
                                        }
                                        $i= 1;


                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {

                                            $idk = $data['idkeluar'];

                                            $idb = $data['idbarang'];

                                            $tanggalkeluar = $data['tanggal_keluar'];

                                            $nama_barang = $data['namabarang'];

                                            $jumlah = $data['jumlah'];

                                            $tujuan = $data['penerima'];

                                            $keperluan = $data['keperluan'];

                                            $keterangan = $data['keterangank'];

                                            $unit = $data['units'];

                                            $status = $data['status'];





                                            $kodeTransaksi = $data['kode_transaksi'];



                                            $tanggalkeluar_indo = TanggalIndo($tanggalkeluar);



                                            $gambar = $data['dokumentasi'];

                                            if($gambar==null){

                                                $gambar='Tidak Ada Photo';

                                            }else {

                                                $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';

                                            }

                                          

                                        ?>



                                            <tr style="background-color: <?php echo ($status == 'ACCEPTED') ? 'rgba(0, 255, 0, 0.2)' : (($status == 'REJECTED') ? 'rgba(255, 0, 0, 0.2)' : ''); ?>">

                                                <td>

                                                <?php

                                                    if ($status == 'IN PROGRESS') {

                                                        ?>

                                                        <div class="btn-group">

                                                            <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#3E578D; height:30px; font-size:12px; color:white;">

                                                                <span class="sr-only">Toggle Dropdown</span>

                                                            </button>

                                                            <div class="dropdown-menu">

                                                                <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#edit<?= $idk; ?>" style="margin-left: 5px; width: 140px; color: white;">

                                                                    Edit

                                                                </button>

                                                                <input type="hidden" name="idkarangygingindihapus" value="<?= $idk; ?>">

                                                                <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $idk; ?>" style="margin-left: 5px; width: 140px;">

                                                                    Hapus

                                                                </button>

                                                            </div>

                                                        </div>

                                                        <?php

                                                    } else {

                                                        ?>

                                                        <div class="btn-group">

                                                            <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#3E578D; height:30px; font-size:12px; color:white;">

                                                                <span class="sr-only">Toggle Dropdown</span>

                                                            </button>

                                                            <div class="dropdown-menu">

                                                                <input type="hidden" name="idkarangygingindihapus" value="<?= $idk; ?>">

                                                                <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $idk; ?>" style="margin-left: 5px; width: 140px;">

                                                                    Hapus

                                                                </button>

                                                            </div>

                                                        </div>

                                                        <?php

                                                    }

                                                ?>

                                                </td>

                                                <td><a href="#" data-toggle="modal" data-target="#statusModal<?= $idk; ?>"><?= $kodeTransaksi; ?></a></td>

                                                <td><?= htmlspecialchars($tanggalkeluar_indo) ?></td>

                                                <td><?= htmlspecialchars($nama_barang) ?></td>

                                                <td><?= $gambar; ?></td>

                                                <td><?= htmlspecialchars($jumlah) ?></td>

                                                <td><?= htmlspecialchars($unit) ?></td>

                                                <td><?= htmlspecialchars($keperluan) ?></td>

                                                <td><?= htmlspecialchars($tujuan) ?></td>

                                                <td><?= htmlspecialchars($keterangan) ?></td>

                                                <td>

                                                    <?php

                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";

                                                        $result_count_approvals = mysqli_query($conn_aph, $query_count_approvals);

                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);

                                                        $approvals_count = $row_count_approvals['approvals_count'];

                                                        

                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";

                                                        $result_count_approvals = mysqli_query($conn_aph, $query_count_approvals);

                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);

                                                        $rejected_count = $row_count_approvals['rejected_count'];

                                                        

                                                         // Mengambil informasi user yang sudah menyetujui

                                                         $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";

                                                         $result_approved_users = mysqli_query($conn_aph, $query_approved_users);

                                                         $approved_users = [];

                                                         while ($row = mysqli_fetch_assoc($result_approved_users)) {

                                                             $approved_users[] = $row['id_user'];

                                                         }

 

                                                         $approved_users_info = [];

                                                         foreach ($approved_users as $user_id) {

                                                             $query_username = "SELECT username FROM login WHERE iduser = $user_id";

                                                             $result_username = mysqli_query($conn_aph, $query_username);

                                                             $row_username = mysqli_fetch_assoc($result_username);

                                                             $approved_users_info[$user_id] = $row_username['username'];

                                                         }



                                                        // Mengambil informasi user yang melakukan penolakan

                                                        $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";

                                                        $result_rejected_users = mysqli_query($conn_aph, $query_rejected_users);

                                                        $rejected_users = [];

                                                        while ($row = mysqli_fetch_assoc($result_rejected_users)) {

                                                            $rejected_users[] = $row['id_user'];

                                                        }



                                                        // Mengambil informasi username dari tabel login berdasarkan id_user untuk user yang melakukan penolakan

                                                        $rejected_users_info = [];

                                                        foreach ($rejected_users as $user_id) {

                                                            $query_username = "SELECT username FROM login WHERE iduser = $user_id";

                                                            $result_username = mysqli_query($conn_aph, $query_username);

                                                            $row_username = mysqli_fetch_assoc($result_username);

                                                            $rejected_users_info[$user_id] = $row_username['username'];

                                                        }

                                                         // Mengambil Tanggal user yang sudah menyetujui
                                                         $query_approved_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                         $result_approved_users_tgl = mysqli_query($conn_aph, $query_approved_users_tgl);
                                                         $waktu_approve_acc = [];
                                                         while ($row = mysqli_fetch_assoc($result_approved_users_tgl)) {
                                                             $waktu_approve_acc[] = $row['waktu_approve_keluar'];
                                                         }
                                                          // Mengambil Tanggal user yang sudah menolak
                                                          $query_rejected_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                          $result_rejected_users_tgl = mysqli_query($conn_aph, $query_rejected_users_tgl);
                                                          $waktu_approve_rejected = [];
                                                          while ($row = mysqli_fetch_assoc($result_rejected_users_tgl)) {
                                                              $waktu_approve_rejected[] = $row['waktu_approve_keluar'];
                                                          }

                                                     ?>

                                                     <a href="#" data-toggle="modal" data-target="#statusModal<?= $idk; ?>"><?= $status; ?></a>

                                                </td>

                                               

                                            </tr>

                                            <!--Edit Modal -->

                                            <div class="modal fade" id="edit<?= $idk; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data Keluar</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">

                                                                <input type="hidden" name="idk" value="<?= $idk; ?>">

                                                                Tanggal Keluar Barang :

                                                                <input type="date" name="tanggalkeluar_" id="tanggalkeluar_<?= $idk; ?>" value="<?= $tanggalkeluar; ?>" class="form-control datepicker" required><br>

                                                                Nama Barang (Tidak bisa dirubah):

                                                                <div class="form-control bg-warning " style="opacity: 0.8;"><?= $nama_barang; ?></div><br>

                                                                Jumlah Barang Keluar :

                                                                <input type="number" name="qty" value="<?= $jumlah; ?>" class="form-control" required><br>

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

                                                                Keperluan :

                                                                <select name="keperluan" id="keperluan" class="form-control" required>

                                                                    <?php

                                                                    $needs = ["INTERNAL", "EXTERNAL"]; 

                                                                    foreach ($needs as $need) {

                                                                        $selected = ($need == $keperluan) ? 'selected' : ''; 

                                                                        echo '<option value="' . $need . '" ' . $selected . '>' . ucfirst($need) . '</option>';

                                                                    }

                                                                    ?>

                                                                </select><br>

                                                                Tujuan/Penerima :

                                                                <input type="text" name="penerima" value="<?= $tujuan; ?>" class="form-control" required><br>

                                                                <input type="hidden" name="idkaryawan" clas="form-control">

                                                                Keterangan :

                                                                <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" required><br>

                                                                <button type="submit" class="btn btn-custom" name="updatebarangkeluar" style="float: right;">Submit <i class="fas fa-arrow-circle-right"></i></button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $idk; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Hapus Data Keluar?</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                Apakah Anda Yakin Ingin Menghapus Data Keluar <strong> <?= $nama_barang; ?></strong> Pada Tanggal <strong><?= $tanggalkeluar_indo?>?</strong>

                                                                <input type="hidden" name="idk" value="<?= $idk; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                             <!-- Modal -->

                                             <div class="modal fade" id="statusModal<?= $idk; ?>" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel<?= $idk; ?>" aria-hidden="true">

                                                <div class="modal-dialog" role="document">

                                                    <div class="modal-content">

                                                        <div class="modal-header" style="text-align: center;">

                                                            <h5 class="modal-title" id="statusModalLabel<?= $idk; ?>">Status Barang Keluar</h5>

                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                                <span aria-hidden="true">&times;</span>

                                                            </button>

                                                        </div>

                                                        <div class="modal-body">

                                                            <p>No Transaksi: <?= $kodeTransaksi?></p>

                                                            <p>Nama Barang: <?= $nama_barang?></p>

                                                            <p>Jumlah: <?= $jumlah?> <?= $unit?></p>

                                                            <p>Tanggal Keluar Barang: <?= $tanggalkeluar_indo?></p>

                                                            <hr>

                                                            <p>Keperluan: <?= $keperluan?></p>

                                                            <p>Tujuan/Penerima/PIC: <?= strtoupper($tujuan)?></p>

                                                            <p>Keterangan: <?= $keterangan?></p>

                                                            <hr>

                                                            <p>Status Request: <?= $status; ?></p>

                                                            <p>Total Approvals: <?= $approvals_count; ?></p>

                                                            <?php if (!empty($approved_users_info)) : ?>

                                                                <p>Users who approved:</p>

                                                                <ul style="background-color : rgba(0, 128, 0, 0.2);">

                                                                    <?php foreach ($approved_users_info as $user_id => $username) : ?>

                                                                        <?php foreach ($waktu_approve_acc as $waktu_approve) : ?>
                                                                            <li>User ID: <?= $user_id; ?>, Username: <?= $username; ?>, Tanggal: <?= TanggalIndo($waktu_approve); ?></li>
                                                                        <?php endforeach; ?>

                                                                    <?php endforeach; ?>

                                                                </ul>

                                                            <?php endif; ?>

                                                            <p>Total Rejected: <?= $rejected_count; ?></p>

                                                            <?php if (!empty($rejected_users_info)) : ?>

                                                                <p>Users who rejected:</p>

                                                                <ul style="background-color : rgba(128, 0, 0, 0.2);">

                                                                    <?php foreach ($rejected_users_info as $user_id => $username) : ?>

                                                                        <?php foreach ($waktu_approve_rejected as $waktu_approve) : ?>
                                                                            <li>User ID: <?= $user_id; ?>, Username: <?= $username; ?>, Tanggal: <?= TanggalIndo($waktu_approve); ?></li>
                                                                        <?php endforeach; ?>

                                                                    <?php endforeach; ?>

                                                                </ul>

                                                            <?php endif; ?>

                                                        </div>

                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                            <button type="button" class="btn btn-custom" onclick="printModal2('statusModal<?= $idk; ?>')"><i class="fas fa-print"></i> Print</button>

                                                        </div>

                                                        <script>

                                                            function printModal2(modalId) {

                                                                

                                                                var modal = document.getElementById(modalId);

                                                                

                                                                var judul = document.createElement('h4');

                                                                judul.innerHTML = 'BARANG KELUAR';

                                                                judul.style.marginBottom = '40px';

                                                                judul.style.marginTop = '40px';

                                                                judul.style.textAlign = 'center';



                                                                var modalBody = modal.querySelector(".modal-body");



                                                                var modalBodyContents = modalBody.innerHTML;



                                                                var printWindow = window.open('', '_blank');



                                                                printWindow.document.open();



                                                                

                                                                printWindow.document.write(judul.outerHTML);

                                                                printWindow.document.write(modalBodyContents);



                                                                printWindow.document.close();

                                                                printWindow.print();



                                                                printWindow.onafterprint = function() {

                                                                    printWindow.close();

                                                                };

                                                            }

                                                        </script>

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

<!-- The Modal -->

<div class="modal fade" id="myModal">

    <div class="modal-dialog modal-lg" >

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Tambah Barang Keluar</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <form method="post" >

                <div class="modal-body">

                <div id="form_barang">

                <div class="barang-form">

                    <div class="row">

                        <!-- Kolom kiri -->

                        <div class="col-md-6">

                            <!-- Form input untuk setiap barang -->

                            <div class="form-group">

                                <label for="tanggalkeluar">Tanggal Keluar Barang :</label>

                                <input type="date" name="tanggalkeluar[]" id="tanggalkeluar" class="form-control datepicker" required>

                            </div>



                            <div class="form-group">

                                <label for="barangnya">Nama Barang :</label>

                                <div class="input-group">

                                    <select name="barangnya[]" class="form-control" required>

                                        <option value="">--Pilih--</option>

                                        <?php

                                        $ambilsemuadatanya = mysqli_query($conn_aph, "select * from stok");

                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {

                                            $namabarangnya = $fetcharray['namabarang'];

                                            $idbarangnya = $fetcharray['idbarang'];

                                        ?>

                                            <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>

                                        <?php

                                        }

                                        ?>

                                    </select>

                                    <a href="barang.php" class="input-group-text"><b>+</b></a>

                                </div>

                            </div>



                            <div class="form-group">

                                <label for="qty">Jumlah Barang Keluar :</label>

                                <input type="number" name="qty[]" class="form-control" required>

                            </div>



                            <div class="form-group">

                                <label for="unit">Unit :</label>

                                <select name="unit[]" id="selUnit" class="form-control unit" required>

                                    <option value="">--Pilih--</option>

                                    <option value="PCS">Pcs</option>

                                    <option value="ROLL">Roll</option>

                                    <option value="PACK">Pack</option>

                                    <option value="LUSIN">Lusin</option>

                                    <option value="KG">Kilogram (kg)</option>

                                    <option value="LITER">Liter (L)</option>

                                    <option value="GRAM">Gram (g)</option>

                                    <option value="TON">Ton (t)</option>

                                </select>

                            </div>

                        </div>



                        <!-- Kolom kanan -->

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="keperluan">Keperluan :</label>

                                <select name="keperluan[]" id="keperluan" class="form-control" required>

                                    <option value="">--Pilih--</option>

                                    <option value="INTERNAL">UNTUK INTERNAL PERUSAHAAN</option>

                                    <option value="EXTERNAL">UNTUK EXTERNAL PERUSAHAAN</option>

                                </select>

                            </div>



                            <div class="form-group">

                                <label for="penerima">Tujuan/Penerima :</label>

                                <input type="text" name="penerima[]" class="form-control" required>

                            </div>



                            <div class="form-group">
                                <input type="hidden" name="no_transaksi[]" class="form-control">

                            </div>



                            <div class="form-group">

                                <label for="keterangan">Keterangan :</label>

                                <input type="text" name="keterangan[]" class="form-control keterangan" value="-">

                            </div>

                        </div>

                    </div>



                    <!-- Tombol Tambah Barang -->

                    <div class="row">

                        <div class="col-md-12 text-center justify-content-center">

                                    <button type="button" class="btn btn-info tambah-barang">Barang +</button>

                                    <button type="button" class="btn btn-danger hapus-barang">Barang -</button>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Tombol Submit -->

                    <button type="submit" class="btn btn-custom form-control mt-3" name="barangkeluar">Submit <i class="fas fa-arrow-circle-right"></i></button>

                </div>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- Import Excel Modal -->

<div class="modal fade" id="Import">
    <div class="modal-dialog " >
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Import File Excel</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body mx-3 my-2">
                    <div class="row">
                    <input type="file" name="file_excel" accept=".xlsx, .xls" required>
                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-custom form-control mt-4" name="importexcel">Import <i class="fas fa-upload"></i></button>
                    </div>
                </div>
            </form>

            <div class="modal-footer" style="font-size: 12px;">
                <p>*Gunakan format file Excel yang telah ditentukan. Download <a href="format_excel/Format Excel Barang Keluar.xlsx" style="text-decoration: underline;">disini</a></p>
            </div>


        </div>
    </div>
</div>


<script>

    $(document).ready(function() {

        // Fungsi untuk menambah formulir barang

        var i = 2;


        $(".tambah-barang").click(function() {

            var html = `

                <div class="barang-form">

                    <div class="form-group">

                        <!-- Nomor barang -->

                        <div class="col-md-12 text-center py-3 justify-content-center">

                            <h4>Barang ${i++}</h4>

                        </div>



                        <div class="row">

                            <!-- Kolom kiri -->

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="tanggalkeluar">Tanggal Keluar Barang :</label>

                                    <input type="date" name="tanggalkeluar[]" id="tanggalkeluar${i}" class="form-control datepicker" required>

                                </div>



                                <div class="form-group">

                                    <label for="barangnya">Nama Barang :</label>

                                    <div class="input-group">

                                        <select name="barangnya[]" class="form-control" required>

                                            <option value="">--Pilih--</option>

                                            <?php

                                            $ambilsemuadatanya = mysqli_query($conn_aph, "select * from stok");

                                            while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {

                                                $namabarangnya = $fetcharray['namabarang'];

                                                $idbarangnya = $fetcharray['idbarang'];

                                            ?>

                                                <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                        <a href="supplier.php" class="input-group-text"><b>+</b></a>

                                   </div>

                                </div>



                                <div class="form-group">

                                    <label for="qty">Jumlah Barang Keluar :</label>

                                    <input type="number" name="qty[]" class="form-control" required>

                                </div>



                                <div class="form-group">

                                    <label for="unit">Unit :</label>

                                    <select name="unit[]" id="selUnit" class="form-control unit" required>

                                        <option value="">--Pilih--</option>

                                        <option value="PCS">Pcs</option>

                                        <option value="ROLL">Roll</option>

                                        <option value="PACK">Pack</option>

                                        <option value="LUSIN">Lusin</option>

                                        <option value="KG">Kilogram (kg)</option>

                                        <option value="LITER">Liter (L)</option>

                                        <option value="GRAM">Gram (g)</option>

                                        <option value="TON">Ton (t)</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="keperluan">Keperluan :</label>

                                    <select name="keperluan[]" id="keperluan" class="form-control" required>

                                        <option value="">--Pilih--</option>

                                        <option value="INTERNAL">UNTUK INTERNAL PERUSAHAAN</option>

                                        <option value="EXTERNAL">UNTUK EXTERNAL PERUSAHAAN</option>

                                    </select>

                                </div>



                                <div class="form-group">

                                    <label for="penerima">Tujuan/Penerima :</label>

                                    <input type="text" name="penerima[]" class="form-control" required>

                                </div>



                                <div class="form-group">

                                    <input type="hidden" name="no_transaksi[]" class="form-control">

                                </div>



                                <div class="form-group">

                                    <label for="keterangan">Keterangan :</label>

                                    <input type="text" name="keterangan[]" class="form-control keterangan" value="-">

                                </div>

                            </div>

                        </div>

                        <hr>

                    </div>

                </div>

            `;

            $("#form_barang").append(html);


            return false;

        });



        // Fungsi untuk menghapus formulir barang terakhir

        $(".hapus-barang").click(function() {

            var barangForms = $("#form_barang .barang-form");

            if (barangForms.length > 1) {

                $(barangForms[barangForms.length - 1]).remove();

                i--; // Mengurangi nomor saat menghapus formulir

            }

            return false;

        });

    });

</script>





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

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



function sendEmail($emailRecipients, $subject, $body) {

    require '../PHPMailer/src/Exception.php';

    require '../PHPMailer/src/PHPMailer.php';

    require '../PHPMailer/src/SMTP.php';



    $mail = new PHPMailer(true);



    try {

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com'; 

        $mail->SMTPAuth = true;

        $mail->Username = 'mspasyazakaria@gmail.com'; 

        $mail->Password = 'hlmb msuq txbk wgur';

        $mail->SMTPSecure = 'tls';

        $mail->Port = 587;



        $mail->setFrom('mspasyazakaria@gmail.com', 'PT Amanah Putera Harun'); 

        foreach ($emailRecipients as $email) {

            $mail->addAddress($email);

        }

        $mail->isHTML(true);

        $mail->Subject = $subject;

        $mail->Body = $body;



        $mail->send();

        return true;

    } catch (Exception $e) {

        return false;

    }

}



//menambah barang keluar

if (isset($_POST['barangkeluar'])) {

    // Ambil nilai dari $_POST

    $tgl_keluar = $_POST['tanggalkeluar'];

    $barangnya = $_POST['barangnya'];

    $qty = $_POST['qty'];

    $unit = $_POST['unit'];

    $keperluan2 = $_POST['keperluan'];

    $penerima2 = $_POST['penerima'];

    $keterangan2 = $_POST['keterangan'];



    $status = array();


    function generateUniqueTransactionCode($conn_aph) {
        $tahun = date('Y');
        $bulan = date('m');
        
        // Query untuk mencari nomor transaksi terakhir untuk bulan ini
        $query = "SELECT MAX(idkeluar) AS no_transaksi FROM keluar WHERE YEAR(waktu_terakhir_aksi_keluar) = $tahun AND MONTH(waktu_terakhir_aksi_keluar) = $bulan";
        
        // statement
        $stmt = $conn_aph->prepare($query);
        $stmt->execute();
        
        // Mendapatkan hasil
        $result = $stmt->get_result();
        
        // Mengambil data hasil
        $row = $result->fetch_assoc();
        
        // Mengambil nomor transaksi terakhir
        $lastNumber = $row['no_transaksi'];

        if (!$lastNumber) {
            $lastNumber = 0;
        }

        $lastNumber++;

        $newNumberFormatted = sprintf("%04s", $lastNumber);

        $transactionCode = "BK_$tahun$bulan/$newNumberFormatted";
        
        return $transactionCode;
    }
    


    // Konversi tanggal keluar ke format database

    

    for ($i = 0; $i < count($barangnya); $i++) {

        $idbarang = $barangnya[$i];

        $qty_barang = $qty[$i];

        $unit_barang = $unit[$i];

        $keterangan = $keterangan2[$i];

        $penerima = $penerima2[$i];

        $keperluan = $keperluan2[$i];

        $tanggalkeluar = date('Y-m-d', strtotime($tgl_keluar[$i]));

        

        if ($keperluan === 'INTERNAL') {

            $status[$i] = 'ACCEPTED';

        } elseif ($keperluan === 'EXTERNAL') {

            $status[$i] = 'IN PROGRESS';



            $emailRecipients = ['syafiqqu10@gmail.com', 'contoh@example.com', 'email3@example.com']; 

            $subject = 'PERMINTAAN BARANG KELUAR';

            $body = 'Ada permintaan pengeluaran barang yang memerlukan persetujuan. Silakan <a href="https://harungroupisls.com/choose.php">akses sistem</a> untuk melakukan tindakan lebih lanjut.';

            

            $emailSent = sendEmail($emailRecipients, $subject, $body);

        }



        // Mengambil data stok berdasarkan id barang

        $query_cek_stok = "SELECT jmlhstok, namabarang, dokumentasi FROM stok WHERE idbarang = ?";

        $stmt_cek_stok = $conn_aph->prepare($query_cek_stok);

        $stmt_cek_stok->bind_param("i", $idbarang);

        $stmt_cek_stok->execute();

        $result_stok = $stmt_cek_stok->get_result();



        if ($result_stok->num_rows > 0) {

            $row_stok = $result_stok->fetch_assoc();

            $stoksekarang = $row_stok['jmlhstok'];

            $nama_barang = $row_stok['namabarang'];

            $gambar_depan = $row_stok['dokumentasi'];



            if ($stoksekarang >= $qty_barang) {

                $tambahkanstoksekarangdenganquantity = $stoksekarang - $qty_barang;

                

                $kodeTransaksi = generateUniqueTransactionCode($conn_aph);



                $role = $_SESSION['role'];



                // Mendapatkan username dari tabel login berdasarkan role

                $ambilUsername = mysqli_prepare($conn_aph, "SELECT username, iduser FROM login WHERE role = ?");

                mysqli_stmt_bind_param($ambilUsername, "s", $role);

                mysqli_stmt_execute($ambilUsername);

                $resultUsername = mysqli_stmt_get_result($ambilUsername);

                $rowUsername = mysqli_fetch_assoc($resultUsername);

            

                $username2 = $rowUsername['username'];





                // Menambahkan data keluar menggunakan prepared statement

                $query_add_keluar = "INSERT INTO keluar (idbarang, jumlah, dokumentasi, namabarang, tanggal_keluar, keperluan, penerima, units, keterangank, status, kode_transaksi, user_edit_keluar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt_add_keluar = $conn_aph->prepare($query_add_keluar);

                $stmt_add_keluar->bind_param("iissssssssss", $idbarang, $qty_barang, $gambar_depan, $nama_barang, $tanggalkeluar, $keperluan, $penerima, $unit_barang, $keterangan, $status[$i], $kodeTransaksi, $username2);

                $addtokeluar = $stmt_add_keluar->execute();          



                // Update stok menggunakan prepared statement

                $query_update_stok = "UPDATE stok SET jmlhstok = ? WHERE idbarang = ?";

                $stmt_update_stok = $conn_aph->prepare($query_update_stok);

                $stmt_update_stok->bind_param("ii", $tambahkanstoksekarangdenganquantity, $idbarang);

                $updatestokkeluar = $stmt_update_stok->execute();



                if ($addtokeluar && $updatestokkeluar) {

                    echo '<script type="text/javascript">      

                    Swal.fire({

                        position: "center",

                        icon: "success",

                        title: "Data Telah Ditambahkan",

                        showConfirmButton: false,

                        timer: 1500

                    });

                    setTimeout(function () { 

                    window.location.href = "keluar.php"; 

                    }, 1500);

                    </script>';

                } else {

                    echo 'Gagal';

                    header('location:keluar.php');

                }

            } else {

                echo '<script type="text/javascript">      

                        Swal.fire({

                            position: "center",

                            icon: "error",

                            title: "Stok Saat Ini Tidak Mencukupi",

                            showConfirmButton: false,

                            timer: 1500

                        });

                        setTimeout(function () { 

                        window.location.href = "keluar.php"; 

                        }, 1500);

                        </script>';

            }

        } else {

            echo 'Data stok tidak ditemukan';

            exit; 

        }

    }

}



if (isset($_POST['updatebarangkeluar'])) {

    $idb = $_POST['idb'];

    $idk = $_POST['idk'];

    $idbarangnya = $_POST['barangnya'];

    $qty = $_POST['qty'];

    $penerima = $_POST['penerima'];

    $tgl_keluar = $_POST['tanggalkeluar_'];

    $keterangan = $_POST['keterangan'];



    $unit = $_POST['unit'];

    $keperluan2 = $_POST['keperluan'];



    $status = '';



    if ($keperluan2 === 'INTERNAL') {

        $status = 'ACCEPTED';

    } elseif ($keperluan2 === 'EXTERNAL') {

        $status = 'IN PROGRESS';

    }



    // Convert date format

    $tanggalkeluar = date('Y-m-d', strtotime($tgl_keluar));



    // Prepare statements for retrieving data

    $lihatstok = $conn_aph->prepare("SELECT jmlhstok FROM stok WHERE idbarang = ?");

    $lihatstok->bind_param("i", $idb);

    $lihatstok->execute();

    $lihatstok->bind_result($stoksebelumnya);

    $lihatstok->fetch();

    $lihatstok->close();



    $lihatqty = $conn_aph->prepare("SELECT jumlah FROM keluar WHERE idkeluar = ?");

    $lihatqty->bind_param("i", $idk);

    $lihatqty->execute();

    $lihatqty->bind_result($qtysblm);

    $lihatqty->fetch();

    $lihatqty->close();



    $query_get_barang = $conn_aph->prepare("SELECT namabarang, dokumentasi FROM stok WHERE idbarang = ?");

    $query_get_barang->bind_param("i", $idbarangnya);

    $query_get_barang->execute();

    $query_get_barang->bind_result($nama_barang, $gambar_depan);

    $query_get_barang->fetch();

    $query_get_barang->close();



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_aph, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username2 = $rowUsername['username'];



    // Calculate difference in quantity

    $selisih_qty = $qty - $qtysblm;



    if ($stoksebelumnya >= $selisih_qty) {

        // Update stock based on quantity difference

        $stok_baru = $stoksebelumnya - $selisih_qty;



        // Update stock using prepared statement

        $update_stok = $conn_aph->prepare("UPDATE stok SET jmlhstok = ? WHERE idbarang = ?");

        $update_stok->bind_param("ii", $stok_baru, $idb);

        $update_stok->execute();

        $update_stok->close();



        // Update outgoing item information

        $update_keluar = $conn_aph->prepare("UPDATE keluar SET jumlah = ?, penerima = ?, tanggal_keluar = ?, units = ?, keterangank = ?, namabarang = ?, keperluan = ?, status = ?, user_edit_keluar = ? WHERE idkeluar = ?");

        $update_keluar->bind_param("issssssssi", $qty, $penerima, $tanggalkeluar, $unit, $keterangan, $nama_barang, $keperluan2, $status, $username2, $idk);

        $update_keluar->execute();

        $update_keluar->close();



        if ($update_stok && $update_keluar) {

            echo '<script type="text/javascript">      

            Swal.fire({

                position: "center",

                icon: "success",

                title: "Data Telah Diedit",

                showConfirmButton: false,

                timer: 1500

            });

            setTimeout(function () { 

            window.location.href = "keluar.php"; 

            }, 1500);

            </script>';

        } else {

            echo 'Gagal';

            header('location:keluar.php');

        }

    } else {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "error",

            title: "Stok Saat Ini Tidak Mencukupi Untuk Diedit",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

        window.location.href = "keluar.php"; 

        }, 1500);

        </script>';

    }

}







//Hapus barang

if (isset($_POST['hapusbarangkeluar'])) {

    $idk = $_POST['idk'];



    // Mengambil qty sebelumnya

    $query_qty = "SELECT jumlah, idbarang FROM keluar WHERE idkeluar=?";

    $stmt_qty = $conn_aph->prepare($query_qty);

    $stmt_qty->bind_param("i", $idk);

    $stmt_qty->execute();

    $result_qty = $stmt_qty->get_result();



    if ($result_qty->num_rows > 0) {

        $row = $result_qty->fetch_assoc();

        $qtysblm = $row['jumlah'];

        $idb = $row['idbarang'];

    } else {

        echo 'Data jumlah keluar tidak ditemukan';

        exit;

    }



    $stmt_qty->close();



    $status_query = $conn_aph->prepare("select keperluan from keluar where idkeluar = ?");

    $status_query -> bind_param("s", $idk);

    $status_keperluan = $status_query->execute();

    $status_query->close();



    if ($status_keperluan == 'EXTERNAL'){

        $delete_query2 = $conn_aph->prepare("DELETE FROM persetujuan_keluar WHERE id_keluar = ?");

        $delete_query2->bind_param("i", $idk);

        $delete_result2 = $delete_query2->execute();

        $delete_query2->close();

    

        if ($delete_result2){

            $hapus = mysqli_query($conn_aph, "DELETE FROM keluar WHERE idkeluar='$idk'");

    

            if ($hapus) {

                // Mengambil stok sebelumnya

                $query_stok = "SELECT jmlhstok FROM stok WHERE idbarang=?";

                $stmt_stok = $conn_aph->prepare($query_stok);

                $stmt_stok->bind_param("i", $idb);

                $stmt_stok->execute();

                $result_stok = $stmt_stok->get_result();

    

                if ($result_stok->num_rows > 0) {

                    $row_stok = $result_stok->fetch_assoc();

                    $stoksebelumnya = $row_stok['jmlhstok'];

    

                    // Menghitung jumlah stok yang akan ditambahkan kembali

                    $qtypashapus = $qtysblm + $stoksebelumnya;

    

                    // Update jumlah stok di tabel stok

                    $updatestok = mysqli_query($conn_aph, "UPDATE stok SET jmlhstok='$qtypashapus' WHERE idbarang='$idb'");

    

                    if ($updatestok) {

                        echo '<script type="text/javascript">      

                        Swal.fire({

                            position: "center",

                            icon: "success",

                            title: "Data Telah Dihapus",

                            showConfirmButton: false,

                            timer: 1500

                        });

                        setTimeout(function () { 

                        window.location.href = "keluar.php"; 

                        }, 1500);

                        </script>';

                    } else {

                        echo 'Gagal';

                        header('location:keluar.php');

                    }

                } else {

                    echo 'Data stok tidak ditemukan';

                    exit;

                }

                

                $stmt_stok->close();

            } else {

                echo 'Gagal';

                header('location:keluar.php');

            }

        }



    } elseif ($status_keperluan == 'INTERNAL'){



        $hapus = mysqli_query($conn_aph, "DELETE FROM keluar WHERE idkeluar='$idk'");

    

        if ($hapus) {

            // Mengambil stok sebelumnya

            $query_stok = "SELECT jmlhstok FROM stok WHERE idbarang=?";

            $stmt_stok = $conn_aph->prepare($query_stok);

            $stmt_stok->bind_param("i", $idb);

            $stmt_stok->execute();

            $result_stok = $stmt_stok->get_result();



            if ($result_stok->num_rows > 0) {

                $row_stok = $result_stok->fetch_assoc();

                $stoksebelumnya = $row_stok['jmlhstok'];



                // Menghitung jumlah stok yang akan ditambahkan kembali

                $qtypashapus = $qtysblm + $stoksebelumnya;



                // Update jumlah stok di tabel stok

                $updatestok = mysqli_query($conn_aph, "UPDATE stok SET jmlhstok='$qtypashapus' WHERE idbarang='$idb'");



                if ($updatestok) {

                    echo '<script type="text/javascript">      

                    Swal.fire({

                        position: "center",

                        icon: "success",

                        title: "Data Telah Dihapus",

                        showConfirmButton: false,

                        timer: 1500

                    });

                    setTimeout(function () { 

                    window.location.href = "keluar.php"; 

                    }, 1500);

                    </script>';

                } else {

                    echo 'Gagal';

                    header('location:keluar.php');

                }

            } else {

                echo 'Data stok tidak ditemukan';

                exit;

            }

            

            $stmt_stok->close();

        } else {

            echo 'Gagal';

            header('location:keluar.php');

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