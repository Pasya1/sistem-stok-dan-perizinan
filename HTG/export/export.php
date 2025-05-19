<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin_htg' && $_SESSION['role'] !== 'logistik_htg') {
    header("Location: ../login.php");
    exit;
}
?>
<html>
<head>
  <title>Export Data Stok Barang</title>
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
			<h2 class="text-center mt-4">Data Stok Barang</h2>
            <a href="../barang.php" class="btn btn-danger float-right mb-3"><i class="fas fa-arrow-left"></i></a>
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered text-center" id="stok_barang" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NAMA BARANG</th>
                                                <th>JUMLAH STOK SAAT INI</th>
                                                <th>UNIT</th>
                                                <th>TANGGAL UPDATE STOK</th>
                                                <th>LOKASI PENYIMPANAN</th>
                                                <th>NAMA PIC GUDANG</th>
                                                <th>KETERANGAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $ambilsemuadata = mysqli_query($conn_htg, "select * from stok s");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                            $namabarang = $data['namabarang'];
                                            $jmlhstok = $data['jmlhstok'];
                                            $unit = $data['unit'];
                                            $update_stok = $data['update_stok'];
                                            $lokasi_penyimpanan = $data['lokasi_penyimpanan'];
                                            $idb = $data['idbarang'];
                                            $keterangan = $data['keterangan'];
                                            $nama_karyawan = $data['namakaryawan'];
                                            $id_karyawan = $data['idkaryawan'];


                                            $gambar = $data['dokumentasi'];
                                            if($gambar==null){
                                                $gambar='Tidak Ada Photo';
                                            }else {
                                                $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';
                                            }

                                            $tanggalupdatestok = TanggalIndo($update_stok);
                                        ?>

                                            <tr>
                                              
                                                <td><?= $i++; ?></td>
                                                <td><?= htmlspecialchars($namabarang) ?></td>
                                                <td><?= htmlspecialchars($jmlhstok) ?></td>
                                                <td><?= htmlspecialchars($unit) ?></td>
                                                <td><?= htmlspecialchars($tanggalupdatestok) ?></td>
                                                <td><a href="../lihat_detail/lihatdetail_barang.php?id_barang=<?= htmlspecialchars($idb); ?>#foto_lokasi"><?= htmlspecialchars($lokasi_penyimpanan) ?></a></td>
                                                <td><?= htmlspecialchars($nama_karyawan) ?></td>
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
    $('#stok_barang').DataTable({
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