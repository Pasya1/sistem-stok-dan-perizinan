<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'legal' && $_SESSION['role'] !== 'logistik' && $_SESSION['role'] !== 'supply') {
    header("Location: ../login.php");
    exit;
}
?>
<html>
<head>
  <title>Export Data Supplier</title>
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
			<h2 class="text-center mt-4">Data Supplier</h2>
            <a href="../supplier.php" class="btn btn-danger float-right mb-3"><i class="fas fa-arrow-left"></i></a>
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="supplier" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NAMA SUPPLIER</th>
                                                <th>ALAMAT</th>
                                                <th>NO TELEPON SUPPLIER</th>
                                                <th>JENIS PRODUK</th>
                                                <th>SUPPLIER B3/NON B3</th>
                                                <th>NAMA PIC</th>
                                                <th>KETERANGAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $ambilsemuadata = mysqli_query($conn, "select * from supplier");
                                            $i = 1;
                                            while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                                $namasupplier = $data['namasupplier'];
                                                $alamat = $data['alamat'];
                                                $no_telepon = $data['no_telepon'];
                                                $jenis_produk = $data['jenis_produk'];
                                                $nama_pic = $data['nama_pic'];
                                                $b3_nonb3 = $data['b3_nonb3'];
                                                $jenis_produk = $data['jenis_produk'];
                                                $ids = $data['idsupplier'];
                                                $keterangan = $data['keterangan'];
                                                
                                                $gambar = $data['dokumentasi'];
                                                if($gambar==null){
                                                    $gambar='Tidak Ada Photo';
                                                }else {
                                                    $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';
                                                }

                                            ?>

                                                <tr>
                                                    <td class="text-center"><?= $i++; ?></td>
                                                    <td><?= htmlspecialchars($namasupplier) ?></td>
                                                    <td><?= htmlspecialchars($alamat) ?></td>
                                                    <td><?= htmlspecialchars($no_telepon) ?></td>
                                                    <td><?= htmlspecialchars($jenis_produk) ?></td>
                                                    <td><?= htmlspecialchars($b3_nonb3) ?></td>
                                                    <td><?= htmlspecialchars($nama_pic) ?></td>
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
    $('#supplier').DataTable({
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

