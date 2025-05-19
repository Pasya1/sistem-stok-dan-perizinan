<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'visitor' && $_SESSION['role'] !== 'keuangan' && $_SESSION['role'] !== 'management' && $_SESSION['role'] !== 'owner' && $_SESSION['role'] !== 'ketua_operasional') {
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
    <title>Data Supplier</title>
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
        background-color: #427D9D; 
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
                        <h1 class="mt-3 text-center mb-4" style="color:#427D9D;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">DATA SUPPLIER</h1>
                            <a href="exportvisitor/exportsupplier.php" class="btn btn-info mb-2 shadow" style="float: right;"><i class="fas fa-book"></i> Cetak Data Supplier</a>
                        </div>
                        <div class="">
                            <div class="table-responsive shadow-lg px-3 py-5" style="border-radius: 10px;">
                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">
                                    <thead style="background-color: #427D9D; color:white;">
                                        <tr>
                                            <th>Aksi</th>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Supplier</th>
                                            <th>Alamat</th>
                                            <th>No Telepon Supplier</th>
                                            <th>Jenis Produk</th>
                                            <th>Supplier B3/ Non B3</th>
                                            <th>Nama PIC</th>
                                            <th>Keterangan</th>
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
                                               $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
                                           }

                                        ?>

                                            <tr>
                                                <td>
                                                <div class="btn-group">
                                                    <a href="lihat_detail_visitor/lihatdetail_supplier.php?idsupplier=<?= $ids; ?>" style="text-decoration: none;">
                                                        <button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" style="width: 40px; height: 30px; position: relative;">
                                                            <i class="fas fa-eye" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                </td>
                                                <td><?= $i++; ?></td>
                                                <td><a href="lihat_detail_visitor/lihatdetail_supplier.php?idsupplier=<?= $ids; ?>"><?= $gambar; ?></a></td>
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
                // Konfigurasi lainnya
            });
        });
    </script>
</body>
</html>

