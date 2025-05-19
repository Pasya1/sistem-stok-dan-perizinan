<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'visitor_htg' && $_SESSION['role'] !== 'keuangan_htg' && $_SESSION['role'] !== 'management_htg' && $_SESSION['role'] !== 'owner_htg' && $_SESSION['role'] !== 'ketua_operasional_htg') {
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
    <title>Barang Masuk</title>
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
                            <h1 class="mt-3 text-center mb-4" style="color:#1E7458;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Barang Masuk</h1>
                            <a href="exportvisitor/exportmasuk.php" class="btn btn-info mb-2 shadow" style=" float: right;"><i class="fas fa-book"></i> Buat Laporan</a>
                            <a href="arsip_excel_masuk_visitor.php" class="btn btn-success  mx-1 mb-3 shadow" style="float: right;"><i class="fas fa-folder-open"></i> Berkas Arsip</a>
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
                                <form method="GET" action="masuk.php" class="form-inline mb-4">
                                    <input type="date" name="start_date" class="form-control shadow-sm" required>
                                    <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                                    <button type="submit" name="cari" class="btn btn-custom shadow form-control" >Search</button>
                                </form>
                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">
                                    <thead style="background-color: #1E7458; color:white;">
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Nama Supplier</th>
                                            <th>Nama Barang</th>
                                            <th>Gambar Barang</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Harga Satuan</th>
                                            <th>Total Harga</th>
                                            <th>Nomor PO</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if(isset($_GET['cari'])){ 
                                            $mulai = $_GET['start_date']; 
                                            $selesai = $_GET['end_date'];
                                            
                                            if($mulai != null && $selesai != null){
                                                $ambilsemuadata = mysqli_query($conn_htg, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang WHERE m.tanggal_penerimaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata = mysqli_query($conn_htg, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang WHERE m.tanggal_penerimaan = '$mulai'");
                                            } else {
                                                $ambilsemuadata = mysqli_query($conn_htg, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang");
                                            }
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn_htg, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang");
                                        }
                                        $i= 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                            $tanggal_penerimaan = $data['tanggal_penerimaan'];
                                            $nama_supplier = $data['nama_supplier'];
                                            $nama_barang = $data['nama_barang'];
                                            $jumlah = $data['jumlah'];
                                            $harga_satuan = $data['harga_satuan'];
                                            $total_harga = $data['total_harga'];
                                            $faktur = $data['faktur'];
                                            $idb = $data['idbarang'];
                                            $idm = $data['idmasuk'];
                                            $keterangan = $data['keterangan'];
                                            $id_supplier = $data['idsupplier'];
                                            $unit = $data['unit_masuk'];

                                            $tanggalterima = TanggalIndo($tanggal_penerimaan);

                                            $kodeTransaksi = $data['kode_transaksi_masuk'];

                                            $gambar = $data['dokumentasi'];
                                            if($gambar==null){
                                                $gambar='Tidak Ada Photo';
                                            }else {
                                                $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
                                            }

                                        ?>

                                            <tr>
                                                <td><?= $kodeTransaksi; ?></td>
                                                <td><?= htmlspecialchars($tanggalterima) ?></td>
                                                <td><?= htmlspecialchars($nama_supplier) ?></td>
                                                <td><?= htmlspecialchars($nama_barang) ?></td>
                                                <td><?= $gambar ?></td>
                                                <td><?= htmlspecialchars($jumlah) ?></td>
                                                <td><?= htmlspecialchars($unit) ?></td>
                                                <td><?= htmlspecialchars($harga_satuan) ?></td>
                                                <td style="font-weight : bold;">Rp <?= number_format($total_harga, 0, ',', '.') ?></td>
                                                <td><?= htmlspecialchars($faktur) ?></td>
                                                <td><?= htmlspecialchars($keterangan) ?></td>
                                               
                                            
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
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/datatables-demo.js"></script>


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

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

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