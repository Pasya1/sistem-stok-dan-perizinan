<?php

require 'koneksi.php';

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

    .modal-lg {

        max-width: 800px !important; 

    }



    .form-group {

        margin-bottom: 1rem;

    }



    .form-column {

        column-count: 2;

    }

    </style>

</head>



<body class="sb-nav-fixed">

<?php

    if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'logistik') {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "error",

            title: "NOT ACCESS ",

            html: "Maaf, Anda tidak memiliki akses sebagai <strong> ADMIN  </strong> dan <strong> LOGISTIK </strong>. Silahkan lakukan login ulang jika ingin mengakses halaman ini",

            showConfirmButton: true,

            confirmButtonText: "Lanjutkan",

            showCancelButton: true,

            cancelButtonText: "Login Ulang?",

            allowOutsideClick: false,

            reverseButtons: true

        }).then((result) => {

            if (result.isConfirmed) {

                window.location.href = "index.php";

            } else if (result.dismiss === Swal.DismissReason.cancel) {

                window.location.href = "logout.php";

            }

        });

        </script>';



        exit;

    }

    ?>

    <div id="prelouder"></div>



    <?php include 'nav/navmhg.php'; ?>



    <div id="layoutSidenav">

        <?php include 'nav/sidenavmhg.php'; ?>



        <div id="layoutSidenav_content">

            <main>

                <div class="container-fluid">

                    <div class=" mb-4">

                        <div class="">

                            <h1 class="mt-3 text-center mb-4" style="color:#427D9D;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Barang Masuk</h1>
                            

                                    <a href="export/exportmasuk.php" class="btn btn-info mb-2 shadow" style=" float: right;"><i class="fas fa-book"></i> Buat Laporan</a>

                                    <a href="arsip_excel_masuk.php" class="btn btn-success  mx-1 mb-3 shadow" style="float: right;"><i class="fas fa-folder-open"></i> Berkas Arsip</a>

                                    <button type="button" class="btn btn-primary shadow mb-3" data-toggle="modal" data-target="#myModal" style="float: right;">

                                        <i class="fas fa-plus"></i> Tambah

                                    </button> 

                        </div>
                        <div class="">

                            <div class="table-responsive shadow-lg px-4 " style="border-radius: 10px;">
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

                                    <thead style="background-color: #427D9D; color:white;">

                                        <tr>

                                            <th>Aksi</th>

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
                                                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang WHERE m.tanggal_penerimaan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                            } elseif($mulai != null && $selesai == null) {
                                                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang WHERE m.tanggal_penerimaan = '$mulai'");
                                            } else {
                                                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang");
                                            }
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang");
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

                                                <td>

                                                <div class="btn-group">

                                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#427D9D; height:30px; font-size:12px; color:white;">

                                                        <span class="sr-only">Toggle Dropdown</span>

                                                    </button>

                                                        <div class="dropdown-menu">

                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#edit<?= $idm; ?>" style="margin-left: 5px; width: 140px; color: white;">

                                                            Edit

                                                        </button>

                                                        <input type="hidden" name="idkarangygingindihapus" value="<?= $idm; ?>">

                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $idm; ?>" style="margin-left: 5px; width: 140px;">

                                                        Hapus

                                                        </button>

                                                        </div>

                                                </div>

                                                </td>

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

                                            <!--Edit Modal -->

                                            <div class="modal fade" id="edit<?= $idm; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data Barang</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">

                                                                <input type="hidden" name="idm" value="<?= $idm; ?>">

                                                                Nama Barang (tidak bisa diubah):

                                                                <div class="form-control bg-warning " style="opacity: 0.8;"><?= $nama_barang; ?></div><br>

                                                                Tanggal Masuk Barang :

                                                                <input type="date" name="tanggalmasuk_" id="tanggalmasuk_<?= $idm; ?>" value="<?= $tanggal_penerimaan; ?>" class="form-control datepicker" required><br>

                                                                Nama Supplier :

                                                                <select name="supplier2" class="form-control" required>

                                                                    <?php

                                                                    $ambilsemuadatasupplier = mysqli_query($conn, "select * from supplier");

                                                                    while ($fetcharray = mysqli_fetch_array($ambilsemuadatasupplier)) {

                                                                        $namasupplier = $fetcharray['namasupplier'];

                                                                        $idsupplier = $fetcharray['idsupplier'];

                                                                        $selected = ($id_supplier == $idsupplier) ? 'selected' : ''; 

                                                                    ?>

                                                                        <option value="<?= $idsupplier; ?>"<?= $selected?>><?= $namasupplier; ?></option>

                                                                    <?php

                                                                    }

                                                                    ?>

                                                                </select>

                                                                <br>

                                                                Quantity : <br>

                                                                <input type="number" name="qty" value="<?= $jumlah; ?>" class="form-control" required><br>

                                                                Unit :

                                                                <select name="unit" id="unit" class="form-control" required>

                                                                    <?php

                                                                    $units = ["PCS", "ROLL", "PACK", "LUSIN", "KG", "LITER", "GRAM", "TON"]; 

                                                                    foreach ($units as $satuan_bentuk) {

                                                                        $selected = ($satuan_bentuk == $unit) ? 'selected' : ''; 

                                                                        echo '<option value="' . $satuan_bentuk . '" ' . $selected . '>' . ucfirst($satuan_bentuk) . '</option>';

                                                                    }

                                                                    ?>

                                                                </select><br>

                                                                Harga Satuan : <br>

                                                                <input type="number" name="hargasatuan" value="<?= $harga_satuan; ?>" class="form-control" required><br>

                                                                Nomor PO :

                                                                <input type="text" name="invoice" value="<?= $faktur; ?>" class="form-control" required><br>

                                                                Keterangan :

                                                                <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" required><br>

                                                                <button type="submit" class="btn btn-primary" name="updatebarangmasuk" style="float: right;">Submit <i class="fas fa-arrow-circle-right"></i></button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>

                                            

                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $idm; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Hapus Data Masuk?</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                Apakah Anda Yakin Ingin Menghapus Data Masuk <strong> <?= $nama_barang; ?></strong> Pada Tanggal <strong><?= $tanggalterima?>?</strong>

                                                                <input type="hidden" name="idm" value="<?= $idm; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>

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

        $(function() {

            $('[id^="tanggalmasuk_"]').datepicker({

                dateFormat: "dd/mm/yy",

                dateMonth: true,

                dateYear: true

            });

        });

    </script>

</body>

<!-- The Modal -->

<div class="modal fade" id="myModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Tambah Barang Masuk</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <form method="post">

                <div class="modal-body">

                    <div id="form_barang">

                    <div class="barang-form">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="tanggalmasuk">Tanggal Masuk Barang:</label>

                                    <input type="date" name="tanggalmasuk[]" id="tanggalmasuk" class="form-control datepicker" required>

                                </div>



                                <div class="form-group">

                                    <label for="supplier2">Nama Supplier:</label>

                                    <div class="input-group">

                                        <select name="supplier2[]" class="form-control" required>

                                            <option value="">--Pilih--</option>

                                            <?php

                                            $ambilsemuadata = mysqli_query($conn, "select * from supplier");

                                            while ($fetcharray = mysqli_fetch_array($ambilsemuadata)) {

                                                $namasupplier = $fetcharray['namasupplier'];

                                                $idsupplier = $fetcharray['idsupplier'];

                                            ?>

                                                <option value="<?= $idsupplier; ?>"><?= $namasupplier; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                        <a href="supplier.php" class="input-group-text"><b>+</b></a>

                                   </div>

                                </div>



                                <div class="form-group">

                                    <label for="barangnya">Nama Barang:</label>

                                    <div class="input-group">

                                        <select name="barangnya[]" class="form-control" required>

                                            <option value="">--Pilih--</option>

                                            <?php

                                            $ambilsemuadatanya = mysqli_query($conn, "select * from stok");

                                            while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {

                                                $namabarangnya = $fetcharray['namabarang'];

                                                $idbarangnya = $fetcharray['idbarang'];

                                            ?>

                                                <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                        <a href="barang.php" class="input-group-text"><b>+</b></a>

                                   </div>

                                </div>



                                <div class="form-group">

                                    <label for="qty">Quantity:</label>

                                    <input type="number" name="qty[]" class="form-control" required>

                                </div>

                            </div>



                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="unit">Unit :</label>

                                    <select name="unit[]" id="selUnit" class="form-control unit" required>

                                        <option value="">--Pilih--</option>

                                        <option value="PCS">Pcs</option>

                                        <option value="ROLL">Roll</option>

                                        <option value="PACK">Pack</option>

                                        <option value="LUSIN">Lusin</option>

                                        <option value="KG">Kilogram (kg)</option>

                                        <option value="LITER">Liter (L)</option>

                                        <option value="GRAM">Gram (g)</option>

                                        <option value="TON">Ton (t)</option>

                                    </select>

                                </div>



                                <div class="form-group">

                                    <label for="hargasatuan">Harga Satuan:</label>

                                    <input type="number" name="hargasatuan[]" class="form-control" required>

                                </div>



                                <div class="form-group">

                                    <label for="invoice">Nomor PO:</label>

                                    <input type="text" name="invoice[]" class="form-control" required>

                                </div>

                                <div class="form-group">

                                    <input type="hidden" name="no_transaksi[]" class="form-control">

                                </div>


                                <div class="form-group">

                                    <label for="keterangan">Keterangan:</label>

                                    <input type="text" name="keterangan[]" class="form-control" value="-">

                                </div>

                            </div>

                        </div>



                        <div class="row">

                            <div class="col-md-12 text-center justify-content-center">

                                        <button type="button" class="btn btn-info tambah-barang">Barang +</button>

                                        <button type="button" class="btn btn-danger hapus-barang">Barang -</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <br>

                        <button type="submit" class="btn btn-primary form-control" name="barangmasuk">Submit <i class="fas fa-arrow-circle-right"></i></button>

                    </div>

                    </div>

                </div>

            </form>

            

        </div>

    </div>

</div>



<script>

    $(document).ready(function() {

        // Fungsi untuk menambah formulir barang

        var i = 2;

        

        $(".tambah-barang").click(function() {

            var html = `

                <div class="barang-form">

                    <div class="form-group">

                        <!-- Nomor barang -->

                        <div class="col-md-12 text-center py-3 justify-content-center">

                            <h4>Barang ${i++}</h4>

                        </div>



                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="tanggalmasuk">Tanggal Masuk Barang:</label>

                                    <input type="date" name="tanggalmasuk[]" id="tanggalmasuk" class="form-control datepicker" required>

                                </div>



                                <div class="form-group">

                                    <label for="supplier2">Nama Supplier:</label>

                                    <div class="input-group">

                                        <select name="supplier2[]" class="form-control" required>

                                            <option value="">--Pilih--</option>

                                            <?php

                                            $ambilsemuadata = mysqli_query($conn, "select * from supplier");

                                            while ($fetcharray = mysqli_fetch_array($ambilsemuadata)) {

                                                $namasupplier = $fetcharray['namasupplier'];

                                                $idsupplier = $fetcharray['idsupplier'];

                                            ?>

                                                <option value="<?= $idsupplier; ?>"><?= $namasupplier; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                        <a href="supplier.php" class="input-group-text"><b>+</b></a>

                                   </div>

                                </div>



                                <div class="form-group">

                                    <label for="barangnya">Nama Barang:</label>

                                    <div class="input-group">

                                        <select name="barangnya[]" class="form-control" required>

                                            <option value="">--Pilih--</option>

                                            <?php

                                            $ambilsemuadatanya = mysqli_query($conn, "select * from stok");

                                            while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {

                                                $namabarangnya = $fetcharray['namabarang'];

                                                $idbarangnya = $fetcharray['idbarang'];

                                            ?>

                                                <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                        <a href="barang.php" class="input-group-text"><b>+</b></a>

                                   </div>

                                </div>



                                <div class="form-group">

                                    <label for="qty">Quantity:</label>

                                    <input type="number" name="qty[]" class="form-control" required>

                                </div>

                            </div>



                            <div class="col-md-6">



                                <div class="form-group">

                                    <label for="unit">Unit :</label>

                                    <select name="unit[]" id="selUnit" class="form-control unit" required>

                                        <option value="">--Pilih--</option>

                                        <option value="PCS">Pcs</option>

                                        <option value="ROLL">Roll</option>

                                        <option value="PACK">Pack</option>

                                        <option value="LUSIN">Lusin</option>

                                        <option value="KG">Kilogram (kg)</option>

                                        <option value="LITER">Liter (L)</option>

                                        <option value="GRAM">Gram (g)</option>

                                        <option value="TON">Ton (t)</option>

                                    </select>

                                </div>



                                <div class="form-group">

                                    <label for="hargasatuan">Harga Satuan:</label>

                                    <input type="number" name="hargasatuan[]" class="form-control" required>

                                </div>

                                <div class="form-group">

                                    <input type="hidden" name="no_transaksi[]" class="form-control">

                                </div>



                                <div class="form-group">

                                    <label for="invoice">Nomor PO:</label>

                                    <input type="text" name="invoice[]" class="form-control" required>

                                </div>



                                <div class="form-group">

                                    <label for="keterangan">Keterangan:</label>

                                    <input type="text" name="keterangan[]" class="form-control" value="-">

                                </div>

                            </div>

                        </div>

                        

                        <hr>

                    </div>

                </div>

            `;

            $("#form_barang").append(html);



            return false;

        });



        // Fungsi untuk menghapus formulir barang terakhir

        $(".hapus-barang").click(function() {

            var barangForms = $("#form_barang .barang-form");

            if (barangForms.length > 1) {

                $(barangForms[barangForms.length - 1]).remove();

                i--; // Mengurangi nomor saat menghapus formulir

            }

            return false;

        });

    });

</script>



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

//menambah barang masuk

if (isset($_POST['barangmasuk'])) {

    // Ambil nilai dari $_POST

    $tgl_msk = $_POST['tanggalmasuk'];

    $supplier = $_POST['supplier2'];

    $barangnya2 = $_POST['barangnya'];

    $qty2 = $_POST['qty'];

    $unit2 = $_POST['unit'];

    $hargasatuan2 = $_POST['hargasatuan'];

    $invoice2 = $_POST['invoice'];

    $keterangan2 = $_POST['keterangan'];

    function generateUniqueTransactionCode($conn) {
        $tahun = date('Y');
        $bulan = date('m');
        
        // Query untuk mencari nomor transaksi terakhir untuk bulan ini
        $query = "SELECT MAX(idmasuk) AS no_transaksi FROM masuk WHERE YEAR(waktu_terakhir_aksi_masuk) = $tahun AND MONTH(waktu_terakhir_aksi_masuk) = $bulan";
        
        // statement
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        // Mendapatkan hasil
        $result = $stmt->get_result();
        
        // Mengambil data hasil
        $row = $result->fetch_assoc();
        
        // Mengambil nomor transaksi terakhir
        $lastNumber = $row['no_transaksi'];

        if (!$lastNumber) {
            $lastNumber = 0;
        }

        $lastNumber++;

        $newNumberFormatted = sprintf("%04s", $lastNumber);

        $transactionCode = "BM_$tahun$bulan/$newNumberFormatted";
        
        return $transactionCode;
    }



    for ($i = 0; $i < count($barangnya2); $i++) {

        $barangnya = $barangnya2[$i];

        $supplier2 = $supplier[$i];

        $qty = $qty2[$i];

        $unit = $unit2[$i];

        $hargasatuan = $hargasatuan2[$i];

        $invoice = $invoice2[$i];

        $keterangan = $keterangan2[$i];



        $tanggalmasuk = date('Y-m-d', strtotime($tgl_msk[$i]));



        // Mendapatkan nama supplier menggunakan prepared statement

        $query_supplier = "SELECT idsupplier, namasupplier FROM supplier WHERE idsupplier = ?";

        $stmt_supplier = $conn->prepare($query_supplier);

        $stmt_supplier->bind_param("i", $supplier2);

        $stmt_supplier->execute();

        $result_supplier = $stmt_supplier->get_result();



        if ($result_supplier->num_rows > 0) {

            $supplierInfo = $result_supplier->fetch_assoc();

            $idsupplier = $supplierInfo['idsupplier'];

            $namasupplier = $supplierInfo['namasupplier'];

        } else {

            echo 'Data supplier tidak ditemukan';

            exit; 

        }



        // Menyamakan atau mengupdate stok yang diinput dengan yang ada di stok

        $query_stok = "SELECT jmlhstok, namabarang, dokumentasi FROM stok WHERE idbarang = ?";

        $stmt_stok = $conn->prepare($query_stok);

        $stmt_stok->bind_param("i", $barangnya);

        $stmt_stok->execute();

        $result_stok = $stmt_stok->get_result();



        if ($result_stok->num_rows > 0) {

            $ambildatanya = $result_stok->fetch_assoc();

            $stoksekarang = $ambildatanya['jmlhstok'];

            $nama_barang = $ambildatanya['namabarang'];

            $gambar_depan = $ambildatanya['dokumentasi'];

            $tambahkanstoksekarangdenganquantity = $stoksekarang + $qty;

        } else {

            echo 'Data stok tidak ditemukan';

            exit; 

        }



        // Hitung total harga

        $totalharga = $qty * $hargasatuan;



        $kodeTransaksi = generateUniqueTransactionCode($conn);



        $role = $_SESSION['role'];



        // Mendapatkan username dari tabel login berdasarkan role

        $ambilUsername = mysqli_prepare($conn, "SELECT username, iduser FROM login WHERE role = ?");

        mysqli_stmt_bind_param($ambilUsername, "s", $role);

        mysqli_stmt_execute($ambilUsername);

        $resultUsername = mysqli_stmt_get_result($ambilUsername);

        $rowUsername = mysqli_fetch_assoc($resultUsername);

    

        $username2 = $rowUsername['username'];



        $insert_query = "INSERT INTO masuk (idbarang, nama_barang, jumlah, unit_masuk, harga_satuan, total_harga, idsupplier, nama_supplier, tanggal_penerimaan, faktur, keterangan, kode_transaksi_masuk, user_edit_masuk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_insert = $conn->prepare($insert_query);

        $stmt_insert->bind_param("isisidissssss", $barangnya, $nama_barang, $qty, $unit, $hargasatuan, $totalharga, $idsupplier, $namasupplier, $tanggalmasuk, $invoice, $keterangan, $kodeTransaksi, $username2);



        if ($stmt_insert->execute()) {

            // Update stok menggunakan prepared statement

            $update_stok_query = "UPDATE stok SET jmlhstok = ? WHERE idbarang = ?";

            $stmt_update_stok = $conn->prepare($update_stok_query);

            $stmt_update_stok->bind_param("ii", $tambahkanstoksekarangdenganquantity, $barangnya);



            if ($stmt_update_stok->execute()) {

                // Operasi berhasil

                echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Ditambahkan",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                window.location.href = "masuk.php"; 

                }, 1500);

                </script>';

            } else {

                echo 'Gagal';

                header('location:masuk.php');

            }

        } else {

            echo 'Gagal';

            header('location:masuk.php');

        }



        $stmt_insert->close();

        $stmt_update_stok->close();

    }

}





// Update info barang

if (isset($_POST['updatebarangmasuk'])) {

    // Ambil nilai dari $_POST

    $idb = $_POST['idb'];

    $idm = $_POST['idm'];

    $hargasatuan = $_POST['hargasatuan'];

    $qty = $_POST['qty'];

    $unit = $_POST['unit'];

    $tgl_msk = $_POST['tanggalmasuk_'];

    $supplier2 = $_POST['supplier2'];

    $barangnya = $_POST['barangnya'];

    $invoice = strtoupper($_POST['invoice']);

    $keterangan = strtoupper($_POST['keterangan']);



    // Mengambil tanggal sebelumnya

    $tanggalmasuk = date('Y-m-d', strtotime($tgl_msk));



    // Mendapatkan nama supplier menggunakan prepared statement

    $query_supplier = "SELECT idsupplier, namasupplier FROM supplier WHERE idsupplier = ?";

    $stmt_supplier = $conn->prepare($query_supplier);

    $stmt_supplier->bind_param("i", $supplier2);

    $stmt_supplier->execute();

    $result_supplier = $stmt_supplier->get_result();



    if ($result_supplier->num_rows > 0) {

        $supplierInfo = $result_supplier->fetch_assoc();

        $idsupplier = $supplierInfo['idsupplier'];

        $namasupplier = $supplierInfo['namasupplier'];

    } else {

        echo 'Data supplier tidak ditemukan';

        exit; 

    }



    // Mengambil stok sebelumnya

    $query_stok = "SELECT jmlhstok FROM stok WHERE idbarang = ?";

    $stmt_stok = $conn->prepare($query_stok);

    $stmt_stok->bind_param("i", $idb);

    $stmt_stok->execute();

    $result_stok = $stmt_stok->get_result();



    if ($result_stok->num_rows > 0) {

        $stoknya = $result_stok->fetch_assoc();

        $stoksebelumnya = $stoknya['jmlhstok'];

    } else {

        echo 'Data stok tidak ditemukan';

        exit; 

    }



    // Mengambil qty sebelumnya

    $query_qty = "SELECT jumlah FROM masuk WHERE idmasuk = ?";

    $stmt_qty = $conn->prepare($query_qty);

    $stmt_qty->bind_param("i", $idm);

    $stmt_qty->execute();

    $result_qty = $stmt_qty->get_result();



    if ($result_qty->num_rows > 0) {

        $qtynya = $result_qty->fetch_assoc();

        $qtysblm = $qtynya['jumlah'];

    } else {

        echo 'Data jumlah masuk tidak ditemukan';

        exit;

    }



    // Menghitung selisih qty

    $selisih_qty = $qty - $qtysblm;



    // Memperbarui stok berdasarkan selisih qty

    $stok_baru = $stoksebelumnya + $selisih_qty;

    // Hitung total harga

    $totalharga = $qty * $hargasatuan;



    $update_stok_query = "UPDATE stok SET jmlhstok = ? WHERE idbarang = ?";

    $stmt_update_stok = $conn->prepare($update_stok_query);

    $stmt_update_stok->bind_param("ii", $stok_baru, $idb);



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username2 = $rowUsername['username'];



    $update_masuk_query = "UPDATE masuk SET jumlah=?, unit_masuk=?, harga_satuan=?, total_harga=?, idsupplier=?, nama_supplier=?, tanggal_penerimaan=?, faktur=?, keterangan=?, user_edit_masuk=? WHERE idmasuk=?";

    $stmt_update_masuk = $conn->prepare($update_masuk_query);

    $stmt_update_masuk->bind_param("isidisssssi", $qty, $unit, $hargasatuan, $totalharga, $idsupplier, $namasupplier, $tanggalmasuk, $invoice, $keterangan, $username2, $idm);



    if ($stmt_update_stok->execute() && $stmt_update_masuk->execute()) {

        // Operasi berhasil

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "success",

            title: "Data Telah Diedit",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

        window.location.href = "masuk.php"; 

        }, 1500);

        </script>';

    } else {

        echo 'Gagal';

        header('location:masuk.php');

    }



    $stmt_update_stok->close();

    $stmt_update_masuk->close();

}





//Hapus barang

if (isset($_POST['hapusbarangmasuk'])) {

    $idm = $_POST['idm'];



    $query_qty = "SELECT idbarang, jumlah FROM masuk WHERE idmasuk = ?";

    $stmt_qty = $conn->prepare($query_qty);

    $stmt_qty->bind_param("i", $idm);

    $stmt_qty->execute();

    $result_qty = $stmt_qty->get_result();



    if ($result_qty->num_rows > 0) {

        $qtynya = $result_qty->fetch_assoc();

        $qtysblm = $qtynya['jumlah'];

        $idb = $qtynya['idbarang'];



        // Hapus data barang masuk menggunakan prepared statement

        $hapus_masuk_query = "DELETE FROM masuk WHERE idmasuk = ?";

        $stmt_hapus_masuk = $conn->prepare($hapus_masuk_query);

        $stmt_hapus_masuk->bind_param("i", $idm);

        $hapusmasuk = $stmt_hapus_masuk->execute();



        if ($hapusmasuk) {

            // Mengambil stok sebelumnya menggunakan prepared statement

            $query_stok = "SELECT jmlhstok FROM stok WHERE idbarang = ?";

            $stmt_stok = $conn->prepare($query_stok);

            $stmt_stok->bind_param("i", $idb);

            $stmt_stok->execute();

            $result_stok = $stmt_stok->get_result();



            if ($result_stok->num_rows > 0) {

                $stoknya = $result_stok->fetch_assoc();

                $stoksebelumnya = $stoknya['jmlhstok'];



                // Menghitung jumlah stok yang akan ditambahkan kembali

                $qtypashapus = $stoksebelumnya - $qtysblm;



                // Update jumlah stok di tabel stok menggunakan prepared statement

                $update_stok_query = "UPDATE stok SET jmlhstok = ? WHERE idbarang = ?";

                $stmt_update_stok = $conn->prepare($update_stok_query);

                $stmt_update_stok->bind_param("ii", $qtypashapus, $idb);

                $updatestokmasuk = $stmt_update_stok->execute();



                if ($updatestokmasuk) {

                    echo '<script type="text/javascript">      

                    Swal.fire({

                        position: "center",

                        icon: "success",

                        title: "Data Telah Dihapus",

                        showConfirmButton: false,

                        timer: 1500

                    });

                    setTimeout(function () { 

                    window.location.href = "masuk.php"; 

                    }, 1500);

                    </script>';

                } else {

                    echo 'Gagal';

                    header('location:masuk.php');

                }

            } else {

                echo 'Data stok tidak ditemukan';

                exit; 

            }

        } else {

            echo 'Gagal';

            header('location:masuk.php');

        }

    } else {

        echo 'Data jumlah masuk tidak ditemukan';

        exit; 

    }

}





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