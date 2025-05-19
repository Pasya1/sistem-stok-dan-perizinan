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
    <title>Ordering</title>
    <link href="../css/styles.css" rel="stylesheet" />
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
                    <div class="">
                            <h1 class="mt-3 text-center mb-4" style="color:#3E578D;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">PERMINTAAN BARANG</h1>
                            <a href="exportvisitor/exportordering.php" class="btn btn-info shadow" style="margin-bottom: 5px; float: right;"><i class="fas fa-book"></i> Buat Laporan</a>
                            <a href="arsip_excel_ordering_visitor.php" class="btn btn-success  mx-1 mb-3 shadow" style="float: right;"><i class="fas fa-folder-open"></i> Berkas Arsip</a>
                        </div>
                        <div class="">
                            <div class="table-responsive shadow-lg px-3 py-1" style="border-radius:10px;">
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
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/datatables-demo.js"></script>


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
                    // Konfigurasi lainnya
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