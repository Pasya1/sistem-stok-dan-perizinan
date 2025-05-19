<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'visitor_mes' && $_SESSION['role'] !== 'keuangan_mes' && $_SESSION['role'] !== 'management_mes' && $_SESSION['role'] !== 'owner_mes' && $_SESSION['role'] !== 'ketua_operasional_mes') {
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
    <title>Barang Keluar</title>
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
                            <h1 class="mt-3 text-center mb-4" style="color:#4045AA;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">BARANG KELUAR</h1>
                            <a href="exportvisitor/exportkeluar.php" class="btn btn-info mb-2 shadow" style="float: right;"><i class="fas fa-book"></i> Buat Laporan</a>
                            <a href="arsip_excel_visitor.php" class="btn btn-success  mx-1 mb-3 shadow" style="float: right;"><i class="fas fa-folder-open"></i> Berkas Arsip</a>
                        </div>
                        <div class="">
                            <div class="table-responsive shadow-lg px-3 py-1" style="border-radius: 10px;">
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
                                    <thead style="background-color: #4045AA; color:white;">
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
                                            <th>Status ACC</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if(isset($_GET['cari'])){ 
                                            $mulai = $_GET['start_date']; 
                                            $selesai = $_GET['end_date'];
                                            
                                            if($mulai != null && $selesai != null){
                                                $ambilsemuadata = mysqli_query($conn_mes, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) ORDER BY k.kode_transaksi ASC");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata = mysqli_query($conn_mes, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar ='$mulai' ORDER BY k.kode_transaksi ASC");
                                            } else {
                                                $ambilsemuadata = mysqli_query($conn_mes, "select * from keluar k, stok s where s.idbarang = k.idbarang ORDER BY k.kode_transaksi ASC");
                                            }
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn_mes, "select * from keluar k, stok s where s.idbarang = k.idbarang ORDER BY k.kode_transaksi ASC");
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

                                          
                                        ?>

                                            <tr style="background-color: <?php echo ($status == 'ACCEPTED') ? 'rgba(0, 255, 0, 0.2)' : (($status == 'REJECTED') ? 'rgba(255, 0, 0, 0.2)' : ''); ?>">
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
                                                        $result_count_approvals = mysqli_query($conn_mes, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $approvals_count = $row_count_approvals['approvals_count'];
                                                        
                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_count_approvals = mysqli_query($conn_mes, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $rejected_count = $row_count_approvals['rejected_count'];
                                                        
                                                         // Mengambil informasi user yang sudah menyetujui
                                                         $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                         $result_approved_users = mysqli_query($conn_mes, $query_approved_users);
                                                         $approved_users = [];
                                                         while ($row = mysqli_fetch_assoc($result_approved_users)) {
                                                             $approved_users[] = $row['id_user'];
                                                         }
 
                                                         $approved_users_info = [];
                                                         foreach ($approved_users as $user_id) {
                                                             $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                             $result_username = mysqli_query($conn_mes, $query_username);
                                                             $row_username = mysqli_fetch_assoc($result_username);
                                                             $approved_users_info[$user_id] = $row_username['username'];
                                                         }

                                                        // Mengambil informasi user yang melakukan penolakan
                                                        $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_rejected_users = mysqli_query($conn_mes, $query_rejected_users);
                                                        $rejected_users = [];
                                                        while ($row = mysqli_fetch_assoc($result_rejected_users)) {
                                                            $rejected_users[] = $row['id_user'];
                                                        }

                                                        // Mengambil informasi username dari tabel login berdasarkan id_user untuk user yang melakukan penolakan
                                                        $rejected_users_info = [];
                                                        foreach ($rejected_users as $user_id) {
                                                            $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                            $result_username = mysqli_query($conn_mes, $query_username);
                                                            $row_username = mysqli_fetch_assoc($result_username);
                                                            $rejected_users_info[$user_id] = $row_username['username'];
                                                        }
                                                         // Mengambil Tanggal user yang sudah menyetujui
                                                         $query_approved_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                         $result_approved_users_tgl = mysqli_query($conn_mes, $query_approved_users_tgl);
                                                         $waktu_approve_acc = [];
                                                         while ($row = mysqli_fetch_assoc($result_approved_users_tgl)) {
                                                             $waktu_approve_acc[] = $row['waktu_approve_keluar'];
                                                         }
                                                          // Mengambil Tanggal user yang sudah menolak
                                                          $query_rejected_users_tgl = "SELECT DISTINCT waktu_approve_keluar FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                          $result_rejected_users_tgl = mysqli_query($conn_mes, $query_rejected_users_tgl);
                                                          $waktu_approve_rejected = [];
                                                          while ($row = mysqli_fetch_assoc($result_rejected_users_tgl)) {
                                                              $waktu_approve_rejected[] = $row['waktu_approve_keluar'];
                                                          }
                                                     ?>
                                                     <a href="#" data-toggle="modal" data-target="#statusModal<?= $idk; ?>"><?= $status; ?></a>
                                                </td>
                                               
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