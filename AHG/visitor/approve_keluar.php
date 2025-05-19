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
    <title>Approve Barang Keluar</title>
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
    </style>
</head>

<body class="sb-nav-fixed">
    <div id="prelouder"></div>
    <?php
    if ($_SESSION['role'] !== 'management_ahg' && $_SESSION['role'] !== 'ketua_operasional_ahg') {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "error",
            title: "NOT ACCESS ",
            html: "Maaf, Anda tidak memiliki akses Role <strong> MANAGEMENT  </strong> dan <strong> KETUA_OPERASIONAL </strong>. Silahkan lakukan login ulang jika ingin mengakses halaman ini",
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
                            <h1 class="mt-3 text-center mb-4" style="color:#DD5555;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">APPROVAL BARANG KELUAR</h1>
                        </div>
                        <div class="">
                            <div class="row pt-3" style="font-size: 11px; opacity: 0.9;">
                                <div class="col-md-2">
                                    Dari Tanggal :
                                </div>
                                <div class="col-md-2">
                                    Sampai Tanggal :
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <form method="GET" action="approve_keluar.php" class="form-inline mb-4">
                                        <input type="date" name="start_date" class="form-control shadow-sm" required>
                                        <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                                        <button type="submit" name="cari" class="btn btn-custom shadow form-control" >Search</button>
                                    </form>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <a href="exportvisitor/exportkeluar.php" class="btn btn-info mb-2 shadow" style="float: right;"><i class="fas fa-book"></i> Buat Laporan</a>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex">
                                <p><a href="#" id="inProgress" style="color: #DD5555; margin-right: 5px;">In Progress</a><p> / </p><a href="#" id="accepted" style="color: #DD5555; margin-right: 5px; margin-left: 5px;">Accepted</a><p> / </p><a href="#" id="rejected" style="color: #DD5555; margin-left: 5px;">Rejected</a></p>
                            </div>
                        <div class="table-responsive shadow-lg px-3 py-5" id="keinprogress" style="border-radius: 10px;">
                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">
                                    <thead style="background-color: #DD5555; color:white;">
                                        <tr>
                                            <th>Aksi ACC</th>
                                            <th>No Transaksi</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Nama Barang</th>
                                            <th>Gambar Barang</th>
                                            <th>Qty</th>
                                            <th>Unit</th>
                                            <th>Keperluan</th>
                                            <th>Tujuan/Penerima</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if(isset($_GET['cari'])){ 
                                            $mulai = $_GET['start_date']; 
                                            $selesai = $_GET['end_date'];
                                            
                                            if($mulai != null && $selesai != null){
                                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND k.status = 'IN PROGRESS' ORDER BY k.kode_transaksi ASC");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar ='$mulai' AND k.status = 'IN PROGRESS' ORDER BY k.kode_transaksi ASC");
                                            } else {
                                                $ambilsemuadata = mysqli_query($conn_ahg, "select * from keluar k, stok s where s.idbarang = k.idbarang AND k.status = 'IN PROGRESS' ORDER BY k.kode_transaksi ASC");
                                            }
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn_ahg, "select * from keluar k, stok s where s.idbarang = k.idbarang AND k.status = 'IN PROGRESS' ORDER BY k.kode_transaksi ASC");
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
                                                $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
                                            }
                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                        $result_count_approvals = mysqli_query($conn_ahg, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $approvals_count = $row_count_approvals['approvals_count'];
                                                        
                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_count_approvals = mysqli_query($conn_ahg, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $rejected_count = $row_count_approvals['rejected_count'];
                                                        
                                                         // Mengambil informasi user yang sudah menyetujui
                                                         $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                         $result_approved_users = mysqli_query($conn_ahg, $query_approved_users);
                                                         $approved_users = [];
                                                         while ($row = mysqli_fetch_assoc($result_approved_users)) {
                                                             $approved_users[] = $row['id_user'];
                                                         }
 
                                                         $approved_users_info = [];
                                                         foreach ($approved_users as $user_id) {
                                                             $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                             $result_username = mysqli_query($conn_ahg, $query_username);
                                                             $row_username = mysqli_fetch_assoc($result_username);
                                                             $approved_users_info[$user_id] = $row_username['username'];
                                                         }

                                                        // Mengambil informasi user yang melakukan penolakan
                                                        $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_rejected_users = mysqli_query($conn_ahg, $query_rejected_users);
                                                        $rejected_users = [];
                                                        while ($row = mysqli_fetch_assoc($result_rejected_users)) {
                                                            $rejected_users[] = $row['id_user'];
                                                        }

                                                        // Mengambil informasi username dari tabel login berdasarkan id_user untuk user yang melakukan penolakan
                                                        $rejected_users_info = [];
                                                        foreach ($rejected_users as $user_id) {
                                                            $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                            $result_username = mysqli_query($conn_ahg, $query_username);
                                                            $row_username = mysqli_fetch_assoc($result_username);
                                                            $rejected_users_info[$user_id] = $row_username['username'];
                                                        }

                                                        // Mengambil Tanggal user yang sudah menyetujui
                                                        $query_approved_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                        $result_approved_users_tgl = mysqli_query($conn_ahg, $query_approved_users_tgl);
                                                        $waktu_approve_acc = [];
                                                        while ($row = mysqli_fetch_assoc($result_approved_users_tgl)) {
                                                            $waktu_approve_acc[] = $row['waktu_approve_keluar'];
                                                        }
                                                         // Mengambil Tanggal user yang sudah menolak
                                                         $query_rejected_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                         $result_rejected_users_tgl = mysqli_query($conn_ahg, $query_rejected_users_tgl);
                                                         $waktu_approve_rejected = [];
                                                         while ($row = mysqli_fetch_assoc($result_rejected_users_tgl)) {
                                                             $waktu_approve_rejected[] = $row['waktu_approve_keluar'];
                                                         }


                                          
                                        ?>

                                            <tr>
                                                <td>
                                                    <?php
                                                        if ($status == 'IN PROGRESS') {
                                                            $query = "SELECT iduser FROM login WHERE role = ?";
                                                            $stmt = mysqli_prepare($conn_ahg, $query);
                                                        
                                                            if ($stmt) {
                                                                mysqli_stmt_bind_param($stmt, "s", $role);
                                                                mysqli_stmt_execute($stmt);
                                                                $result = mysqli_stmt_get_result($stmt);
                                                                $row = mysqli_fetch_assoc($result);
                                                        
                                                                if ($row) {
                                                                    $id_user = $row['iduser'];
                                                        
                                                                    $query_check_user_action = "SELECT COUNT(*) AS user_action FROM persetujuan_keluar WHERE id_keluar = ? AND id_user = ?";
                                                                    $stmt_check_user_action = mysqli_prepare($conn_ahg, $query_check_user_action);
                                                        
                                                                    if ($stmt_check_user_action) {
                                                                        mysqli_stmt_bind_param($stmt_check_user_action, "ii", $idk, $id_user);
                                                                        mysqli_stmt_execute($stmt_check_user_action);
                                                                        $result_check_user_action = mysqli_stmt_get_result($stmt_check_user_action);
                                                                        $row_check_user_action = mysqli_fetch_assoc($result_check_user_action);
                                                                        $user_action_count = $row_check_user_action['user_action'];
                                                        
                                                                        if ($user_action_count == 0) {
                                                                            ?>
                                                                                    <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#confirmationModal1_<?= $idk ?>" style="font-size: 12px;">
                                                                                        Approve?
                                                                                    </button>

                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade" id="confirmationModal1_<?= $idk ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel1_<?= $idk ?>" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title" id="confirmationModalLabel1_<?= $idk ?>">Approval Data Barang Keluar</h5>
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="modal-body justify-content-center align-items-center " id="modal-content" style="text-align: left;">
                                                                                                <div class="row d-flex justify-content-center">
                                                                                                    <div class="col-md-6">
                                                                                                        <table class="">
                                                                                                            <tr>
                                                                                                                <td><strong>Kode Transaksi Keluar:</strong></td>
                                                                                                                <td><?= $kodeTransaksi; ?></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td><strong>Tanggal Keluar:</strong></td>
                                                                                                                <td><?= htmlspecialchars($tanggalkeluar_indo) ?></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td><strong>Nama Barang:</strong></td>
                                                                                                                <td><?= htmlspecialchars($nama_barang) ?></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td><strong>Jumlah Barang:</strong></td>
                                                                                                                <td><?= htmlspecialchars($jumlah) ?></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td><strong>Unit:</strong></td>
                                                                                                                <td><?= htmlspecialchars($unit) ?></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td><strong>Keperluan:</strong></td>
                                                                                                                <td><?= htmlspecialchars($keperluan) ?></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td><strong>Penerima:</strong></td>
                                                                                                                <td><?= htmlspecialchars($tujuan) ?></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td><strong>Keterangan:</strong></td>
                                                                                                                <td><?= htmlspecialchars($keterangan) ?></td>
                                                                                                            </tr>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                                                                            <form method="post" style="">
                                                                                                                <input type="hidden" name="idkeluar" value="<?= $idk ?>">
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
                                                                            echo '<p style="font-size: 10px; color: #DD5555;"><b>Anda sudah melakukan tindakan untuk permintaan ini.</b> Menunggu tindakan dari user lain.</p>';
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
                                                            echo $status;
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
                                               
                                            </tr>

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

                                                                printWindow.document.write('<html><head><title>PRINT BARANG KELUAR</title></head><body>');
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
                                    <thead style="background-color: #DD5555; color:white;">
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Nama Barang</th>
                                            <th>Gambar Barang</th>
                                            <th>Qty</th>
                                            <th>Unit</th>
                                            <th>Keperluan</th>
                                            <th>Tujuan/Penerima</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if(isset($_GET['cari'])){ 
                                            $mulai = $_GET['start_date']; 
                                            $selesai = $_GET['end_date'];
                                            
                                            if($mulai != null && $selesai != null){
                                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND k.status = 'ACCEPTED' ORDER BY k.kode_transaksi ASC");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar ='$mulai' AND k.status = 'ACCEPTED' ORDER BY k.kode_transaksi ASC");
                                            } else {
                                                $ambilsemuadata = mysqli_query($conn_ahg, "select * from keluar k, stok s where s.idbarang = k.idbarang AND k.status = 'ACCEPTED' ORDER BY k.kode_transaksi ASC");
                                            }
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn_ahg, "select * from keluar k, stok s where s.idbarang = k.idbarang AND k.status = 'ACCEPTED' ORDER BY k.kode_transaksi ASC");
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
                                                $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
                                            }
                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                        $result_count_approvals = mysqli_query($conn_ahg, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $approvals_count = $row_count_approvals['approvals_count'];
                                                        
                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_count_approvals = mysqli_query($conn_ahg, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $rejected_count = $row_count_approvals['rejected_count'];
                                                        
                                                         // Mengambil informasi user yang sudah menyetujui
                                                         $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                         $result_approved_users = mysqli_query($conn_ahg, $query_approved_users);
                                                         $approved_users = [];
                                                         while ($row = mysqli_fetch_assoc($result_approved_users)) {
                                                             $approved_users[] = $row['id_user'];
                                                         }
 
                                                         $approved_users_info = [];
                                                         foreach ($approved_users as $user_id) {
                                                             $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                             $result_username = mysqli_query($conn_ahg, $query_username);
                                                             $row_username = mysqli_fetch_assoc($result_username);
                                                             $approved_users_info[$user_id] = $row_username['username'];
                                                         }

                                                        // Mengambil informasi user yang melakukan penolakan
                                                        $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_rejected_users = mysqli_query($conn_ahg, $query_rejected_users);
                                                        $rejected_users = [];
                                                        while ($row = mysqli_fetch_assoc($result_rejected_users)) {
                                                            $rejected_users[] = $row['id_user'];
                                                        }

                                                        // Mengambil informasi username dari tabel login berdasarkan id_user untuk user yang melakukan penolakan
                                                        $rejected_users_info = [];
                                                        foreach ($rejected_users as $user_id) {
                                                            $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                            $result_username = mysqli_query($conn_ahg, $query_username);
                                                            $row_username = mysqli_fetch_assoc($result_username);
                                                            $rejected_users_info[$user_id] = $row_username['username'];
                                                        }

                                                        // Mengambil Tanggal user yang sudah menyetujui
                                                        $query_approved_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                        $result_approved_users_tgl = mysqli_query($conn_ahg, $query_approved_users_tgl);
                                                        $waktu_approve_acc = [];
                                                        while ($row = mysqli_fetch_assoc($result_approved_users_tgl)) {
                                                            $waktu_approve_acc[] = $row['waktu_approve_keluar'];
                                                        }
                                                         // Mengambil Tanggal user yang sudah menolak
                                                         $query_rejected_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                         $result_rejected_users_tgl = mysqli_query($conn_ahg, $query_rejected_users_tgl);
                                                         $waktu_approve_rejected = [];
                                                         while ($row = mysqli_fetch_assoc($result_rejected_users_tgl)) {
                                                             $waktu_approve_rejected[] = $row['waktu_approve_keluar'];
                                                         }
                                          
                                        ?>

                                            <tr style="background-color: rgba(0, 255, 0, 0.2);">
                                                <td><a href="#" data-toggle="modal" data-target="#statusModal2<?= $idk; ?>"><?= $kodeTransaksi; ?></a></td>
                                                <td><?= htmlspecialchars($tanggalkeluar_indo) ?></td>
                                                <td><?= htmlspecialchars($nama_barang) ?></td>
                                                <td><?= $gambar; ?></td>
                                                <td><?= htmlspecialchars($jumlah) ?></td>
                                                <td><?= htmlspecialchars($unit) ?></td>
                                                <td><?= htmlspecialchars($keperluan) ?></td>
                                                <td><?= htmlspecialchars($tujuan) ?></td>
                                                <td><?= htmlspecialchars($keterangan) ?></td>
                                               
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="statusModal2<?= $idk; ?>" tabindex="-1" role="dialog" aria-labelledby="statusModal2Label<?= $idk; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="text-align: center;">
                                                            <h5 class="modal-title" id="statusModal2Label<?= $idk; ?>">Status Barang Keluar</h5>
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
                                                            <button type="button" class="btn btn-custom" onclick="printModal3('statusModal2<?= $idk; ?>')"><i class="fas fa-print"></i> Print</button>
                                                        </div>
                                                        <script>
                                                            function printModal3(modalId) {
                                                                
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

                                                                printWindow.document.write('<html><head><title>PRINT BARANG KELUAR</title></head><body>');
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
                                    <thead style="background-color: #DD5555; color:white;">
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Nama Barang</th>
                                            <th>Gambar Barang</th>
                                            <th>Qty</th>
                                            <th>Unit</th>
                                            <th>Keperluan</th>
                                            <th>Tujuan/Penerima</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if(isset($_GET['cari'])){ 
                                            $mulai = $_GET['start_date']; 
                                            $selesai = $_GET['end_date'];
                                            
                                            if($mulai != null && $selesai != null){
                                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND k.status = 'REJECTED' ORDER BY k.kode_transaksi ASC");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar ='$mulai' AND k.status = 'REJECTED' ORDER BY k.kode_transaksi ASC");
                                            } else {
                                                $ambilsemuadata = mysqli_query($conn_ahg, "select * from keluar k, stok s where s.idbarang = k.idbarang AND k.status = 'REJECTED' ORDER BY k.kode_transaksi ASC");
                                            }
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn_ahg, "select * from keluar k, stok s where s.idbarang = k.idbarang AND k.status = 'REJECTED' ORDER BY k.kode_transaksi ASC");
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
                                                $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
                                            }
                                            
                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                        $result_count_approvals = mysqli_query($conn_ahg, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $approvals_count = $row_count_approvals['approvals_count'];
                                                        
                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_count_approvals = mysqli_query($conn_ahg, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $rejected_count = $row_count_approvals['rejected_count'];
                                                        
                                                         // Mengambil informasi user yang sudah menyetujui
                                                         $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                         $result_approved_users = mysqli_query($conn_ahg, $query_approved_users);
                                                         $approved_users = [];
                                                         while ($row = mysqli_fetch_assoc($result_approved_users)) {
                                                             $approved_users[] = $row['id_user'];
                                                         }
 
                                                         $approved_users_info = [];
                                                         foreach ($approved_users as $user_id) {
                                                             $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                             $result_username = mysqli_query($conn_ahg, $query_username);
                                                             $row_username = mysqli_fetch_assoc($result_username);
                                                             $approved_users_info[$user_id] = $row_username['username'];
                                                         }

                                                        // Mengambil informasi user yang melakukan penolakan
                                                        $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_rejected_users = mysqli_query($conn_ahg, $query_rejected_users);
                                                        $rejected_users = [];
                                                        while ($row = mysqli_fetch_assoc($result_rejected_users)) {
                                                            $rejected_users[] = $row['id_user'];
                                                        }

                                                        // Mengambil informasi username dari tabel login berdasarkan id_user untuk user yang melakukan penolakan
                                                        $rejected_users_info = [];
                                                        foreach ($rejected_users as $user_id) {
                                                            $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                            $result_username = mysqli_query($conn_ahg, $query_username);
                                                            $row_username = mysqli_fetch_assoc($result_username);
                                                            $rejected_users_info[$user_id] = $row_username['username'];
                                                        }

                                                        // Mengambil Tanggal user yang sudah menyetujui
                                                        $query_approved_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                        $result_approved_users_tgl = mysqli_query($conn_ahg, $query_approved_users_tgl);
                                                        $waktu_approve_acc = [];
                                                        while ($row = mysqli_fetch_assoc($result_approved_users_tgl)) {
                                                            $waktu_approve_acc[] = $row['waktu_approve_keluar'];
                                                        }
                                                         // Mengambil Tanggal user yang sudah menolak
                                                         $query_rejected_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                         $result_rejected_users_tgl = mysqli_query($conn_ahg, $query_rejected_users_tgl);
                                                         $waktu_approve_rejected = [];
                                                         while ($row = mysqli_fetch_assoc($result_rejected_users_tgl)) {
                                                             $waktu_approve_rejected[] = $row['waktu_approve_keluar'];
                                                         }
                                          
                                        ?>

                                            <tr style="background-color: rgba(255, 0, 0, 0.2);">
                                                <td><a href="#" data-toggle="modal" data-target="#statusModal3<?= $idk; ?>"><?= $kodeTransaksi; ?></a></td>
                                                <td><?= htmlspecialchars($tanggalkeluar_indo) ?></td>
                                                <td><?= htmlspecialchars($nama_barang) ?></td>
                                                <td><?= $gambar; ?></td>
                                                <td><?= htmlspecialchars($jumlah) ?></td>
                                                <td><?= htmlspecialchars($unit) ?></td>
                                                <td><?= htmlspecialchars($keperluan) ?></td>
                                                <td><?= htmlspecialchars($tujuan) ?></td>
                                                <td><?= htmlspecialchars($keterangan) ?></td>
                                               
                                            </tr>
                                               <!-- Modal -->
                                               <div class="modal fade" id="statusModal3<?= $idk; ?>" tabindex="-1" role="dialog" aria-labelledby="statusModal3Label<?= $idk; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="text-align: center;">
                                                            <h5 class="modal-title" id="statusModal3Label<?= $idk; ?>">Status Barang Keluar</h5>
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
                                                            <button type="button" class="btn btn-custom" onclick="printModal3('statusModal3<?= $idk; ?>')"><i class="fas fa-print"></i> Print</button>
                                                        </div>
                                                        <script>
                                                            function printModal3(modalId) {
                                                                
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

                                                                printWindow.document.write('<html><head><title>PRINT BARANG KELUAR</title></head><body>');
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
                    // Konfigurasi lainnya
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
                    });
        });
        $(document).ready(function() {
            $('#dataTable3').DataTable({
                "paging": true, 
                "searching": true, 
            });
            if ($.fn.DataTable.isDataTable('#dataTable3')) {
                        $('#dataTable3').DataTable().destroy(); 
                    }
                    
                    $('#dataTable3').DataTable({
                        "pageLength": 50,
                        
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
        $id_keluar = $_POST['idkeluar'];
        $role = $_SESSION['role']; 

        $query_get_user_id = "SELECT iduser FROM login WHERE role = '$role'";
        $result_user_id = mysqli_query($conn_ahg, $query_get_user_id);

        if ($result_user_id) {
            $row = mysqli_fetch_assoc($result_user_id);
            $id_user = $row['iduser'];
        }

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
            window.location.href = "approve_keluar.php"; 
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
            window.location.href = "approve_keluar.php"; 
            }, 1500);
            </script>';
        }

        date_default_timezone_set('Asia/Jakarta');
        $tanggal_approve_keluar = date("Y-m-d");

        // Simpan data persetujuan ke dalam tabel persetujuan_keluar
        $query_add_approval = "INSERT INTO persetujuan_keluar (id_keluar, id_user, aksi, waktu_approve_keluar) VALUES ($id_keluar, $id_user, '$aksi', '$tanggal_approve_keluar')";
        mysqli_query($conn_ahg, $query_add_approval);

        // Hitung jumlah persetujuan/approval yang sudah ada untuk id_keluar dari tabel persetujuan_keluar
        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_keluar WHERE id_keluar = $id_keluar AND aksi = 'approve'";
        $result_count_approvals = mysqli_query($conn_ahg, $query_count_approvals);
        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
        $approvals_count = $row_count_approvals['approvals_count'];

        // Hitung jumlah penolakan/reject yang sudah ada untuk id_keluar dari tabel persetujuan_keluar
        $query_count_rejects = "SELECT COUNT(DISTINCT id_user) AS rejects_count FROM persetujuan_keluar WHERE id_keluar = $id_keluar AND aksi = 'reject'";
        $result_count_rejects = mysqli_query($conn_ahg, $query_count_rejects);
        $row_count_rejects = mysqli_fetch_assoc($result_count_rejects);
        $rejects_count = $row_count_rejects['rejects_count'];

       

        if ($approvals_count >= 2 || $rejects_count >= 2) {
            // Ambil status terbaru setelah penambahan persetujuan atau penolakan
            $query_get_status = "SELECT status FROM keluar WHERE idkeluar = $id_keluar";
            $result_get_status = mysqli_query($conn_ahg, $query_get_status);
        
            if ($result_get_status) {
                $row_status = mysqli_fetch_assoc($result_get_status);
                $current_status = $row_status['status'];
        
                // Mengambil qty sebelumnya
                $query_qty = "SELECT jumlah, idbarang FROM keluar WHERE idkeluar=?";
                $stmt_qty = $conn_ahg->prepare($query_qty);
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

                if ($current_status == 'IN PROGRESS') {
                    if ($aksi == 'approve') { // Menggunakan $aksi untuk menentukan tindakan
                        $query_update_status = "UPDATE keluar SET status = 'ACCEPTED' WHERE idkeluar = $id_keluar";
                    } elseif ($aksi == 'reject') { // Menggunakan $aksi untuk menentukan tindakan
                        $query_stok = "SELECT jmlhstok FROM stok WHERE idbarang=?";
                        $stmt_stok = $conn_ahg->prepare($query_stok);
                        $stmt_stok->bind_param("i", $idb);
                        $stmt_stok->execute();
                        $result_stok = $stmt_stok->get_result();
                        
                        $row_stok = $result_stok->fetch_assoc();
                        $stoksebelumnya = $row_stok['jmlhstok'];

                        // Menghitung jumlah stok yang akan ditambahkan kembali
                        $qtypashapus = $qtysblm + $stoksebelumnya;

                        // Update jumlah stok di tabel stok
                        $updatestok = mysqli_query($conn_ahg, "UPDATE stok SET jmlhstok='$qtypashapus' WHERE idbarang='$idb'");
                        $query_update_status = "UPDATE keluar SET status = 'REJECTED' WHERE idkeluar = $id_keluar";
                        
                    }

                    if (isset($query_update_status)) {
                        mysqli_query($conn_ahg, $query_update_status);
                        if(mysqli_affected_rows($conn_ahg) > 0){
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
                                window.location.href = "approve_keluar.php"; 
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
                                window.location.href = "approve_keluar.php"; 
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