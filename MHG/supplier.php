<?php

require 'koneksi.php';

if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'logistik' && $_SESSION['role'] !== 'legal' && $_SESSION['role'] !== 'supply') {

    header("Location: login.php");

    exit;

}

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

    <link href="css/styles.css" rel="stylesheet" />

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

    input[type="text"] {

        text-transform: uppercase;

    }

    textarea {

    text-transform: uppercase;

    }

    .modal-lg {

        max-width: 800px !important; 

    }

    </style>

</head>



<body class="sb-nav-fixed">

    <div id="prelouder"></div>



    <?php include 'nav/navmhg.php'; ?>



    <div id="layoutSidenav">

        <?php include 'nav/sidenavmhg.php'; ?>

        

        <div id="layoutSidenav_content">

            <main>

                <div class="container-fluid">

                    <div class=" mb-4">

                        <div class="">

                        <h1 class="mt-3 text-center mb-4" style="color:#427D9D;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">DATA SUPPLIER</h1>

                            <a href="export/exportsupplier.php" class="btn btn-info mb-2 shadow" style="float: right;"><i class="fas fa-book"></i> Cetak Data Supplier</a>

                            <button type="button" class="btn btn-primary mx-1 mb-3 shadow" data-toggle="modal" data-target="#myModal2" style="float: right;">

                                <i class="fas fa-plus"></i> Tambah Data Supplier

                            </button>

                        </div>

                        <div class="">

                            <div class="table-responsive shadow-lg px-4 py-5" style="border-radius: 10px;">

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

                                                $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';

                                            }



                                        ?>



                                            <tr>

                                                <td>

                                                <div class="btn-group">

                                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#427D9D; height:30px; font-size:12px; color:white;">

                                                        <span class="sr-only">Toggle Dropdown</span>

                                                    </button>

                                                        <div class="dropdown-menu">

                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#edit<?= $ids; ?>" style="margin-left: 5px; width: 140px; color:white;">

                                                            Edit

                                                        </button>

                                                        <input type="hidden" name="idbarangygingindihapus" value="<?= $ids; ?>">

                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $ids; ?>" style="margin-left: 5px; width: 140px;">

                                                        Hapus

                                                        </button>

                                                        <a href="lihat_detail/lihatdetail_supplier.php?idsupplier=<?= $ids; ?>" style="text-decoration: none;">

                                                        <button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" style="margin-left: 5px; width: 140px;">

                                                        Lihat Data

                                                        </button></a>

                                                        </div>

                                                </div>

                                                </td>

                                                <td><?= $i++; ?></td>

                                                <td><a href="lihat_detail/lihatdetail_supplier.php?idsupplier=<?= $ids; ?>"><?= $gambar; ?></a></td>

                                                <td><?= htmlspecialchars($namasupplier) ?></td>

                                                <td><?= htmlspecialchars($alamat) ?></td>

                                                <td><?= htmlspecialchars($no_telepon) ?></td>

                                                <td><?= str_replace("\n", "<br>", htmlspecialchars($jenis_produk)) ?></td>

                                                <td><?= htmlspecialchars($b3_nonb3) ?></td>

                                                <td><?= htmlspecialchars($nama_pic) ?></td>

                                                <td><?= htmlspecialchars($keterangan) ?></td>



                                            </tr>

                                            <!--Edit Modal -->

                                            <div class="modal fade" id="edit<?= $ids; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data Supplier</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post" enctype="multipart/form-data">

                                                            <div class="modal-body">

                                                                Edit Foto Supplier :

                                                                <input type="file" name="gambardepan" value="<?= $gambar_depan; ?>" class="form-control"><br>

                                                                Nama Supplier : <br>

                                                                <input type="text" name="supplier" value="<?= $namasupplier; ?>" class="form-control" required><br>

                                                                Alamat Supplier : 

                                                                <input type="text" name="alamat" value="<?= $alamat; ?>" class="form-control"  required><br>

                                                                No Telepon Supplier:

                                                                <input type="text" name="no_telepon" value="<?= $no_telepon; ?>" class="form-control"  required><br>

                                                                Jenis Produk :

                                                                <textarea name="jenis_produk" id="jenis_produk" class="form-control" rows="4" required><?= str_replace("<br>", "\n", htmlspecialchars($jenis_produk)) ?></textarea><br>

                                                                Supplier B3/Non B3 :

                                                                <select name="b3_nonb3" id="b3_nonb3" class="form-control" required>

                                                                    <?php

                                                                    $supb3_non = ["B3", "NON B3"]; 

                                                                    foreach ($supb3_non as $b3_non_b3) {

                                                                        $selected = ($b3_non_b3 == $b3_nonb3) ? 'selected' : ''; 

                                                                        echo '<option value="' . $b3_non_b3 . '" ' . $selected . '>' . ucfirst($b3_non_b3) . '</option>';

                                                                    }

                                                                    ?>

                                                                </select><br>

                                                                Nama PIC :

                                                                <input type="text" name="nama_pic" value="<?= $nama_pic; ?>" class="form-control" required><br>

                                                                Keterangan : <br>

                                                                <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" required><br>

                                                                <input type="hidden" name="ids" value="<?= $ids; ?>">

                                                                <button type="submit" class="btn btn-primary" name="updatesupplier" style="float: right;">Submit <i class="fas fa-arrow-circle-right"></i></button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $ids; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Hapus Data?</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                Apakah Anda yakin ingin menghapus <strong><?= $namasupplier; ?>?</strong>

                                                                <input type="hidden" name="ids" value="<?= $ids; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapussupplier">Hapus</button>

                                                            </div>

                                                        </form>



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

    <script src="js/scripts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <script src="assets/demo/chart-area-demo.js"></script>

    <script src="assets/demo/chart-bar-demo.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

    <script src="assets/demo/datatables-demo.js"></script>



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



<!-- The Modal -->

<div class="modal fade" id="myModal2">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Tambah Data Supplier</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <form method="post" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">

                            Unggah Foto : (Foto tempat/identitas supplier)

                            <input type="file" name="gambardepan" class="form-control"><br>

                            Nama Supplier :

                            <input type="text" name="supplier" class="form-control" required><br>

                            Alamat Supplier : 

                            <input type="text" name="alamat" class="form-control"  required><br>

                            No Telepon Supplier:

                            <input type="text" name="no_telepon" class="form-control"  required><br>



                        </div>

                        <div class="col-md-6">

                            Jenis Produk :

                            <textarea name="jenis_produk" id="jenis_produk" class="form-control" rows="4" required placeholder="- Barang 1 

- Barang 2

- dst."></textarea><br>

                            Supplier B3/ Non B3

                            <select name="b3_nonb3" id="b3_nonb3" class="form-control" required>

                                <option value="">--Pilih--</option>

                                <option value="B3">B3</option>

                                <option value="NON B3">Non B3</option>

                            </select><br>

                            Nama PIC :

                            <input type="text" name="nama_pic" class="form-control" required><br>

                            Keterangan :

                            <input type="text" name="keterangan" class="form-control" value="-"><br>



                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary form-control" name="addnewsupplier">Submit <i class="fas fa-arrow-circle-right"></i></button>

                </div>

            </form>



        </div>

    </div>

</div>



</html>



<?php

// Menambahkan supplier baru

if (isset($_POST['addnewsupplier'])) {

    $supplier = strtoupper($_POST['supplier']);

    $alamat = strtoupper($_POST['alamat']);

    $no_telepon = $_POST['no_telepon'];

    $jenis_produk = strtoupper($_POST['jenis_produk']);

    $nama_pic = strtoupper($_POST['nama_pic']);

    $b3_nonb3 = strtoupper($_POST['b3_nonb3']);

    $keterangan = strtoupper($_POST['keterangan']);





    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username = $rowUsername['username'];





    $gambar_depan = $_FILES['gambardepan'];

    $nama_gambar_depan = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);



    $query = "INSERT INTO supplier (`dokumentasi`, `namasupplier`, `alamat`, `no_telepon`, `jenis_produk`, `nama_pic`, `b3_nonb3`, `keterangan`, `user_edit_supplier`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("sssssssss", $nama_gambar_depan, $supplier, $alamat, $no_telepon, $jenis_produk, $nama_pic, $b3_nonb3, $keterangan, $username);



    if ($stmt->execute()) {

        echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Ditambahkan",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                window.location.href = "supplier.php"; 

                }, 1500);

                </script>';

    } else {

        echo 'Gagal';

        header('location:supplier.php');

    }

    $stmt->close();

}



// Update info supplier

if (isset($_POST['updatesupplier'])) {

    $ids = $_POST['ids'];

    $supplier = strtoupper($_POST['supplier']);

    $alamat = strtoupper($_POST['alamat']);

    $no_telepon = $_POST['no_telepon'];

    $jenis_produk = strtoupper($_POST['jenis_produk']);

    $nama_pic = strtoupper($_POST['nama_pic']);

    $b3_nonb3 = strtoupper($_POST['b3_nonb3']);

    $keterangan = strtoupper($_POST['keterangan']);



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username = $rowUsername['username'];



    $gambar_depan = $_FILES['gambardepan'];

    $nama_gambar_depan = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    // Simpan gambar depan

    if (!empty($nama_gambar_depan)) {

        move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);



        $query = "UPDATE supplier SET dokumentasi=?, namasupplier=?, alamat=?, no_telepon=?, jenis_produk=?, nama_pic=?, b3_nonb3=?, keterangan=?, user_edit_supplier=? WHERE idsupplier=?";

        $stmt = $conn->prepare($query);

        $stmt->bind_param("sssssssssi", $nama_gambar_depan, $supplier, $alamat, $no_telepon, $jenis_produk, $nama_pic, $b3_nonb3, $keterangan, $username, $ids);

    } else {

        $query = "UPDATE supplier SET namasupplier=?, alamat=?, no_telepon=?, jenis_produk=?, nama_pic=?, b3_nonb3=?, keterangan=?, user_edit_supplier=? WHERE idsupplier=?";

        $stmt = $conn->prepare($query);

        $stmt->bind_param("ssssssssi", $supplier, $alamat, $no_telepon, $jenis_produk, $nama_pic, $b3_nonb3, $keterangan, $username, $ids);

    }



    if ($stmt->execute()) {

        echo '<script type="text/javascript">      

            Swal.fire({

                position: "center",

                icon: "success",

                title: "Data Telah Diedit",

                showConfirmButton: false,

                timer: 1500

            });

            setTimeout(function () { 

                window.location.href = "supplier.php"; 

            }, 1500);

            </script>';

    } else {

        echo 'Gagal';

        header('location:supplier.php');

    }

    $stmt->close();

}





// Hapus supplier

if (isset($_POST['hapussupplier'])) {

    $ids = $_POST['ids'];



    $query = "DELETE FROM supplier WHERE idsupplier=?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("i", $ids);



    if ($stmt->execute()) {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "success",

            title: "Data Berhasil Dihapus",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

        window.location.href = "supplier.php"; 

        }, 1500);

        </script>';

    } else {

        echo 'Gagal';

        header('location:supplier.php');

    }

    $stmt->close();

}

?>

