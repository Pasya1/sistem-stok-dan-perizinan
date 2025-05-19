<?php
require '../../koneksi.php';

if ($_SESSION['role'] !== 'visitor_htg' && $_SESSION['role'] !== 'keuangan_htg' && $_SESSION['role'] !== 'management_htg' && $_SESSION['role'] !== 'owner_htg' && $_SESSION['role'] !== 'ketua_operasional_htg') {
    header("Location: ../../login.php");
    exit;
}
?>
<html>
<head>
  <title>Export Data Permintaan Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

  <style>
    .gambarfoto{
            width:100px;
            
        }
    #permintaanbarang_wrapper {
        margin-left: -100px;
        margin-right: 0; 
    }
  </style>
</head>

<body>
<div class="container">
			<h2 class="mt-4 text-center">Data Permintaan Barang</h2>
            <a href="../ordering.php" class="btn btn-danger float-right mb-3"><i class="fas fa-arrow-left"></i></a>
				<div class="data-tables datatable-dark">
				<div class="container d-flex pt-3" style="font-size: 11px; opacity: 0.9;  margin-left: -100px; margin-right: 0;">
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
                    <div class="container" style=" margin-left: -100px; margin-right: 0;">
                        <form method="GET" action="exportordering.php" class="form-inline mb-4">
                            <input type="date" name="start_date" class="form-control shadow-sm" required>
                            <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                            <select name="tgl_apa" class="form-control shadow-sm" required>
                                <option value="">-- Pilih --</option>
                                <option value="Tanggal_Buat">Tanggal Buat</option>
                                <option value="Tanggal_Permintaan">Tanggal Permintaan</option>
                            </select>  
                            <button type="submit" name="cari" class="btn btn-info shadow form-control ml-2" >Search</button>
                        </form>
                    </div>
                <table class="table table-bordered" id="permintaanbarang" width="100%" cellspacing="0">
                                        <thead>
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
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                                } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                                } else {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan");
                                                }
                                            } elseif($mulai != null && $selesai == null && $tgl_apa != null) {
                                                if($tgl_apa == 'Tanggal_Buat') {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_buat = '$mulai'");
                                                } elseif($tgl_apa == 'Tanggal_Permintaan') {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "SELECT * from permintaan WHERE tanggal_permintaan = '$mulai'");
                                                } else {
                                                    $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan");
                                                }
                                            } else {
                                                $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan");
                                            }
                                        } else {
                                            $ambildatapermintaan = mysqli_query($conn_htg, "select * from permintaan");
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
                                                <td><?= $kode_transaksi_request; ?></td>
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
                                                <td><?= htmlspecialchars($status_request) ?></td>

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
    $('#permintaanbarang').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: 'Export to PDF',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(doc) {
                    doc.pageMargins = [20, 20, 20, 20];
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
//fungsi tanngal 
function InputTgl($tanggal)
{
    $pisah = explode('/', $tanggal);
    $lari = array($pisah[2], $pisah[1], $pisah[0]);
    $satukan = implode("-", $lari);

    return $satukan;
}
//fungsi edit tanngal 
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