<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'visitor_aph' && $_SESSION['role'] !== 'keuangan_aph' && $_SESSION['role'] !== 'management_aph' && $_SESSION['role'] !== 'owner_aph' && $_SESSION['role'] !== 'ketua_operasional_aph') {
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

    <title>Dashboard</title>

    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <style>
    .card-body {
        font-family: 'Rubik', sans-serif;
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
    /* Gaya untuk item yang aktif/dipilih */
    .nav-link.active,
    .nav-link:hover {
        position: relative;
    }
    /* Shape di belakang item saat aktif/dipilih */
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

    .info-box-3 {
        position: relative;
        overflow: hidden;
    }

    .card .align-self-center {
        transition: transform 0.3s ease; 
    }

    .card:hover .align-self-center {
        transform: scale(1.2) rotate(45deg); 
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
                <div class="grey-bg container-fluid">
                    <section id="minimal-statistics">
                        <div class="row">
                        <div class="col-12 mt-3 mb-1">
                            <h4 class="text-uppercase">Welcome to System</h4>
                            <p>PT Amanah Putera Harun.</p>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12"> 
                            <a href="legal_people.php">
                                <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                        <i class="fas fa-user font-large-2 float-left" style="color: #427D9D ;"></i>
                                        </div>
                                        <div class="media-body text-right">
                                        <h3 style="font-weight: 500; color: #427D9D "><?php
                                        $query = mysqli_prepare($conn_aph, "SELECT * FROM legal_people"); 
                                        mysqli_stmt_execute($query); 
                                        $result = mysqli_stmt_get_result($query);
                                        $count = mysqli_num_rows($result); 
                                    
                                        echo $count;
                                        ?></h3>
                                        <span style="color: black; opacity: 0.8;">Legal People</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <a href="legal.php">
                                <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                        <i class="fas fa-cogs warning font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                        <h3 class="warning" style="font-weight: 500;"><?php
                                        $query2 = mysqli_prepare($conn_aph, "SELECT * FROM legal"); 
                                        mysqli_stmt_execute($query2); 
                                        $result2 = mysqli_stmt_get_result($query2);
                                        $count2 = mysqli_num_rows($result2); 
                                    
                                        echo $count2;
                                        ?></h3>
                                        <span style="color: black; opacity: 0.8;">Legal Operasional</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <a href="legal_infrastruktur.php">
                                <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                        <i class="fas fa-building success font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                        <h3 class="success" style="font-weight: 500;"><?php
                                        $query3 = mysqli_prepare($conn_aph, "SELECT * FROM legal_infrastruktur"); 
                                        mysqli_stmt_execute($query3); 
                                        $result3 = mysqli_stmt_get_result($query3);
                                        $count3 = mysqli_num_rows($result3); 
                                    
                                        echo $count3;
                                        ?></h3>
                                        <span style="color: black; opacity: 0.8;">Legal Infrastruktur</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <a href="hasilaudit.php">
                                <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                        <i class="fas fa-book danger font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                        <h3 class="danger" style="font-weight: 500;"><?php
                                        $query4 = mysqli_prepare($conn_aph, "SELECT * FROM hasil_audit"); 
                                        mysqli_stmt_execute($query4); 
                                        $result4 = mysqli_stmt_get_result($query4);
                                        $count4 = mysqli_num_rows($result4); 
                                    
                                        echo $count4;
                                        ?></h3>
                                        <span style="color: black; opacity: 0.8;">Hasil Audit</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                        <div class="row ">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <a href="barang.php">
                                <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                        <h3 class="danger" style="font-weight: 500;"><?php
                                        $query5 = mysqli_prepare($conn_aph, "SELECT * FROM stok"); 
                                        mysqli_stmt_execute($query5); 
                                        $result5 = mysqli_stmt_get_result($query5);
                                        $count5 = mysqli_num_rows($result5); 
                                    
                                        echo $count5;
                                        ?></h3>
                                        <span style="color: black; opacity: 0.8;">Stok Barang</span>
                                        </div>
                                        <div class="align-self-center">
                                        <i class="fas fa-cubes danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <a href="supplier.php">
                                <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                        <h3 class="success" style="font-weight: 500;"><?php
                                        $query6 = mysqli_prepare($conn_aph, "SELECT * FROM supplier"); 
                                        mysqli_stmt_execute($query6); 
                                        $result6 = mysqli_stmt_get_result($query6);
                                        $count6 = mysqli_num_rows($result6); 
                                    
                                        echo $count6;
                                        ?></h3>
                                        <span style="color: black; opacity: 0.8;">Data Supplier</span>
                                        </div>
                                        <div class="align-self-center">
                                        <i class="fas fa-users success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                    
                        <div class="col-xl-3 col-sm-6 col-12">
                            <a href="karyawan.php">
                                <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                        <h3 class="warning" style="font-weight: 500;"><?php
                                        $query7 = mysqli_prepare($conn_aph, "SELECT * FROM karyawan"); 
                                        mysqli_stmt_execute($query7); 
                                        $result7 = mysqli_stmt_get_result($query7);
                                        $count7 = mysqli_num_rows($result7); 
                                    
                                        echo $count7;
                                        ?></h3>
                                        <span style="color: black; opacity: 0.8;">Data Karyawan</span>
                                        </div>
                                        <div class="align-self-center">
                                        <i class="fas fa-user-tie warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                        
                       
                    </section>
                    
                    <section id="stats-subtitle">
                    <div class="row">
                        <div class="col-12 mt-1 mb-1">
                        <p>
                            <?php 
                            date_default_timezone_set('Asia/Jakarta');
                            $tanggal = date('d M Y');
                            $day = date('D', strtotime($tanggal));
                            $dayList = array(
                                'Sun' => 'Minggu',
                                'Mon' => 'Senin',
                                'Tue' => 'Selasa',
                                'Wed' => 'Rabu',
                                'Thu' => 'Kamis',
                                'Fri' => 'Jumat',
                                'Sat' => 'Sabtu'
                            );
                            echo $dayList[$day].", ".$tanggal;?>
                        </p>
                        </div>
                    </div>

                    </section>
                    </div>

                    <?php
                        if ($role === "owner" || $role === "management" || $role === "keuangan" || $role === "ketua_operasional") {
                    ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header d-flex">
                                        <div class="col-md-6">
                                            <i class="fas fa-check-square mr-1"></i>
                                            Approval Request Order
                                        </div>
                                        <div class="col-md-6 text-right" style="font-size: 13px;">
                                            <a href="request_order.php" style="text-decoration: underline;">view all</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>NAMA BARANG</th>
                                                        <th>QTY</th>
                                                        <th>HARGA SATUAN</th>
                                                        <th>TOTAL HARGA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php

                                                    date_default_timezone_set('Asia/Jakarta');
                                                    $date = date("Y-m-d");


                                                    if ($role === "owner") {
                                                        $ambildatapermintaanREQ = mysqli_query($conn_aph, "SELECT * FROM permintaan WHERE status_request = 'IN PROGRESS' AND tanggal_buat = '$date' AND total_harga >= 10000000");
                                                    } elseif ($role !== "owner") {
                                                        $ambildatapermintaanREQ = mysqli_query($conn_aph, "SELECT * FROM permintaan WHERE status_request = 'IN PROGRESS' AND tanggal_buat = '$date'");
                                                    }
                                                    $i = 1;

                                                    
                                                    if(mysqli_num_rows($ambildatapermintaanREQ) > 0) {
                                                        $i = 1;
                                                        while ($data = mysqli_fetch_array($ambildatapermintaanREQ)) {
                                                            $item_barang_req = $data['item_barang'];
                                                            $qty_req = $data['qty'];
                                                            $harga_satuan_req = $data['harga_satuan'];
                                                            $total_harga_req = $data['total_harga'];
                                                            $namasupplier_req = $data['nama_supplier_order'];
                                                    ?>
                                                            <tr>
                                                                <td><?=$i++;?></td>
                                                                <td><?=$item_barang_req;?></td>
                                                                <td><?=$qty_req;?></td>
                                                                <td><?=$harga_satuan_req;?></td>
                                                                <td><?=$total_harga_req;?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr><td colspan='8' class="text-center">*Tidak ada data hari ini</td></tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header d-flex">
                                        <div class="col-md-6">
                                            <i class="fas fa-shipping-fast mr-1"></i>
                                            Approval Barang Keluar
                                        </div>
                                        <div class="col-md-6 text-right" style="font-size: 13px;">
                                            <a href="approve_keluar.php" style="text-decoration: underline;">view all</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>KODE TRANSAKSI</th>
                                                        <th>NAMA BARANG</th>
                                                        <th>QTY</th>
                                                        <th>TUJUAN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    date_default_timezone_set('Asia/Jakarta');
                                                    $date = date("Y-m-d");
                                                    $ambilsemuadata_keluar = mysqli_query($conn_aph, "SELECT * FROM keluar k, stok s WHERE s.idbarang = k.idbarang AND k.status = 'IN PROGRESS' AND k.tanggal_keluar = '$date'");
                                                    $i = 1;
                                                    if(mysqli_num_rows($ambilsemuadata_keluar) > 0) {
                                                        $i = 1;
                                                        while ($data = mysqli_fetch_array($ambilsemuadata_keluar)) {
                                                            $nama_barang_keluar_app = $data['namabarang'];
                                                            $jumlah_keluar_app = $data['jumlah'];
                                                            $tujuan_app = $data['penerima'];
                                                            $kodeTransaksi_keluar_app = $data['kode_transaksi'];
                                                    ?>
                                                            <tr>
                                                                <td><?=$i++;?></td>
                                                                <td><?=$kodeTransaksi_keluar_app;?></td>
                                                                <td><?=$nama_barang_keluar_app;?></td>
                                                                <td><?=$jumlah_keluar_app;?></td>
                                                                <td><?=$tujuan_app;?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr><td colspan='8' class="text-center">*Tidak ada data hari ini</td></tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <?php
                    }
                    ?>


                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header d-flex">
                                        <div class="col-md-6">
                                            <i class="fas fa-shopping-cart mr-1"></i>
                                            Permintaan Barang
                                        </div>
                                        <div class="col-md-6 text-right" style="font-size: 13px;">
                                            <a href="ordering.php" style="text-decoration: underline;">view all</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>KODE TRANSAKSI</th>
                                                        <th>TANGGAL PERMINTAAN BARANG DIKIRIM</th>
                                                        <th>NAMA BARANG</th>
                                                        <th>QTY</th>
                                                        <th>NAMA SUPPLIER</th>
                                                        <th>TOTAL HARGA</th>
                                                        <th>STATUS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    date_default_timezone_set('Asia/Jakarta');
                                                    $date = date("Y-m-d");
                                                    $ambildatapermintaan = mysqli_query($conn_aph, "SELECT * FROM permintaan where tanggal_buat = '$date'");
                                                    $i = 1;
                                                    if(mysqli_num_rows($ambildatapermintaan) > 0) {
                                                        $i = 1;
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
                                                    
                                                            $tanggalpermintaanindo = TanggalIndo($tanggal_permintaan);
                                                    ?>
                                                            <tr>
                                                                <td><?=$i++;?></td>
                                                                <td><?=$kode_transaksi_request;?></td>
                                                                <td><?=$tanggalpermintaanindo;?></td>
                                                                <td><?=$item_barang;?></td>
                                                                <td><?=$qty;?></td>
                                                                <td><?=$namasupplier;?></td>
                                                                <td><?=$total_harga;?></td>
                                                                <td><?=$status_request;?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr><td colspan='8' class="text-center">*Tidak ada data hari ini</td></tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header d-flex">
                                        <div class="col-md-6">
                                            <i class="fas fa-parachute-box mr-1"></i>
                                            Barang Masuk
                                        </div>
                                        <div class="col-md-6 text-right" style="font-size: 13px;">
                                            <a href="masuk.php" style="text-decoration: underline;">view all</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>KODE TRANSAKSI</th>
                                                        <th>NAMA BARANG</th>
                                                        <th>QTY</th>
                                                        <th>TOTAL HARGA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    date_default_timezone_set('Asia/Jakarta');
                                                    $date = date("Y-m-d");
                                                    $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang WHERE m.tanggal_penerimaan = '$date'");
                                                    $i = 1;
                                                    if(mysqli_num_rows($ambilsemuadata) > 0) {
                                                        $i = 1;
                                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                                            $tanggal_penerimaan = $data['tanggal_penerimaan'];
                                                            $nama_supplier = $data['nama_supplier'];
                                                            $nama_barang = $data['nama_barang'];
                                                            $jumlah = $data['jumlah'];
                                                            $harga_satuan = $data['harga_satuan'];
                                                            $total_harga_masuk = $data['total_harga'];
                                                            $faktur = $data['faktur'];
                                                            $idb = $data['idbarang'];
                                                            $idm = $data['idmasuk'];
                                                            $keterangan = $data['keterangan'];
                                                            $id_supplier = $data['idsupplier'];
                                                            $unit = $data['unit_masuk'];
                                                            $tanggalterima = TanggalIndo($tanggal_penerimaan);
                                                            $kodeTransaksi_masuk = $data['kode_transaksi_masuk'];
                                                    ?>
                                                            <tr>
                                                                <td><?=$i++;?></td>
                                                                <td><?=$kodeTransaksi_masuk;?></td>
                                                                <td><?=$nama_barang;?></td>
                                                                <td><?=$jumlah;?></td>
                                                                <td><?=$total_harga_masuk;?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr><td colspan='8' class="text-center">*Tidak ada data hari ini</td></tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header d-flex">
                                        <div class="col-md-6">
                                            <i class="fas fa-truck mr-1"></i>
                                            Barang Keluar
                                        </div>
                                        <div class="col-md-6 text-right" style="font-size: 13px;">
                                            <a href="keluar.php" style="text-decoration: underline;">view all</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>KODE TRANSAKSI</th>
                                                        <th>NAMA BARANG</th>
                                                        <th>QTY</th>
                                                        <th>TUJUAN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    date_default_timezone_set('Asia/Jakarta');
                                                    $date = date("Y-m-d");
                                                    $ambilsemuadatakeluar = mysqli_query($conn_aph, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar = '$date' ORDER BY k.kode_transaksi ASC");
                                                    $i = 1;
                                                    if(mysqli_num_rows($ambilsemuadatakeluar) > 0) {
                                                        $i = 1;
                                                        while ($data = mysqli_fetch_array($ambilsemuadatakeluar)) {
                                                            $idk = $data['idkeluar'];
                                                            $idb = $data['idbarang'];
                                                            $tanggalkeluar = $data['tanggal_keluar'];
                                                            $nama_barang_keluar = $data['namabarang'];
                                                            $jumlah_keluar = $data['jumlah'];
                                                            $tujuan = $data['penerima'];
                                                            $keperluan = $data['keperluan'];
                                                            $keterangan = $data['keterangank'];
                                                            $unit = $data['units'];
                                                            $status = $data['status'];
                                                            $kodeTransaksi_keluar = $data['kode_transaksi'];
                                                            $tanggalkeluar_indo = TanggalIndo($tanggalkeluar);
                                                    ?>
                                                            <tr>
                                                                <td><?=$i++;?></td>
                                                                <td><?=$kodeTransaksi_keluar;?></td>
                                                                <td><?=$nama_barang_keluar;?></td>
                                                                <td><?=$jumlah_keluar;?></td>
                                                                <td><?=$tujuan;?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr><td colspan='8' class="text-center">*Tidak ada data hari ini</td></tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
        </main>

    </div>

</div>



<!-- body belum ada -->

</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

    <script src="../js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
        });
    });
    </script>
</body>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>\

</html>


<?php
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