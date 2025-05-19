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

    <title>Ordering</title>

    <link href="css/styles.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="sweetalert2.min.css">

    <style>



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



    @media print {

        body {

            font-size: 15px;

            margin: 20mm;

            page-break-before: always;

            }

            

        @page {

                size: auto;

                margin: 0mm;

        }



        #content {

                display: none;

            }

    }

</style>

</head>



<body class="sb-nav-fixed">

    <?php

    if ($_SESSION['role'] !== 'admin_aph' && $_SESSION['role'] !== 'supply_aph' && $_SESSION['role'] !== 'logistik_aph') {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "error",

            title: "NOT ACCESS ",

            html: "Maaf, Anda tidak memiliki akses sebagai <strong> ADMIN  </strong> dan <strong> SUPPLY </strong>. Silahkan lakukan login ulang jika ingin mengakses halaman ini",

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

                            <h1 class="mt-3 text-center mb-4" style="color:#3E578D;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">PERMINTAAN BARANG</h1>

                            <a href="export/exportordering.php" class="btn btn-info shadow" style="margin-bottom: 5px; float: right;"><i class="fas fa-book"></i> Buat Laporan</a>

                            <a href="arsip_excel_ordering.php" class="btn btn-success  mx-1 mb-3 shadow" style="float: right;"><i class="fas fa-folder-open"></i> Berkas Arsip</a>

                            <button type="button" class="btn btn-custom shadow" data-toggle="modal" data-target="#myModal" style="margin-bottom: 5px; float: right;">

                                <i class="fas fa-plus"></i> Tambah Data

                            </button>

                        </div>

                        <div class="">

                            <div class="table-responsive shadow-lg px-4 " style="border-radius: 10px;">
                                <div class="row pt-3" style="font-size: 11px; opacity: 0.9;">
                                    <div class="col-md-2">
                                        Dari Tanggal :
                                    </div>
                                    <div class="col-md-2">
                                        Sampai Tanggal :
                                    </div>
                                    <div class="col-md-2">
                                        Cari Berdasarkan :
                                    </div>
                                </div>
                                <form method="GET" action="ordering.php" class="form-inline mb-4">
                                    <input type="date" name="start_date" class="form-control shadow-sm" required>
                                    <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                                    <select name="tgl_apa" class="form-control shadow-sm" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Tanggal_Buat">Tanggal Buat</option>
                                        <option value="Tanggal_Permintaan">Tanggal Permintaan</option>
                                    </select>  
                                    <button type="submit" name="cari" class="btn btn-custom shadow form-control ml-2" >Search</button>
                                </form>
                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:12px; text-transform: uppercase;">

                                    <thead style="background-color: #3E578D; color:white;">

                                        <tr>

                                            <th>Aksi</th>

                                            <th>No Transaksi</th>

                                            <th>Tanggal Buat Surat </th>

                                            <th>Tanggal Permintaan</th>

                                            <th>Nama Barang</th>

                                            <th>Quantity</th>

                                            <th>Unit</th>

                                            <th>Nama Supplier</th>

                                            <th>Harga Satuan</th>

                                            <th>PPN %</th>

                                            <th>Diskon %</th>

                                            <th>Total Harga</th>

                                            <th>Keterangan</th>

                                            <th>Status</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                    <?php
                                    if(isset($_GET['cari'])){ 
                                        $mulai = $_GET['start_date']; 
                                        $selesai = $_GET['end_date'];
                                        $tgl_apa = $_GET['tgl_apa'];
                                        
                                        if($mulai != null && $selesai != null && $tgl_apa != null){
                                            if($tgl_apa == 'Tanggal_Buat') {
                                                $ambildatapermintaan = mysqli_query($conn_aph, "SELECT * from permintaan WHERE tanggal_buat BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                            } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                $ambildatapermintaan = mysqli_query($conn_aph, "SELECT * from permintaan WHERE tanggal_permintaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                            } else {
                                                $ambildatapermintaan = mysqli_query($conn_aph, "select * from permintaan");
                                            }
                                        } elseif($mulai != null && $selesai == null && $tgl_apa != null) {
                                            if($tgl_apa == 'Tanggal_Buat') {
                                                $ambildatapermintaan = mysqli_query($conn_aph, "SELECT * from permintaan WHERE tanggal_buat = '$mulai'");
                                            } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                $ambildatapermintaan = mysqli_query($conn_aph, "SELECT * from permintaan WHERE tanggal_permintaan = '$mulai'");
                                            } else {
                                                $ambildatapermintaan = mysqli_query($conn_aph, "select * from permintaan");
                                            }
                                        } else {
                                            $ambildatapermintaan = mysqli_query($conn_aph, "select * from permintaan");
                                        }
                                    } else {
                                        $ambildatapermintaan = mysqli_query($conn_aph, "select * from permintaan");
                                    }
                                        

                                        $i= 1;

                                        while ($data = mysqli_fetch_array($ambildatapermintaan)) {

                                            $tanggal_buat = $data['tanggal_buat'];

                                            $tanggal_permintaan = $data['tanggal_permintaan'];

                                            $item_barang = $data['item_barang'];

                                            $qty = $data['qty'];

                                            $satuan_bentuk = $data['satuan_bentuk'];

                                            $harga_satuan = $data['harga_satuan'];

                                            $total_harga = $data['total_harga'];

                                            $keterangan = $data['keterangan'];

                                            $idsupplier = $data['idsupplier'];

                                            $namasupplier = $data['nama_supplier_order'];



                                            $status_request = $data['status_request'];

                                            $ppn = $data['ppn'];

                                            $diskon = $data['diskon'];

                                            $kode_transaksi_request = $data['kode_transaksi_request'];



                                            $idp = $data['id_order'];





                                            $tanggalbuatindo = TanggalIndo($tanggal_buat);

                                            $tanggalpermintaanindo = TanggalIndo($tanggal_permintaan);



                                        

                                        ?>



                                            <tr style="background-color: <?php echo ($status_request == 'ACCEPTED') ? 'rgba(0, 255, 0, 0.2)' : (($status_request == 'REJECTED') ? 'rgba(255, 0, 0, 0.2)' : ''); ?>">

                                                <td>

                                                <?php

                                                    if ($status_request == 'IN PROGRESS') {

                                                    ?>

                                                    <div class="btn-group">

                                                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#3E578D; height:30px; font-size:12px; color:white;">

                                                            <span class="sr-only">Toggle Dropdown</span>

                                                        </button>

                                                            <div class="dropdown-menu">

                                                            <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#edit<?= $idp; ?>" style="margin-left: 5px; width: 140px; color: white;">

                                                                Edit

                                                            </button>

                                                            <input type="hidden" name="idkarangygingindihapus" value="<?= $idp; ?>">

                                                            <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $idp; ?>" style="margin-left: 5px; width: 140px;">

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

                                                            <input type="hidden" name="idkarangygingindihapus" value="<?= $idp; ?>">

                                                            <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $idp; ?>" style="margin-left: 5px; width: 140px;">

                                                            Hapus

                                                            </button>

                                                            </div>

                                                    </div>

                                                        <?php

                                                    }

                                                ?>

                                                </td>

                                                <td><a href="#" data-toggle="modal" data-target="#statusModal<?= $idp; ?>"><?= $kode_transaksi_request; ?></a></td>

                                                <td><?= htmlspecialchars($tanggalbuatindo) ?></td>

                                                <td><?= htmlspecialchars($tanggalpermintaanindo) ?></td>

                                                <td><?= htmlspecialchars($item_barang) ?></td>

                                                <td><?= htmlspecialchars($qty) ?></td>

                                                <td><?= htmlspecialchars($satuan_bentuk) ?></td>

                                                <td><?= htmlspecialchars($namasupplier) ?></td>

                                                <td><?= htmlspecialchars($harga_satuan) ?></td>

                                                <td><?= htmlspecialchars($ppn) ?></td>

                                                <td><?= htmlspecialchars($diskon) ?></td>

                                                <td style="font-weight : bold;">Rp <?= number_format($total_harga, 0, ',', '.') ?></td>

                                                <td><?= htmlspecialchars($keterangan) ?></td>

                                                <td>

                                                <?php

                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";

                                                        $result_count_approvals = mysqli_query($conn_aph, $query_count_approvals);

                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);

                                                        $approvals_count = $row_count_approvals['approvals_count'];



                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";

                                                        $result_count_approvals = mysqli_query($conn_aph, $query_count_approvals);

                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);

                                                        $rejected_count = $row_count_approvals['rejected_count'];



                                                        // Mengambil informasi user yang sudah menyetujui

                                                        $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";

                                                        $result_approved_users = mysqli_query($conn_aph, $query_approved_users);

                                                        $approved_users = [];

                                                        while ($row = mysqli_fetch_assoc($result_approved_users)) {

                                                            $approved_users[] = $row['id_user'];

                                                        }



                                                        // Mengambil informasi username dari tabel login berdasarkan id_user

                                                        $approved_users_info = [];

                                                        foreach ($approved_users as $user_id) {

                                                            $query_username = "SELECT username FROM login WHERE iduser = $user_id";

                                                            $result_username = mysqli_query($conn_aph, $query_username);

                                                            $row_username = mysqli_fetch_assoc($result_username);

                                                            $approved_users_info[$user_id] = $row_username['username'];

                                                        }



                                                        // Mengambil informasi user yang melakukan penolakan

                                                        $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";

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
                                                        $query_approved_users_tgl = "SELECT DISTINCT waktu_approve FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                        $result_approved_users_tgl = mysqli_query($conn_aph, $query_approved_users_tgl);
                                                        $waktu_approve_acc = [];
                                                        while ($row = mysqli_fetch_assoc($result_approved_users_tgl)) {
                                                            $waktu_approve_acc[] = $row['waktu_approve'];
                                                        }
                                                        // Mengambil Tanggal user yang sudah menolak
                                                        $query_rejected_users_tgl = "SELECT DISTINCT waktu_approve FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                        $result_rejected_users_tgl = mysqli_query($conn_aph, $query_rejected_users_tgl);
                                                        $waktu_approve_rejected = [];
                                                        while ($row = mysqli_fetch_assoc($result_rejected_users_tgl)) {
                                                            $waktu_approve_rejected[] = $row['waktu_approve'];
                                                        }

                                                    ?>

                                                    <a href="#" data-toggle="modal" data-target="#statusModal<?= $idp; ?>"><?= $status_request; ?></a>

                                                </td>





                                            </tr>



                                                  <!--Edit Modal -->

                                            <div class="modal fade" id="edit<?= $idp; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data Permintaan</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                            Tanggal Buat :

                                                            <input type="date" name="tanggalbuat" id="tanggalbuat" class="form-control datepicker" value="<?= $tanggal_buat; ?>" required><br>

                                                            Tanggal Permintaan Barang Dikirim :

                                                            <input type="date" name="tanggalkirim" id="tanggalkirim" class="form-control datepicker" value="<?= $tanggal_permintaan; ?>" required><br>

                                                            Nama Barang : 

                                                            <select name="barangnya" class="form-control" required>

                                                                <option value=""></option>

                                                                <?php

                                                                $ambilsemuadatanya = mysqli_query($conn_aph, "select * from stok");

                                                                while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {

                                                                    $namabarangnya = $fetcharray['namabarang'];

                                                                    $idsupbarangnya = $fetcharray['idbarang'];

                                                                    $selected = ($item_barang == $namabarangnya) ? 'selected' : ''; 

                                                                ?>

                                                                    <option value="<?= $idsupbarangnya; ?>"<?= $selected?>><?= $namabarangnya; ?></option>

                                                                <?php

                                                                }

                                                                ?>

                                                            </select>

                                                            <br>

                                                            Quantity :

                                                            <input type="number" name="qty" class="form-control" value="<?= $qty; ?>" required><br>

                                                            Unit :

                                                            <select name="unit" id="unit" class="form-control">

                                                                <?php

                                                                $units = ["pcs", "roll", "pack", "lusin", "kg", "liter", "gram", "ton"]; 

                                                                foreach ($units as $unit) {

                                                                    $selected = ($satuan_bentuk == $unit) ? 'selected' : ''; 

                                                                    echo '<option value="' . $unit . '" ' . $selected . '>' . ucfirst($unit) . '</option>';

                                                                }

                                                                ?>

                                                            </select><br>

                                                            Nama Supplier : 

                                                            <select name="supplier2" class="form-control" required>

                                                                <?php

                                                                $ambilsemuadata = mysqli_query($conn_aph, "select * from supplier");

                                                                while ($fetcharray = mysqli_fetch_array($ambilsemuadata)) {

                                                                    $namasupplier = $fetcharray['namasupplier'];

                                                                    $id_supplier = $fetcharray['idsupplier'];

                                                                    $selected = ($idsupplier == $id_supplier) ? 'selected' : ''; 

                                                                ?>

                                                                    <option value="<?= $id_supplier; ?>"<?= $selected?>><?= $namasupplier; ?></option>

                                                                <?php

                                                                }

                                                                ?>

                                                            </select>

                                                            <br>

                                                            Harga Satuan :

                                                            <input type="number" name="hargasatuan" class="form-control" value="<?= $harga_satuan; ?>" required><br>

                                                            PPN % :

                                                            <input type="number" name="ppn" class="form-control" value="<?= $ppn; ?>" required><br>

                                                            Diskon % :

                                                            <input type="number" name="diskon" class="form-control" value="<?= $diskon; ?>" required><br>

                                                            Keterangan :

                                                            <input type="text" name="keterangan" class="form-control" value="<?= $keterangan; ?>"  required><br>

                                                                <input type="hidden" name="idp" value="<?= $idp; ?>">

                                                                <button type="submit" class="btn btn-custom" name="updatepermintaan" style="float: right;">Submit <i class="fas fa-arrow-circle-right"></i></button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $idp; ?>">

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

                                                                Apakah Anda yakin ingin menghapus <strong><?= $item_barang; ?></strong> dari <strong> <?= $namasupplier?></strong> Pada Tanggal <strong> <?= $tanggalbuatindo ?>?</strong>

                                                                <input type="hidden" name="idp" value="<?= $idp; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapuspermintaan">Hapus</button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!-- Modal -->

                                            <div class="modal fade" id="statusModal<?= $idp; ?>" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel<?= $idp; ?>" aria-hidden="true">

                                                <div class="modal-dialog" role="document">

                                                    <div class="modal-content">

                                                        <div class="modal-header d-flex align-items-center justify-content-center" style="text-align: center;">

                                                                <div class="col-md-11">

                                                                    <h5 class="modal-title" id="statusModalLabel<?= $idp; ?>">Permintaan Barang</h5>

                                                                </div>

                                                                <div class="position-absolute" style="right : 20px;">

                                                                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close">

                                                                        <span aria-hidden="true">&times;</span>

                                                                    </button>

                                                                </div>

                                                        </div>

                                                        <div class="modal-body" id="print_permintaan">

                                                            <p>No Transaksi: <?= $kode_transaksi_request?></p>

                                                            <p>Nama Barang: <?= $item_barang?></p>

                                                            <p>Jumlah: <?= $qty?> <?= $satuan_bentuk?></p>

                                                            <p style="font-weight : bold;">Total Harga: Rp <?= number_format($total_harga, 0, ',', '.') ?></p>

                                                            <hr>

                                                            <p>Tanggal Buat: <?= $tanggalbuatindo?></p>

                                                            <p>Tanggal Permintaan: <?= $tanggalpermintaanindo?></p>

                                                            <p>Keterangan : <?= $keterangan?></p>

                                                            <hr>

                                                            <p>Status Request: <?= $status_request; ?></p>

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

                                                            <?php

                                                            $batas_approval = 3;

                                                            $harga_batas = 10000000; 

                                                            if ($total_harga > $harga_batas && $approvals_count < $batas_approval) : ?>

                                                                <p><strong>Catatan:</strong> Permintaan ini membutuhkan minimal <?= $batas_approval; ?> persetujuan karena total harganya melebihi <?= number_format($harga_batas, 0, ',', '.'); ?>.</p>

                                                            <?php endif; ?>

                                                        </div>

                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                            <button type="button" class="btn btn-custom" onclick="printModal('statusModal<?= $idp; ?>')"><i class="fas fa-print"></i> Print</button>

                                                        </div>



                                                        <script>

                                                            function printModal(modalId) {

                                                                

                                                                var modal = document.getElementById(modalId);

                                                                

                                                                var judul = document.createElement('h4');

                                                                judul.innerHTML = 'PERMINTAAN BARANG';

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

        })

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

    <script>

        $(function() {

            $('[id^="tanggalmasuk_"]').datepicker({

                dateFormat: "dd/mm/yy",

                dateMonth: true,

                dateYear: true

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

                <h4 class="modal-title">Tambah Data Permintaan</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <form method="post">

                <div class="modal-body">

                    <div id="form_barang">

                    <div class="barang-form">

                        <h5 class="counter" style="text-align: center;">PERMINTAAN 1</h5>

                        <div class="row mt-4">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="tanggalbuat">Tanggal Buat :</label>

                                    <input type="date" name="tanggalbuat[]" id="tanggalbuat" class="form-control" required>

                                </div>

                                <div class="form-group">

                                    <label for="tanggalkirim">Tanggal Permintaan Barang Dikirim :</label>

                                    <input type="date" name="tanggalkirim[]" id="tanggalkirim" class="form-control" required>

                                </div>

                                <div class="form-group">

                                    <label for="barangnya">Nama Barang :</label>

                                    <div class="input-group">

                                        <select name="barangnya[]" class="form-control" required>

                                            <option value="">--Pilih--</option>

                                            <?php

                                            $ambilsemuadatanya = mysqli_query($conn_aph, "SELECT * FROM stok");

                                            while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {

                                                $namabarangnya = $fetcharray['namabarang'];

                                                $idsupbarangnya = $fetcharray['idbarang'];

                                            ?>

                                                <option value="<?= $idsupbarangnya; ?>"><?= $namabarangnya; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                        <a href="barang.php" class="input-group-text"><b>+</b></a>

                                   </div>

                                </div>

                                <div class="form-group">

                                    <label for="qty">Quantity :</label>

                                    <input type="number" name="qty[]" class="form-control" required>

                                </div>

                                <div class="form-group">

                                    <label for="unit">Unit :</label>

                                    <select name="unit[]" id="unit" class="form-control unit" required>

                                        <option value="">--Pilih--</option>

                                        <option value="pcs">Pcs</option>

                                        <option value="roll">Roll</option>

                                        <option value="pack">Pack</option>

                                        <option value="lusin">Lusin</option>

                                        <option value="kg">Kilogram (kg)</option>

                                        <option value="liter">Liter (L)</option>

                                        <option value="gram">Gram (g)</option>

                                        <option value="ton">Ton (t)</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="ppn" class="form-label">PPN : *masukkan angka 0 jika tidak ada PPN</label><br>

                                    <div class="input-group">

                                        <input type="number" class="form-control" name="ppn[]" value=0 required>

                                        <span class="input-group-text" id="basic-addon2">%</span>

                                    </div>

                                </div>

                                <div class="form-group">

                                   <label for="diskon" class="form-label">Diskon : *masukkan angka 0 jika tidak ada diskon</label><br>

                                    <div class="input-group">

                                        <input type="number" class="form-control" name="diskon[]" value=0 required>

                                        <span class="input-group-text" id="basic-addon2">%</span>

                                   </div>

                                </div>

                                <div class="form-group">

                                    <label for="supplier2">Nama Supplier :</label>

                                    <div class="input-group">

                                        <select name="supplier2[]" class="form-control" required>

                                            <option value="">--Pilih--</option>

                                            <?php

                                            $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM supplier");

                                            while ($fetcharray = mysqli_fetch_array($ambilsemuadata)) {

                                                $namasupplier = $fetcharray['namasupplier'];

                                                $idsupplier = $fetcharray['idsupplier'];

                                            ?>

                                                <option value="<?= $idsupplier; ?>"><?= $namasupplier; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                        <a href="supplier.php" class="input-group-text"><b>+</b></a>

                                   </div>

                                </div>

                                <div class="form-group">

                                    <label for="hargasatuan">Harga Satuan :</label>

                                    <input type="number" name="hargasatuan[]" class="form-control" required>

                                </div>

                                <div class="form-group">

                                    <label for="keterangan">Keterangan :</label>

                                    <input type="text" name="keterangan[]" class="form-control" value="-" required>

                                </div>

                                <hr>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 text-center justify-content-center">

                                    <button type="button" class="btn btn-info tambah-barang">Tambah +</button>

                                    <button type="button" class="btn btn-danger hapus-barang">Kurangi -</button>

                                </div>

                            </div>

                        </div>

                    </div>

                    <br>

                    <button type="submit" class="btn btn-custom form-control" name="tambahpermintaan">Submit <i class="fas fa-arrow-circle-right"></i></button>

                </div>

                </div>

            </form>

            

        </div>

    </div>

</div>

<script>

$(document).ready(function() {

    var counter = 1;



    $(".tambah-barang").click(function() {

        counter++;

        var html = $(".barang-form:first").clone(); 

        html.find("input, select").val(""); 

        $(".barang-form:last").after(html); 

        updateCounter();

    });



        $(".hapus-barang").click(function() {

            var barangForms = $("#form_barang .barang-form");

            if (barangForms.length > 1) {

                $(barangForms[barangForms.length - 1]).remove();

                counter--;

            }

            return false;

        });



    function updateCounter() {

        var count = 1;

        $('.barang-form').each(function() {

            $(this).find('.counter').text("PERMINTAAN " + count);

            count++;

        });

    }

});

</script>





</body>

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



if(isset($_POST['tambahpermintaan'])) {

    $tanggalbuat = $_POST['tanggalbuat'];

    $tanggalkirim = $_POST['tanggalkirim'];

    $barangnya = $_POST['barangnya'];

    $qty = $_POST['qty'];

    $unit = $_POST['unit'];

    $ppn = $_POST['ppn'];

    $diskon = $_POST['diskon'];

    $supplier2 = $_POST['supplier2'];

    $hargasatuan = $_POST['hargasatuan'];

    $keterangan = $_POST['keterangan'];

    function generateUniqueTransactionCode($conn_aph) {
        $tahun = date('Y');
        $bulan = date('m');
        
        // Query untuk mencari nomor transaksi terakhir untuk bulan ini
        $query = "SELECT MAX(id_order) AS no_transaksi FROM permintaan WHERE YEAR(updated_at) = $tahun AND MONTH(updated_at) = $bulan";
        
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

        $transactionCode = "RO_$tahun$bulan/$newNumberFormatted";
        
        return $transactionCode;
    }



    foreach($tanggalbuat as $key => $value) {

         // Menyimpan informasi supplier

        $supplier = $supplier2[$key]; // Asumsi supplier2 adalah ID supplier dari form

        $getSupplierInfo = $conn_aph->prepare("SELECT * FROM supplier WHERE idsupplier = ?");

        $getSupplierInfo->bind_param("i", $supplier);

        $getSupplierInfo->execute();

        $supplierInfo = $getSupplierInfo->get_result()->fetch_assoc();

        $getSupplierInfo->close();



        $idsupplier = $supplierInfo['idsupplier'];

        $namasupplier = $supplierInfo['namasupplier'];



        $idbarang = $barangnya[$key]; 

        $getbaranginfo = $conn_aph->prepare("SELECT * FROM stok WHERE idbarang = ?");

        $getbaranginfo->bind_param("i", $idbarang);

        $getbaranginfo->execute();

        $baranginfo = $getbaranginfo->get_result()->fetch_assoc();

        $getbaranginfo->close();



        $nama_barang = $baranginfo['namabarang'];

        



        // Perhitungan Total Harga

        $qty_barang = $qty[$key]; 

        $hargasatuan_barang = $hargasatuan[$key]; 

        $total_harga = $qty_barang * $hargasatuan_barang;

    

        $total_diskon = ($diskon[$key] > 0) ? ($total_harga * $diskon[$key]) / 100 : 0;

        $total_harga_setelah_diskon = $total_harga - $total_diskon;

        $total_ppn = ($ppn[$key] > 0) ? ($total_harga_setelah_diskon * $ppn[$key]) / 100 : 0;

    

        $total_setelah_diskon_dan_ppn = $total_harga_setelah_diskon + $total_ppn;

    

        // Mendapatkan kode transaksi unik

        $kodeTransaksi[$key] = generateUniqueTransactionCode($conn_aph);

 

        $role = $_SESSION['role'];

 

        // Mendapatkan username dari tabel login berdasarkan role

        $ambilUsername = mysqli_prepare($conn_aph, "SELECT username, iduser FROM login WHERE role = ?");

        mysqli_stmt_bind_param($ambilUsername, "s", $role);

        mysqli_stmt_execute($ambilUsername);

        $resultUsername = mysqli_stmt_get_result($ambilUsername);

        $rowUsername = mysqli_fetch_assoc($resultUsername);

     

        $username2[$key] = $rowUsername['username'];



        $status = 'IN PROGRESS';



        $query = "INSERT INTO permintaan (tanggal_buat, tanggal_permintaan, item_barang, qty, satuan_bentuk, harga_satuan, ppn, diskon, total_harga, idsupplier, nama_supplier_order, keterangan, status_request, user_edit_order, kode_transaksi_request) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn_aph->prepare($query);

        $stmt->bind_param("sssisiiidisssss", $tanggalbuat[$key], $tanggalkirim[$key], $nama_barang, $qty[$key], $unit[$key], $hargasatuan[$key], $ppn[$key], $diskon[$key], $total_setelah_diskon_dan_ppn, $supplier2[$key], $namasupplier, $keterangan[$key], $status, $username2[$key], $kodeTransaksi[$key]);

        $stmt->execute();

        $stmt->close();

    }



    if ($stmt) {

        if ($total_setelah_diskon_dan_ppn > 10000000) {

            $emailRecipients = ['contoh@gmail.com', 'contoh@gmail.com', 'contoh@example.com'];

        } else {

            $emailRecipients = ['contoh@gmail.com', 'contoh@example.com'];

        }

    

        $subject = 'REQUEST ORDER/ PERMINTAAN BARANG';

        $body = 'Ada permintaan Permintaan Pembelian Barang yang memerlukan persetujuan. Silakan <a href="https://harungroupisls.com/choose.php">akses sistem</a> untuk melakukan tindakan lebih lanjut.';



        $emailSent = sendEmail($emailRecipients, $subject, $body);

    

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "success",

            title: "Data Telah Ditambahkan",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

        window.location.href = "ordering.php"; 

        }, 1500);

        </script>';

    } else {

        echo 'Gagal';

        header('location:ordering.php');

    }



}





//EDIT

if (isset($_POST['updatepermintaan'])) {

    $idp = $_POST['idp'];

    $tanggalbuat = $_POST['tanggalbuat'];

    $tanggalkirim = $_POST['tanggalkirim'];

    $barangnya = $_POST['barangnya'];

    $qty = $_POST['qty'];

    $unit = $_POST['unit'];

    $supplier2 = $_POST['supplier2'];

    $hargasatuan = $_POST['hargasatuan'];

    $keterangan = $_POST['keterangan'];

    $ppn = $_POST['ppn'];

    $diskon = $_POST['diskon'];



    $tanggalbuat_kon = date('Y-m-d', strtotime($tanggalbuat));

    $tanggalkirim_kon = date('Y-m-d', strtotime($tanggalkirim));



    // Get supplier information

    $getSupplierInfo = $conn_aph->prepare("SELECT namasupplier FROM supplier WHERE idsupplier = ?");

    $getSupplierInfo->bind_param("i", $supplier2);

    $getSupplierInfo->execute();

    $supplierInfo = $getSupplierInfo->get_result()->fetch_assoc();

    $namasupplier = $supplierInfo['namasupplier'];

    

    $getSupplierInfo->close();



    // Get item details from stock

    $cekstoksekarang = $conn_aph->prepare("SELECT namabarang FROM stok WHERE idbarang = ?");

    $cekstoksekarang->bind_param("i", $barangnya);

    $cekstoksekarang->execute();

    $result = $cekstoksekarang->get_result();

    $ambildatanya = $result->fetch_assoc();

    $nama_barang = $ambildatanya['namabarang'];

    $cekstoksekarang->close();



    $total_harga = $qty * $hargasatuan;



    $total_diskon = ($diskon > 0) ? ($total_harga * $diskon) / 100 : 0;

    $total_harga_setelah_diskon = $total_harga - $total_diskon;

    $total_ppn = ($ppn > 0) ? ($total_harga_setelah_diskon * $ppn) / 100 : 0;



    // Hitung total harga setelah diskon dan PPN

    $total_setelah_diskon_dan_ppn = $total_harga_setelah_diskon + $total_ppn;



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_aph, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username2 = $rowUsername['username'];



    $updatepermintaan = $conn_aph->prepare("UPDATE permintaan SET tanggal_buat=?, tanggal_permintaan=?, item_barang=?, qty=?, satuan_bentuk=?, harga_satuan=?, ppn=?, diskon=?, total_harga=?, idsupplier=?, nama_supplier_order=?, keterangan=?, user_edit_order=? WHERE id_order=?");

    $updatepermintaan->bind_param("sssisiiidisssi", $tanggalbuat_kon, $tanggalkirim_kon, $nama_barang, $qty, $unit, $hargasatuan, $ppn, $diskon, $total_setelah_diskon_dan_ppn, $supplier2, $namasupplier, $keterangan, $username2, $idp);

    $update_result = $updatepermintaan->execute();

    $updatepermintaan->close();



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

        window.location.href = "ordering.php"; 

        }, 1500);

        </script>';

    } else {

        echo 'Gagal';

        header('location:ordering.php');

    }

}





//HAPUS

if (isset($_POST['hapuspermintaan'])) {

    $idp = $_POST['idp'];



    // Prepare and execute the delete query for persetujuan_request table

    $delete_query2 = $conn_aph->prepare("DELETE FROM persetujuan_request WHERE idorder = ?");

    $delete_query2->bind_param("i", $idp);

    $delete_result2 = $delete_query2->execute();

    $delete_query2->close();



    // If deletion from persetujuan_request is successful, proceed with deleting from permintaan

    if ($delete_result2) {

        // Prepare and execute the delete query for permintaan table

        $delete_query = $conn_aph->prepare("DELETE FROM permintaan WHERE id_order = ?");

        $delete_query->bind_param("i", $idp);

        $delete_result = $delete_query->execute();

        $delete_query->close();



        // Check if both deletions are successful

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

            window.location.href = "ordering.php"; 

            }, 1500);

            </script>';

        } else {

            echo 'Gagal menghapus data dari tabel permintaan';

            header('location:ordering.php');

        }

    } else {

        echo 'Gagal menghapus data dari tabel persetujuan_request';

        header('location:ordering.php');

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