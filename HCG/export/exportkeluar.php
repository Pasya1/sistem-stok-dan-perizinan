<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin_hcg' && $_SESSION['role'] !== 'logistik_hcg') {
    header("Location: ../login.php");
    exit;
}
?>
<html>
<head>
  <title>Export Barang Keluar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
			<h2 class="text-center mt-4">Data Barang Keluar</h2>
            <a href="../keluar.php" class="btn btn-danger float-right mb-3"><i class="fas fa-arrow-left"></i></a>
				<div class="data-tables datatable-dark">
				<div class="row pt-3" style="font-size: 11px; opacity: 0.9;">
                    <div class="col-md-2">
                        Dari Tanggal :
                    </div>
                    <div class="col-md-2">
                        Sampai Tanggal :
                    </div>
                </div>
                <form method="GET" action="exportkeluar.php" class="form-inline mb-4">
                    <input type="date" name="start_date" class="form-control shadow-sm" required>
                    <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                    <button type="submit" name="cari" class="btn btn-info shadow form-control" >Search</button>
                </form>
                <table class="table table-bordered" id="mauexportkeluar" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>No Transaksi</th>
                                                <th>Tanggal Keluar</th>
                                                <th>Nama Barang</th>
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
                                                $ambilsemuadata = mysqli_query($conn_hcg, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) ORDER BY k.kode_transaksi ASC");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata = mysqli_query($conn_hcg, "SELECT * FROM keluar k JOIN stok s ON s.idbarang = k.idbarang WHERE k.tanggal_keluar ='$mulai' ORDER BY k.kode_transaksi ASC");
                                            } else {
                                                $ambilsemuadata = mysqli_query($conn_hcg, "select * from keluar k, stok s where s.idbarang = k.idbarang ORDER BY k.kode_transaksi ASC");
                                            }
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn_hcg, "select * from keluar k, stok s where s.idbarang = k.idbarang ORDER BY k.kode_transaksi ASC");
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
                                                <td class="text-center"><?= $i++; ?></td>
                                                <td><?= $kodeTransaksi; ?></td>
                                                <td><?= htmlspecialchars($tanggalkeluar_indo) ?></td>
                                                <td><?= htmlspecialchars($nama_barang) ?></td>
                                                <td><?= htmlspecialchars($jumlah) ?></td>
                                                <td><?= htmlspecialchars($unit) ?></td>
                                                <td><?= htmlspecialchars($keperluan) ?></td>
                                                <td><?= htmlspecialchars($tujuan) ?></td>
                                                <td><?= htmlspecialchars($keterangan) ?></td>
                                                <td><?= htmlspecialchars($status) ?></td>

                                            
                                            </tr>
                                    
                                        <?php
                                            };

                                            ?>

                                        </tbody>
                                    </table>
					
				</div>
                
</div>
	
<script>
$(document).ready(function() {
    $('#mauexportkeluar').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: 'Export to PDF',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(doc) {
                    doc.defaultStyle.fontSize = 8; // Atur ukuran font default
                    doc.styles.tableHeader.fontSize = 8; // Atur ukuran font untuk header tabel
                    doc.styles.tableBodyEven.fontSize = 8; // Atur ukuran font untuk body tabel
                }
            },
            'copy', 'csv', 'excel', 'print'
        ]
    });
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

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