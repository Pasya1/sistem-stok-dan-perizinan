<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin_aph' && $_SESSION['role'] !== 'logistik_aph') {
    header("Location: ../login.php");
    exit;
}
?>
<html>
<head>
  <title>Export Barang Masuk</title>
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
			<h2 class="text-center mt-4">Data Barang Masuk</h2>
            <a href="../masuk.php" class="btn btn-danger float-right mb-3"><i class="fas fa-arrow-left"></i></a>
				<div class="data-tables datatable-dark">
                <div class="row pt-3" style="font-size: 11px; opacity: 0.9;">
                    <div class="col-md-2">
                     Dari Tanggal :
                    </div>
                    <div class="col-md-2">
                        Sampai Tanggal :
                    </div>
             
                </div>
                <form method="GET" action="exportmasuk.php" class="form-inline ">
                    <input type="date" name="start_date" class="form-control shadow-sm" required>
                    <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                    <button type="submit" name="cari" class="btn btn-info shadow" >Search</button>
                </form>
                <table class="table table-bordered text-center" id="mauexportmasuk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>No Transaksi</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Nama Supplier</th>
                                                <th>Nama Barang</th>
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
                                                $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang WHERE m.tanggal_penerimaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang WHERE m.tanggal_penerimaan = '$mulai'");
                                            } else {
                                                $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang");
                                            }
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang");
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
                                                 $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';
                                             }

                                        ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?= $kodeTransaksi; ?></td>
                                                <td><?= htmlspecialchars($tanggalterima) ?></td>
                                                <td><?= htmlspecialchars($nama_supplier) ?></td>
                                                <td><?= htmlspecialchars($nama_barang) ?></td>
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
	
<script>
$(document).ready(function() {
    $('#mauexportmasuk').DataTable({
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