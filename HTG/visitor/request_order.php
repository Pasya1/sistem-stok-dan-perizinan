<?php
require '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>REQUEST ORDER BARANG</title>
    <link href="../css/styles.css" rel="stylesheet" />
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
        background-color: #1E7458; 
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
    .icon-button {
        border: none;
        background: none;
        padding: 0;
        font-size: 1rem;
        margin-right: 5px;
        margin-left: 5px; 
        cursor: pointer;
    }

    .icon-button:hover {
        opacity: 0.7;
    }
    .modal-lg {

    max-width: 800px !important;
    display: flex;
    justify-content: center;
    align-items: center;

    }

    </style>
</head>

<body class="sb-nav-fixed">
    <div id="prelouder"></div>
    <?php
    if ($_SESSION['role'] !== 'management_htg' && $_SESSION['role'] !== 'keuangan_htg' && $_SESSION['role'] !== 'owner_htg') {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "error",
            title: "NOT ACCESS ",
            html: "Maaf, Anda tidak memiliki akses Role <strong> MANAGEMENT  </strong>, <strong> KEUANGAN  </strong> dan <strong> OWNER </strong>. Silahkan lakukan login ulang jika ingin mengakses halaman ini",
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
                window.location.href = "../logout.php";
            }
        });
        </script>';

        exit;
    }
    $role = $_SESSION['role'];
    ?>
    <?php include 'navvisit/navvisit.php'; ?>

    <div id="layoutSidenav">
        <?php include 'navvisit/sidenavvisit.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class=" mb-4">
                        <div class="">
                            <h1 class="mt-3 text-center mb-4" style="color:#1E7458;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">APPROVAL PERMINTAAN BARANG</h1>
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
                            <div class="row">
                                <div class="col-md-9">
                                <form method="GET" action="request_order.php" class="form-inline mb-4 ">
                                    <input type="date" name="start_date" class="form-control shadow-sm" required>
                                    <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                                    <select name="tgl_apa" class="form-control shadow-sm" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Tanggal_Buat">Tanggal Buat</option>
                                        <option value="Tanggal_Permintaan">Tanggal Permintaan</option>
                                    </select>  
                                    <button type="submit" name="cari" class="btn btn-custom shadow form-control ml-2" >Search</button>
                                </form>
                                </div>
                                <div class="col-md-3 mt-2">
                                <a href="exportvisitor/exportordering.php" class="btn btn-info mb-2 shadow" style="float: right;"><i class="fas fa-book"></i> Buat Laporan</a>
                                </div>
                            </div>    
                        </div>
                        <div class="">
                            <div class="col-md-12 d-flex">
                                <p><a href="#" id="inProgress" style="color: #1E7458; margin-right: 5px;">In Progress</a><p> / </p><a href="#" id="accepted" style="color: #1E7458; margin-right: 5px; margin-left: 5px;">Accepted</a><p> / </p><a href="#" id="rejected" style="color: #1E7458; margin-left: 5px;">Rejected</a></p>
                            </div>
                        <div class="table-responsive shadow-lg px-3 py-5" id="keinprogress" style="border-radius: 10px;">
                               <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">
                                    <thead style="background-color: #1E7458; color:white;">
                                        <tr>
                                            <th>Aksi ACC</th>
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
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $showOwnerData = false;

                                            if(isset($_GET['cari'])){ 
                                                $mulai = $_GET['start_date']; 
                                                $selesai = $_GET['end_date'];
                                                $tgl_apa = $_GET['tgl_apa'];
                                                
                                                if ($role === "owner") {
                                                    if($mulai != null && $selesai != null && $tgl_apa != null){
                                                        if($tgl_apa == 'Tanggal_Buat') {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND status_request = 'IN PROGRESS' and total_harga >= 10000000");
                                                        } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND status_request = 'IN PROGRESS' and total_harga >= 10000000");
                                                        } else {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'IN PROGRESS' and total_harga >= 10000000");
                                                        }
                                                    } elseif($mulai != null && $selesai == null && $tgl_apa != null) {
                                                        if($tgl_apa == 'Tanggal_Buat') {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat = '$mulai' AND status_request = 'IN PROGRESS' and total_harga >= 10000000");
                                                        } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan = '$mulai' AND status_request = 'IN PROGRESS' and total_harga >= 10000000");
                                                        } else {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'IN PROGRESS' and total_harga >= 10000000");
                                                        }
                                                }
                                                }elseif ($role !== "owner") {
                                                    if($mulai != null && $selesai != null && $tgl_apa != null){
                                                        if($tgl_apa == 'Tanggal_Buat') {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND status_request = 'IN PROGRESS'");
                                                        } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND status_request = 'IN PROGRESS'");
                                                        } else {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'IN PROGRESS'");
                                                        }
                                                    } elseif($mulai != null && $selesai == null && $tgl_apa != null) {
                                                        if($tgl_apa == 'Tanggal_Buat') {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat = '$mulai' AND status_request = 'IN PROGRESS'");
                                                        } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan = '$mulai' AND status_request = 'IN PROGRESS'");
                                                        } else {
                                                            $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'IN PROGRESS'");
                                                        }
                                                }
                                                } else {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'IN PROGRESS'");
                                                }
                                            } else {
                                                if ($role === "owner") {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'IN PROGRESS' and total_harga >= 10000000");
                                                }elseif ($role !== "owner") {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'IN PROGRESS'");
                                                }
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

                                                if ($role === "owner" && $total_harga > 10000000) {
                                                    $showOwnerData = true; 
                                                }

                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                        $result_count_approvals = mysqli_query($conn_htg, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $approvals_count = $row_count_approvals['approvals_count'];

                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                        $result_count_approvals = mysqli_query($conn_htg, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $rejected_count = $row_count_approvals['rejected_count'];

                                                        // Mengambil informasi user yang sudah menyetujui
                                                        $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                        $result_approved_users = mysqli_query($conn_htg, $query_approved_users);
                                                        $approved_users = [];
                                                        while ($row = mysqli_fetch_assoc($result_approved_users)) {
                                                            $approved_users[] = $row['id_user'];
                                                        }

                                                        
                                                        // Mengambil informasi username dari tabel login berdasarkan id_user
                                                        $approved_users_info = [];
                                                        foreach ($approved_users as $user_id) {
                                                            $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                            $result_username = mysqli_query($conn_htg, $query_username);
                                                            $row_username = mysqli_fetch_assoc($result_username);
                                                            $approved_users_info[$user_id] = $row_username['username'];
                                                        }
                                                        
                                                        // Mengambil informasi user yang melakukan penolakan
                                                        $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                        $result_rejected_users = mysqli_query($conn_htg, $query_rejected_users);
                                                        $rejected_users = [];
                                                        while ($row = mysqli_fetch_assoc($result_rejected_users)) {
                                                            $rejected_users[] = $row['id_user'];
                                                        }
                                                        
                                                        // Mengambil Tanggal user yang sudah menyetujui
                                                        $query_approved_users_tgl = "SELECT DISTINCT waktu_approve FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                        $result_approved_users_tgl = mysqli_query($conn_htg, $query_approved_users_tgl);
                                                        $waktu_approve_acc = [];
                                                        while ($row = mysqli_fetch_assoc($result_approved_users_tgl)) {
                                                            $waktu_approve_acc[] = $row['waktu_approve'];
                                                        }
                                                         // Mengambil Tanggal user yang sudah menolak
                                                         $query_rejected_users_tgl = "SELECT DISTINCT waktu_approve FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                         $result_rejected_users_tgl = mysqli_query($conn_htg, $query_rejected_users_tgl);
                                                         $waktu_approve_rejected = [];
                                                         while ($row = mysqli_fetch_assoc($result_rejected_users_tgl)) {
                                                             $waktu_approve_rejected[] = $row['waktu_approve'];
                                                         }

                                                        // Mengambil informasi username dari tabel login berdasarkan id_user untuk user yang melakukan penolakan
                                                        $rejected_users_info = [];
                                                        foreach ($rejected_users as $user_id) {
                                                            $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                            $result_username = mysqli_query($conn_htg, $query_username);
                                                            $row_username = mysqli_fetch_assoc($result_username);
                                                            $rejected_users_info[$user_id] = $row_username['username'];
                                                        }
                                        ?>
                                        <?php    
                                                if ($role === "owner" && $showOwnerData) {?>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                                if ($status_request == 'IN PROGRESS') {
                                                                    $query = "SELECT iduser FROM login WHERE role = ?";
                                                                    $stmt = mysqli_prepare($conn_htg, $query);
                                                                
                                                                    if ($stmt) {
                                                                        mysqli_stmt_bind_param($stmt, "s", $role);
                                                                        mysqli_stmt_execute($stmt);
                                                                        $result = mysqli_stmt_get_result($stmt);
                                                                        $row = mysqli_fetch_assoc($result);
                                                                
                                                                        if ($row) {
                                                                            $id_user = $row['iduser'];
                                                                
                                                                            $query_check_user_action = "SELECT COUNT(*) AS user_action FROM persetujuan_request WHERE idorder = ? AND id_user = ?";
                                                                            $stmt_check_user_action = mysqli_prepare($conn_htg, $query_check_user_action);
                                                                
                                                                            if ($stmt_check_user_action) {
                                                                                mysqli_stmt_bind_param($stmt_check_user_action, "ii", $idp, $id_user);
                                                                                mysqli_stmt_execute($stmt_check_user_action);
                                                                                $result_check_user_action = mysqli_stmt_get_result($stmt_check_user_action);
                                                                                $row_check_user_action = mysqli_fetch_assoc($result_check_user_action);
                                                                                $user_action_count = $row_check_user_action['user_action'];
                                                                
                                                                                if ($user_action_count == 0) {
                                                                                    ?>
                                                                                    <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#confirmationModal1_<?= $idp ?>" style="font-size: 12px;">
                                                                                        Approve?
                                                                                    </button>

                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade" id="confirmationModal1_<?= $idp ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel1_<?= $idp ?>" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title" id="confirmationModalLabel1_<?= $idp ?>">Approval Data Permintaan Barang</h5>
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="modal-body justify-content-center align-items-center " id="modal-content" style="text-align: left;">
                                                                                                <div class="row d-flex justify-content-center">
                                                                                                    <div class="col-md-6">
                                                                                                        <table class="">
                                                                                                                <tr>
                                                                                                                    <td><strong>Kode Transaksi Request:</strong></td>
                                                                                                                    <td><?= $kode_transaksi_request ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Tanggal Pembuatan:</strong></td>
                                                                                                                    <td><?= $tanggalbuatindo ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Tanggal Permintaan:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($tanggalpermintaanindo) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Item Barang:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($item_barang) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Quantity:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($qty) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Satuan Bentuk:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($satuan_bentuk) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Nama Supplier:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($namasupplier) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Harga Satuan:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($harga_satuan) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>PPN:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($ppn) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Diskon:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($diskon) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Total Harga:</strong></td>
                                                                                                                    <td>Rp <?= number_format($total_harga, 0, ',', '.') ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Keterangan:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($keterangan) ?></td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                                                                            <form method="post" style="">
                                                                                                                <input type="hidden" name="idorder" value="<?= $idp ?>">
                                                                                                                <button type="submit" name="reject" class="btn btn-danger"><i class="fas fa-times"></i> Reject</button>
                                                                                                                <button type="submit" name="approve" class="btn btn-success"><i class="fas fa-check"></i> Approve</button>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php
                                                                                } else {
                                                                                    echo '<p style="font-size: 10px; color: #1E7458;"><b>Anda sudah melakukan tindakan untuk permintaan ini.</b> Menunggu tindakan dari user lain.</p>';
                                                                                }
                                                                            } else {
                                                                                echo 'Terjadi kesalahan dalam persiapan pernyataan.';
                                                                            }
                                                                        } else {
                                                                            echo 'Tidak ada user dengan peran tersebut.';
                                                                        }
                                                                    } else {
                                                                        echo 'Terjadi kesalahan dalam persiapan pernyataan.';
                                                                    }
                                                                } else {
                                                                    echo $status_request;
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
                                                    
                                                    </tr>
                                        <?php
                                                } elseif ($role !== "owner") {?>
                                                   <tr>
                                                        <td>
                                                            <?php
                                                                if ($status_request == 'IN PROGRESS') {
                                                                    $query = "SELECT iduser FROM login WHERE role = ?";
                                                                    $stmt = mysqli_prepare($conn_htg, $query);
                                                                
                                                                    if ($stmt) {
                                                                        mysqli_stmt_bind_param($stmt, "s", $role);
                                                                        mysqli_stmt_execute($stmt);
                                                                        $result = mysqli_stmt_get_result($stmt);
                                                                        $row = mysqli_fetch_assoc($result);
                                                                
                                                                        if ($row) {
                                                                            $id_user = $row['iduser'];
                                                                
                                                                            $query_check_user_action = "SELECT COUNT(*) AS user_action FROM persetujuan_request WHERE idorder = ? AND id_user = ?";
                                                                            $stmt_check_user_action = mysqli_prepare($conn_htg, $query_check_user_action);
                                                                
                                                                            if ($stmt_check_user_action) {
                                                                                mysqli_stmt_bind_param($stmt_check_user_action, "ii", $idp, $id_user);
                                                                                mysqli_stmt_execute($stmt_check_user_action);
                                                                                $result_check_user_action = mysqli_stmt_get_result($stmt_check_user_action);
                                                                                $row_check_user_action = mysqli_fetch_assoc($result_check_user_action);
                                                                                $user_action_count = $row_check_user_action['user_action'];
                                                                
                                                                                if ($user_action_count == 0) {
                                                                                    ?>
                                                                                    <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#confirmationModal_<?= $idp ?>" style="font-size: 12px;">
                                                                                        Approve?
                                                                                    </button>

                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade" id="confirmationModal_<?= $idp ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel_<?= $idp ?>" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title" id="confirmationModalLabel_<?= $idp ?>">Approval Data Permintaan Barang</h5>
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="modal-body justify-content-center align-items-center " id="modal-content" style="text-align: left;">
                                                                                                <div class="row d-flex justify-content-center">
                                                                                                    <div class="col-md-6">
                                                                                                        <table class="">
                                                                                                                <tr>
                                                                                                                    <td><strong>Kode Transaksi Request:</strong></td>
                                                                                                                    <td><?= $kode_transaksi_request ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Tanggal Pembuatan:</strong></td>
                                                                                                                    <td><?= $tanggalbuatindo ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Tanggal Permintaan:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($tanggalpermintaanindo) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Item Barang:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($item_barang) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Quantity:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($qty) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Satuan Bentuk:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($satuan_bentuk) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Nama Supplier:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($namasupplier) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Harga Satuan:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($harga_satuan) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>PPN:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($ppn) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Diskon:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($diskon) ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Total Harga:</strong></td>
                                                                                                                    <td>Rp <?= number_format($total_harga, 0, ',', '.') ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td><strong>Keterangan:</strong></td>
                                                                                                                    <td><?= htmlspecialchars($keterangan) ?></td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                                                                            <form method="post" style="">
                                                                                                                <input type="hidden" name="idorder" value="<?= $idp ?>">
                                                                                                                <button type="submit" name="reject" class="btn btn-danger"><i class="fas fa-times"></i> Reject</button>
                                                                                                                <button type="submit" name="approve" class="btn btn-success"><i class="fas fa-check"></i> Approve</button>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php
                                                                                } else {
                                                                                    echo '<p style="font-size: 10px; color: #1E7458;"><b>Anda sudah melakukan tindakan untuk permintaan ini.</b> Menunggu tindakan dari user lain.</p>';
                                                                                }
                                                                            } else {
                                                                                echo 'Terjadi kesalahan dalam persiapan pernyataan.';
                                                                            }
                                                                        } else {
                                                                            echo 'Tidak ada user dengan peran tersebut.';
                                                                        }
                                                                    } else {
                                                                        echo 'Terjadi kesalahan dalam persiapan pernyataan.';
                                                                    }
                                                                } else {
                                                                    echo $status_request;
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
                                                    
                                                    </tr> 
                                        <?php    }
                                        ?>

                                       
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

                                                                printWindow.document.write('<html><head><title>PRINT PERMINTAAN BARANG</title></head><body>');
                                                                printWindow.document.write(judul.outerHTML);
                                                                printWindow.document.write(modalBodyContents);
                                                                printWindow.document.write('</body></html>');

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

                        <!-- ACC TABLE -->
                        <div class="table-responsive shadow-lg px-3 py-5" id="keacc" style="border-radius: 10px;">
                                <table class="table table-bordered text-center" id="dataTable2" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">
                                    <thead style="background-color: #1E7458; color:white;">
                                        <tr>
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
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $showOwnerData = false;

                                            if(isset($_GET['cari'])){ 
                                                $mulai = $_GET['start_date']; 
                                                $selesai = $_GET['end_date'];
                                                $tgl_apa = $_GET['tgl_apa'];
                                                
                                                if($mulai != null && $selesai != null && $tgl_apa != null){
                                                    if($tgl_apa == 'Tanggal_Buat') {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND status_request = 'ACCEPTED'");
                                                    } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND status_request = 'ACCEPTED'");
                                                    } else {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'ACCEPTED'");
                                                    }
                                                } elseif($mulai != null && $selesai == null && $tgl_apa != null) {
                                                    if($tgl_apa == 'Tanggal_Buat') {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat = '$mulai' AND status_request = 'ACCEPTED'");
                                                    } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan = '$mulai' AND status_request = 'ACCEPTED'");
                                                    } else {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'ACCEPTED'");
                                                    }
                                                } else {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'ACCEPTED'");
                                                }
                                            } else {
                                                $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'ACCEPTED'");
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

                                                if ($role === "owner" && $total_harga > 10000000) {
                                                    $showOwnerData = true; 
                                                }

                                                $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                $result_count_approvals = mysqli_query($conn_htg, $query_count_approvals);
                                                $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                $approvals_count = $row_count_approvals['approvals_count'];

                                                $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                $result_count_approvals = mysqli_query($conn_htg, $query_count_approvals);
                                                $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                $rejected_count = $row_count_approvals['rejected_count'];

                                                // Mengambil informasi user yang sudah menyetujui
                                                $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                $result_approved_users = mysqli_query($conn_htg, $query_approved_users);
                                                $approved_users = [];
                                                while ($row = mysqli_fetch_assoc($result_approved_users)) {
                                                    $approved_users[] = $row['id_user'];
                                                }

                                                // Mengambil informasi username dari tabel login berdasarkan id_user
                                                $approved_users_info = [];
                                                foreach ($approved_users as $user_id) {
                                                    $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                    $result_username = mysqli_query($conn_htg, $query_username);
                                                    $row_username = mysqli_fetch_assoc($result_username);
                                                    $approved_users_info[$user_id] = $row_username['username'];
                                                }

                                                // Mengambil informasi user yang melakukan penolakan
                                                $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                $result_rejected_users = mysqli_query($conn_htg, $query_rejected_users);
                                                $rejected_users = [];
                                                while ($row = mysqli_fetch_assoc($result_rejected_users)) {
                                                    $rejected_users[] = $row['id_user'];
                                                }

                                                // Mengambil informasi username dari tabel login berdasarkan id_user untuk user yang melakukan penolakan
                                                $rejected_users_info = [];
                                                foreach ($rejected_users as $user_id) {
                                                    $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                    $result_username = mysqli_query($conn_htg, $query_username);
                                                    $row_username = mysqli_fetch_assoc($result_username);
                                                    $rejected_users_info[$user_id] = $row_username['username'];
                                                }

                                                 // Mengambil Tanggal user yang sudah menyetujui
                                                 $query_approved_users_tgl = "SELECT DISTINCT waktu_approve FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                 $result_approved_users_tgl = mysqli_query($conn_htg, $query_approved_users_tgl);
                                                 $waktu_approve_acc = [];
                                                 while ($row = mysqli_fetch_assoc($result_approved_users_tgl)) {
                                                     $waktu_approve_acc[] = $row['waktu_approve'];
                                                 }
                                                  // Mengambil Tanggal user yang sudah menolak
                                                  $query_rejected_users_tgl = "SELECT DISTINCT waktu_approve FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                  $result_rejected_users_tgl = mysqli_query($conn_htg, $query_rejected_users_tgl);
                                                  $waktu_approve_rejected = [];
                                                  while ($row = mysqli_fetch_assoc($result_rejected_users_tgl)) {
                                                      $waktu_approve_rejected[] = $row['waktu_approve'];
                                                  }
                                        ?>
                                        <?php    
                                                if ($role === "owner" && $showOwnerData) {?>
                                                    <tr style="background-color: rgba(0, 255, 0, 0.2);">
                                                        <td><a href="#" data-toggle="modal" data-target="#statusModal2<?= $idp; ?>"><?= $kode_transaksi_request; ?></a></td>
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
                                                    
                                                    </tr>
                                        <?php
                                                } elseif ($role !== "owner") {?>
                                                   <tr style="background-color: rgba(0, 255, 0, 0.2);">
                                                        <td><a href="#" data-toggle="modal" data-target="#statusModal2<?= $idp; ?>"><?= $kode_transaksi_request; ?></a></td>
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
                                                    
                                                    </tr> 
                                        <?php    }
                                        ?>

                                           <!-- Modal -->
                                            <div class="modal fade" id="statusModal2<?= $idp; ?>" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel2<?= $idp; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex align-items-center justify-content-center" style="text-align: center;">
                                                                <div class="col-md-11">
                                                                    <h5 class="modal-title" id="statusModalLabel2<?= $idp; ?>">Permintaan Barang</h5>
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
                                                            <button type="button" class="btn btn-custom" onclick="printModal2('statusModal2<?= $idp; ?>')"><i class="fas fa-print"></i> Print</button>
                                                        </div>

                                                        <script>
                                                            function printModal2(modalId) {
                                                                
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

                                                                printWindow.document.write('<html><head><title>PRINT PERMINTAAN BARANG</title></head><body>');
                                                                printWindow.document.write(judul.outerHTML);
                                                                printWindow.document.write(modalBodyContents);
                                                                printWindow.document.write('</body></html>');

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


                        <!-- REJECT TABLE -->
                        <div class="table-responsive shadow-lg px-3 py-5" id="kereject" style="border-radius: 10px; margin-top: -23px;">
                                <table class="table table-bordered text-center" id="dataTable3" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">
                                    <thead style="background-color: #1E7458; color:white;">
                                        <tr>
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
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $showOwnerData = false;

                                            if(isset($_GET['cari'])){ 
                                                $mulai = $_GET['start_date']; 
                                                $selesai = $_GET['end_date'];
                                                $tgl_apa = $_GET['tgl_apa'];
                                                
                                                if($mulai != null && $selesai != null && $tgl_apa != null){
                                                    if($tgl_apa == 'Tanggal_Buat') {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND status_request = 'REJECTED'");
                                                    } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND status_request = 'REJECTED'");
                                                    } else {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'REJECTED'");
                                                    }
                                                } elseif($mulai != null && $selesai == null && $tgl_apa != null) {
                                                    if($tgl_apa == 'Tanggal_Buat') {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat = '$mulai' AND status_request = 'REJECTED'");
                                                    } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan = '$mulai' AND status_request = 'REJECTED'");
                                                    } else {
                                                        $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'REJECTED'");
                                                    }
                                                } else {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'REJECTED'");
                                                }
                                            } else {
                                                $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan where status_request = 'REJECTED'");
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

                                                if ($role === "owner" && $total_harga > 10000000) {
                                                    $showOwnerData = true; 
                                                }

                                                $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                $result_count_approvals = mysqli_query($conn_htg, $query_count_approvals);
                                                $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                $approvals_count = $row_count_approvals['approvals_count'];

                                                $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                $result_count_approvals = mysqli_query($conn_htg, $query_count_approvals);
                                                $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                $rejected_count = $row_count_approvals['rejected_count'];

                                                // Mengambil informasi user yang sudah menyetujui
                                                $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                $result_approved_users = mysqli_query($conn_htg, $query_approved_users);
                                                $approved_users = [];
                                                while ($row = mysqli_fetch_assoc($result_approved_users)) {
                                                    $approved_users[] = $row['id_user'];
                                                }

                                                // Mengambil informasi username dari tabel login berdasarkan id_user
                                                $approved_users_info = [];
                                                foreach ($approved_users as $user_id) {
                                                    $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                    $result_username = mysqli_query($conn_htg, $query_username);
                                                    $row_username = mysqli_fetch_assoc($result_username);
                                                    $approved_users_info[$user_id] = $row_username['username'];
                                                }

                                                // Mengambil informasi user yang melakukan penolakan
                                                $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                $result_rejected_users = mysqli_query($conn_htg, $query_rejected_users);
                                                $rejected_users = [];
                                                while ($row = mysqli_fetch_assoc($result_rejected_users)) {
                                                    $rejected_users[] = $row['id_user'];
                                                }

                                                // Mengambil informasi username dari tabel login berdasarkan id_user untuk user yang melakukan penolakan
                                                $rejected_users_info = [];
                                                foreach ($rejected_users as $user_id) {
                                                    $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                    $result_username = mysqli_query($conn_htg, $query_username);
                                                    $row_username = mysqli_fetch_assoc($result_username);
                                                    $rejected_users_info[$user_id] = $row_username['username'];
                                                }

                                                 // Mengambil Tanggal user yang sudah menyetujui
                                                 $query_approved_users_tgl = "SELECT DISTINCT waktu_approve FROM persetujuan_request WHERE idorder = $idp AND aksi = 'approve'";
                                                 $result_approved_users_tgl = mysqli_query($conn_htg, $query_approved_users_tgl);
                                                 $waktu_approve_acc = [];
                                                 while ($row = mysqli_fetch_assoc($result_approved_users_tgl)) {
                                                     $waktu_approve_acc[] = $row['waktu_approve'];
                                                 }
                                                  // Mengambil Tanggal user yang sudah menolak
                                                  $query_rejected_users_tgl = "SELECT DISTINCT waktu_approve FROM persetujuan_request WHERE idorder = $idp AND aksi = 'reject'";
                                                  $result_rejected_users_tgl = mysqli_query($conn_htg, $query_rejected_users_tgl);
                                                  $waktu_approve_rejected = [];
                                                  while ($row = mysqli_fetch_assoc($result_rejected_users_tgl)) {
                                                      $waktu_approve_rejected[] = $row['waktu_approve'];
                                                  }
                                        ?>
                                        <?php    
                                                if ($role === "owner" && $showOwnerData) {?>
                                                    <tr style="background-color: rgba(255, 0, 0, 0.2);">
                                                        <td><a href="#" data-toggle="modal" data-target="#statusModal3<?= $idp; ?>"><?= $kode_transaksi_request; ?></a></td>
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
                                                    
                                                    </tr>
                                        <?php
                                                } elseif ($role !== "owner") {?>
                                                   <tr style="background-color: rgba(255, 0, 0, 0.2);">
                                                        <td><a href="#" data-toggle="modal" data-target="#statusModal3<?= $idp; ?>"><?= $kode_transaksi_request; ?></a></td>
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
                                                    
                                                    </tr> 
                                        <?php    }
                                        ?>


                                             <!-- Modal -->
                                             <div class="modal fade" id="statusModal3<?= $idp; ?>" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel3<?= $idp; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex align-items-center justify-content-center" style="text-align: center;">
                                                                <div class="col-md-11">
                                                                    <h5 class="modal-title" id="statusModalLabel3<?= $idp; ?>">Permintaan Barang</h5>
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
                                                            <button type="button" class="btn btn-custom" onclick="printModal3('statusModal3<?= $idp; ?>')"><i class="fas fa-print"></i> Print</button>
                                                        </div>

                                                        <script>
                                                            function printModal3(modalId) {
                                                                
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

                                                                printWindow.document.write('<html><head><title>PRINT PERMINTAAN BARANG</title></head><body>');
                                                                printWindow.document.write(judul.outerHTML);
                                                                printWindow.document.write(modalBodyContents);
                                                                printWindow.document.write('</body></html>');

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
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/datatables-demo.js"></script>

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
                    $('#dataTable').DataTable().destroy(); 
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
        $(document).ready(function() {
            $('#dataTable2').DataTable({
                "paging": true, 
                "searching": true, 
            });
            if ($.fn.DataTable.isDataTable('#dataTable2')) {
                        $('#dataTable2').DataTable().destroy(); 
                    }
                    
                    $('#dataTable2').DataTable({
                        "pageLength": 50,
                        // Konfigurasi lainnya
                    });
        });
        $(document).ready(function() {
            $('#dataTable3').DataTable({
                "paging": true, 
                "searching": true, 
            });
            if ($.fn.DataTable.isDataTable('#dataTable3')) {
                        $('#dataTable3').DataTable().destroy(); // Menghancurkan inisialisasi DataTable sebelumnya
                    }
                    
                    $('#dataTable3').DataTable({
                        "pageLength": 50,
                        // Konfigurasi lainnya
                    });
        });
    </script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const inProgress = document.getElementById("inProgress");
    const accepted = document.getElementById("accepted");
    const rejected = document.getElementById("rejected");

    const keinprogress = document.getElementById("keinprogress");
    const keacc = document.getElementById("keacc");
    const kereject = document.getElementById("kereject");

    // Set tab default sebagai "In Progress" dan tampilkan tabel "keinprogress"
    keinprogress.style.display = "block";
    keacc.style.display = "none";
    kereject.style.display = "none";

    // Set teks "In Progress" menjadi tebal (gunakan font-weight: bold;)
    inProgress.style.fontWeight = "bold";

    inProgress.addEventListener("click", function() {
        keinprogress.style.display = "block";
        keacc.style.display = "none";
        kereject.style.display = "none";
        
        // Set gaya teks menjadi tebal untuk tab yang aktif
        inProgress.style.fontWeight = "bold";
        accepted.style.fontWeight = "normal";
        rejected.style.fontWeight = "normal";
    });

    accepted.addEventListener("click", function() {
        keinprogress.style.display = "none";
        keacc.style.display = "block";
        kereject.style.display = "none";

        // Set gaya teks menjadi tebal untuk tab yang aktif
        inProgress.style.fontWeight = "normal";
        accepted.style.fontWeight = "bold";
        rejected.style.fontWeight = "normal";
    });

    rejected.addEventListener("click", function() {
        keinprogress.style.display = "none";
        keacc.style.display = "none";
        kereject.style.display = "block";

        // Set gaya teks menjadi tebal untuk tab yang aktif
        inProgress.style.fontWeight = "normal";
        accepted.style.fontWeight = "normal";
        rejected.style.fontWeight = "bold";
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve']) || isset($_POST['reject'])) {
        $id_order = $_POST['idorder'];
        $role = $_SESSION['role']; 

        $query_get_user_id = "SELECT iduser FROM login WHERE role = '$role'";
        $result_user_id = mysqli_query($conn_htg, $query_get_user_id);

        if ($result_user_id) {
            $row = mysqli_fetch_assoc($result_user_id);
            $id_user = $row['iduser'];
        }

        //Menunjukan apakah akan approve atau reject
        $aksi = isset($_POST['approve']) ? 'approve' : 'reject';

        if ($aksi == 'approve') {
            echo '<script type="text/javascript">      
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Anda Telah Melakukan Tindakan ACCEPTED",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () { 
                        window.location.href = "request_order.php"; 
                    }, 1500);
                </script>';
        } elseif ($aksi == 'reject') {
            echo '<script type="text/javascript">      
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Anda Telah Melakukan Tindakan REJECTED",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () { 
                        window.location.href = "request_order.php"; 
                    }, 1500);
                </script>';
        }
        
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_approve = date("Y-m-d");
        

        // Simpan data persetujuan ke dalam tabel persetujuan
        $query_add_approval = "INSERT INTO persetujuan_request (idorder, id_user, aksi, waktu_approve) VALUES ($id_order, $id_user, '$aksi', '$tanggal_approve')";
        mysqli_query($conn_htg, $query_add_approval);

        // Hitung jumlah persetujuan/approval yang sudah ada untuk idorder dari tabel persetujuan
        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_request WHERE idorder = $id_order AND aksi = 'approve'";
        $result_count_approvals = mysqli_query($conn_htg, $query_count_approvals);
        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
        $approvals_count = $row_count_approvals['approvals_count'];

        // Hitung jumlah penolakan/reject yang sudah ada untuk idorder dari tabel persetujuan
        $query_count_rejects = "SELECT COUNT(DISTINCT id_user) AS rejects_count FROM persetujuan_request WHERE idorder = $id_order AND aksi = 'reject'";
        $result_count_rejects = mysqli_query($conn_htg, $query_count_rejects);
        $row_count_rejects = mysqli_fetch_assoc($result_count_rejects);
        $rejects_count = $row_count_rejects['rejects_count'];


        $query_get_status = "SELECT status_request, total_harga FROM permintaan WHERE id_order = $id_order";
        $result_get_status = mysqli_query($conn_htg, $query_get_status);

        if ($result_get_status) {
            $row_status = mysqli_fetch_assoc($result_get_status);
            $current_status = $row_status['status_request'];
            $total_harga = $row_status['total_harga'];
        
            $minimum_approval_amount = 10000000;

            if ($current_status == 'IN PROGRESS') {
                if ($total_harga > $minimum_approval_amount) {
                    if ($approvals_count >= 3 || $rejects_count >= 3) {
                        if ($aksi == 'approve') { // Menggunakan $aksi untuk menentukan tindakan
                            $query_update_status = "UPDATE permintaan SET status_request = 'ACCEPTED' WHERE id_order = $id_order";
                        } elseif ($aksi == 'reject') { // Menggunakan $aksi untuk menentukan tindakan
                            $query_update_status = "UPDATE permintaan SET status_request = 'REJECTED' WHERE id_order = $id_order";
                        }
                    }
                } else {
                    if ($approvals_count >= 2 || $rejects_count >= 2) {
                        if ($aksi == 'approve') { // Menggunakan $aksi untuk menentukan tindakan
                            $query_update_status = "UPDATE permintaan SET status_request = 'ACCEPTED' WHERE id_order = $id_order";
                        } elseif ($aksi == 'reject') { // Menggunakan $aksi untuk menentukan tindakan
                            $query_update_status = "UPDATE permintaan SET status_request = 'REJECTED' WHERE id_order = $id_order";
                        }
                    }
                }

                if (isset($query_update_status)) {
                    mysqli_query($conn_htg, $query_update_status);
                    if(mysqli_affected_rows($conn_htg) > 0){
                        if ($aksi == 'approve') {
                            echo '<script type="text/javascript">      
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Status telah diubah menjadi ACCEPTED",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function () { 
                            window.location.href = "request_order.php"; 
                            }, 1500);
                            </script>';
                        } elseif ($aksi == 'reject') {
                            echo '<script type="text/javascript">      
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Status telah diubah menjadi REJECTED",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function () { 
                            window.location.href = "request_order.php"; 
                            }, 1500);
                            </script>';
                        }
                        exit();
                    } else {
                        echo '<script>alert("Gagal mengubah status.");</script>';
                    }
                }
            }
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