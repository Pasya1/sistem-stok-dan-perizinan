<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin_ahg' && $_SESSION['role'] !== 'logistik_ahg') {
    header("Location: ../login.php");
    exit;
}
?>
<html>
<head>
  <title>History Barang Masuk/Keluar</title>
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
  </style>
</head>

<body>
<div class="container">
			<h2 class="text-center mt-5">History Barang Masuk/Keluar</h2>
            <a href="../barang.php" class="btn btn-danger float-right mb-3"><i class="fas fa-arrow-left"></i></a>
			<div class="data-tables datatable-dark">
                    <div class="row mt-5">
                        <div class="col-md-2" style="font-size: 11px; opacity: 0.9;">
                            Dari Tanggal :
                        </div>
                        <div class="col-md-2" style="font-size: 11px; opacity: 0.9;">
                            Sampai Tanggal :
                        </div>
                        <div class="col-md-2" style="font-size: 11px; opacity: 0.9;">
                            Nama Barang :
                        </div>
                        <div class="col-md-2" style="font-size: 11px; opacity: 0.9;">
                            Cari Berdasarkan :
                        </div>
                        <form method="GET" action="barangmasuk_keluar.php" class="form-inline mb-4 ">
                            <input type="date" name="start_date" class="form-control shadow-sm" required>
                            <input type="date" name="end_date" class="form-control mx-2 my-2 shadow-sm">
                            <select name="nama_barang" class="form-control shadow-sm" required>
                                <option value="">-- Pilih --</option>
                                <?php
                                $query = "SELECT idbarang, namabarang FROM stok";
                                $result = $conn_ahg->query($query);

                                $options = '';
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $options .= '<option value="' . $row['idbarang'] . '">' . $row['namabarang'] . '</option>';
                                    }
                                }
                                echo $options;
                                ?>
                            </select>  
                            <select name="jenis_barang" class="form-control shadow-sm ml-2" required>
                                <option value="">-- Pilih --</option>
                                <option value="Barang Masuk">Barang Masuk</option>
                                <option value="Barang Keluar">Barang Keluar</option>
                                <option value="Barang Masuk & Keluar">Barang Masuk & Keluar</option>
                            </select>  
                            <button type="submit" name="cari" class="btn btn-info shadow form-control ml-2" >Search <i class="fas fa-search"></i></button>
                        </form>
                    </div>
                <?php if(isset($_GET['cari'])){ ?>
                    <?php
                    $jenis_barang = $_GET['jenis_barang'];
                    if ($jenis_barang == 'Barang Masuk') {
                    ?>
                    <table class="table table-bordered text-center" id="stok_barang_masuk" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>KODE TRANSAKSI</th>
                                <th>TANGGAL MASUK</th>
                                <th>NAMA SUPPLIER</th>
                                <th>NAMA BARANG</th>
                                <th>QUANTITY</th>
                                <th>UNIT</th>
                                <th>HARGA SATUAN</th>
                                <th>TOTAL HARGA</th>
                                <th>NOMOR PO</th>
                                <th>KETERANGAN</th>
                                <th>TIPE</th>

                            </tr>
                        </thead>
                        <tbody style="text-transform: uppercase;">
                            <?php
                            $mulai = $_GET['start_date']; 
                            $selesai = $_GET['end_date'];
                            $nama_barang = $_GET['nama_barang'];
                            
                            if($mulai != null && $selesai != null && $nama_barang != null ){
                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * from masuk WHERE tanggal_penerimaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND idbarang = '$nama_barang'");
                            }elseif ($mulai != null && $selesai == null && $nama_barang != null ){
                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * from masuk WHERE tanggal_penerimaan = '$mulai' AND idbarang = '$nama_barang'");
                            }else{
                                echo 'Tidak Ada Data Dipilih';
                            }
                                $i = 1;
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

                                    $kodeTransaksi = $data['kode_transaksi_masuk'];

                                    $tanggalterima = TanggalIndo($tanggal_penerimaan);

                                    ?>   
                                        <tr>
                                        
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
                                        <td>BARANG MASUK</td>

                                    </tr>
                        
                                    <?php
                                    };

                                    ?>
                        </tbody>
                    </table>
                    <?php
                    }

                    if ($jenis_barang == 'Barang Keluar') {
                    ?>
                    <table class="table table-bordered text-center" id="stok_barang_keluar" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>KODE TRANSAKSI</th>
                                <th>TANGGAL KELUAR</th>
                                <th>NAMA BARANG</th>
                                <th>JUMLAH KELUAR</th>
                                <th>UNIT KELUAR</th>
                                <th>KEPERLUAN</th>
                                <th>TUJUAN</th>
                                <th>KETERANGAN</th>
                                <th>STATUS</th>
                                <th>TIPE</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: uppercase;">
                            <?php
                            $mulai = $_GET['start_date']; 
                            $selesai = $_GET['end_date'];
                            $nama_barang = $_GET['nama_barang'];
                            
                            if($mulai != null && $selesai != null && $nama_barang != null ){
                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * from keluar WHERE tanggal_keluar BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND idbarang = '$nama_barang'");
                            }elseif ($mulai != null && $selesai == null && $nama_barang != null ){
                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * from keluar WHERE tanggal_keluar = '$mulai'AND idbarang = '$nama_barang'");
                            }else{
                                echo 'Tidak Ada Data Dipilih';
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
                            ?>

                            <tr style="background-color: <?php echo ($status == 'ACCEPTED') ? 'rgba(0, 255, 0, 0.2)' : (($status == 'REJECTED') ? 'rgba(255, 0, 0, 0.2)' : ''); ?>"> 
                                <td><?= $kodeTransaksi; ?></td>
                                <td><?= htmlspecialchars($tanggalkeluar_indo) ?></td>
                                <td><?= htmlspecialchars($nama_barang) ?></td>
                                <td><?= htmlspecialchars($jumlah) ?></td>
                                <td><?= htmlspecialchars($unit) ?></td>
                                <td><?= htmlspecialchars($keperluan) ?></td>
                                <td><?= htmlspecialchars($tujuan) ?></td>
                                <td><?= htmlspecialchars($keterangan) ?></td>
                                <td><?= htmlspecialchars($status) ?></td>
                                <td>BARANG KELUAR</td>

                                                    
                            </tr>
                                            
                            <?php
                            };
                            ?>
                        </tbody>
                    </table>
                    <?php 
                    } 
                    
                    if ($jenis_barang == 'Barang Masuk & Keluar') {
                    ?>
                    <h5 class="text-center mt-2">BARANG MASUK</h5>
                    <table class="table table-bordered text-center" id="stok_barang_keluar_masuk1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>KODE TRANSAKSI</th>
                                <th>TANGGAL MASUK</th>
                                <th>NAMA SUPPLIER</th>
                                <th>NAMA BARANG</th>
                                <th>QUANTITY</th>
                                <th>UNIT</th>
                                <th>HARGA SATUAN</th>
                                <th>TOTAL HARGA</th>
                                <th>KETERANGAN</th>
                                <th>TIPE</th>

                            </tr>
                        </thead>
                        <tbody style="text-transform: uppercase;">
                            <?php
                            $mulai = $_GET['start_date']; 
                            $selesai = $_GET['end_date'];
                            $nama_barang = $_GET['nama_barang'];
                            
                            if($mulai != null && $selesai != null && $nama_barang != null ){
                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * from masuk WHERE tanggal_penerimaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND idbarang = '$nama_barang'");
                            }elseif ($mulai != null && $selesai == null && $nama_barang != null ){
                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * from masuk WHERE tanggal_penerimaan = '$mulai' AND idbarang = '$nama_barang'");
                            }else{
                                echo 'Tidak Ada Data Dipilih';
                            }
                                $i = 1;
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

                                    $kodeTransaksi = $data['kode_transaksi_masuk'];

                                    $tanggalterima = TanggalIndo($tanggal_penerimaan);

                                    ?>   
                                        <tr>
                                        
                                        <td><?= $kodeTransaksi; ?></td>
                                        <td><?= htmlspecialchars($tanggalterima) ?></td>
                                        <td><?= htmlspecialchars($nama_supplier) ?></td>
                                        <td><?= htmlspecialchars($nama_barang) ?></td>
                                        <td><?= htmlspecialchars($jumlah) ?></td>
                                        <td><?= htmlspecialchars($unit) ?></td>
                                        <td><?= htmlspecialchars($harga_satuan) ?></td>
                                        <td style="font-weight : bold;">Rp <?= number_format($total_harga, 0, ',', '.') ?></td>
                                        <td><?= htmlspecialchars($keterangan) ?></td>
                                        <td>BARANG MASUK</td>

                                    </tr>
                        
                                    <?php
                                    };

                                    ?>
                        </tbody>
                    </table>
                    <h5 class="mt-4 text-center">BARANG KELUAR</h5>
                    <table class="table table-bordered text-center" id="stok_barang_keluar_masuk2" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>KODE TRANSAKSI</th>
                                <th>TANGGAL KELUAR</th>
                                <th>NAMA BARANG</th>
                                <th>JUMLAH KELUAR</th>
                                <th>UNIT KELUAR</th>
                                <th>KEPERLUAN</th>
                                <th>TUJUAN</th>
                                <th>KETERANGAN</th>
                                <th>STATUS</th>
                                <th>TIPE</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: uppercase;">
                            <?php
                            $mulai = $_GET['start_date']; 
                            $selesai = $_GET['end_date'];
                            $nama_barang = $_GET['nama_barang'];
                            
                            if($mulai != null && $selesai != null && $nama_barang != null ){
                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * from keluar WHERE tanggal_keluar BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) AND idbarang = '$nama_barang'");
                            }elseif ($mulai != null && $selesai == null && $nama_barang != null ){
                                $ambilsemuadata = mysqli_query($conn_ahg, "SELECT * from keluar WHERE tanggal_keluar = '$mulai'AND idbarang = '$nama_barang'");
                            }else{
                                echo 'Tidak Ada Data Dipilih';
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
                            ?>

                            <tr style="background-color: <?php echo ($status == 'ACCEPTED') ? 'rgba(0, 255, 0, 0.2)' : (($status == 'REJECTED') ? 'rgba(255, 0, 0, 0.2)' : ''); ?>"> 
                                <td><?= $kodeTransaksi; ?></td>
                                <td><?= htmlspecialchars($tanggalkeluar_indo) ?></td>
                                <td><?= htmlspecialchars($nama_barang) ?></td>
                                <td><?= htmlspecialchars($jumlah) ?></td>
                                <td><?= htmlspecialchars($unit) ?></td>
                                <td><?= htmlspecialchars($keperluan) ?></td>
                                <td><?= htmlspecialchars($tujuan) ?></td>
                                <td><?= htmlspecialchars($keterangan) ?></td>
                                <td><?= htmlspecialchars($status) ?></td>
                                <td>BARANG KELUAR</td>

                                                    
                            </tr>
                                            
                            <?php
                            };
                            ?>
                        </tbody>
                    </table>
                    <?php
                    }
                    ?>
                <?php 
                } else{
                ?>
                <table class="table table-bordered text-center" id="stok_barang_mk" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TANGGAL </th>
                                <th>NAMA BARANG</th>
                                <th>JUMLAH</th>
                                <th>UNIT</th>
                                <th>HARGA SATUAN</th>
                                <th>TOTAL HARGA</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr>
                                <td colspan="8">"search for data first"</td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>        
</div>

<script>
$(document).ready(function() {
    $('#stok_barang_mk').DataTable({
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
<script>
$(document).ready(function() {
    $('#stok_barang_masuk').DataTable({
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
<script>
$(document).ready(function() {
    $('#stok_barang_keluar').DataTable({
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
<script>
$(document).ready(function() {
    $('#stok_barang_keluar_masuk1').DataTable({
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
<script>
$(document).ready(function() {
    $('#stok_barang_keluar_masuk2').DataTable({
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