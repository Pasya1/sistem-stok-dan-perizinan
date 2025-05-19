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

    <title>Legal Process</title>

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

            background-color: #4045AA; 

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

        .fixed-button {

            position: fixed;

            bottom: 20px;

            right: 0px;

            opacity: 1;

            transition: opacity 0.3s ease-in-out;

            z-index: 999;

        }



        .fixed-button:hover {

            opacity: 0.8;

        }



        @keyframes fade-up {

            0% {

                opacity: 0;

                transform: translateY(50px) scale(0);

            }

            100% {

                opacity: 1;

                transform: translateY(0) scale(1);

            }

        }



        .fade-up {

            opacity: 0;

            animation: fade-up 2s forwards;

            animation-delay: 1s; 

        }



        input[type="text"] {

        text-transform: uppercase;

        }

        .modal-lg {

        max-width: 800px !important; 

        }

    </style>

</head>



<body class="sb-nav-fixed">

    <?php

    if ($_SESSION['role'] !== 'admin_mes' && $_SESSION['role'] !== 'legal_mes') {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "error",

            title: "NOT ACCESS ",

            html: "Maaf, Anda tidak memiliki akses sebagai <strong> ADMIN  </strong> dan <strong> LEGAL </strong>. Silahkan lakukan login ulang jika ingin mengakses halaman ini",

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

                            <h1 class="mt-3 text-center mb-4" style="color:#4045AA;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">LEGAL PROCESS</h1>

                            <a href="export/exportlegaloperasional.php" class="btn btn-info mb-2 shadow" style=" float: right;"><i class="fas fa-book"></i> Cetak Data Legal Process</a>

                            <button type="button" class="btn btn-custom mx-1 mb-3 shadow" data-toggle="modal" data-target="#myModal" style=" float: right;">

                                <i class="fas fa-plus"></i> Tambah Data Legal Process

                            </button>

                        </div>

                        <div class="table-responsive shadow-lg px-4 py-5" style="border-radius:10px;">

                                <div class="sisipkan">

                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">

                                    <thead style="background-color: #4045AA; color:white;">

                                    <tr>

                                        <th>Aksi</th>

                                        <th>Foto/Scan Sertifikat</th>

                                        <th>Jenis Sertifikasi</th>

                                        <th>No. Sertifikat</th>

                                        <th>Instansi Yang Mengeluarkan</th>

                                        <th>Mulai Berlaku</th>

                                        <th>Akhir Berlaku</th>

                                        <th>Masa Berlaku</th>

                                        <th>Masa Habis</th>

                                        <th>Keterangan</th>

                                    </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                      

                                        $query = "SELECT * FROM legal";

                                        $result = mysqli_query($conn_mes, $query);



                                        if (!$result) {

                                            die('Query Error: ' . mysqli_error($conn_mes));

                                        }

                                        while ($row = mysqli_fetch_assoc($result)) {

                                            

                                        $idl = $row['id_legal'];

                                        $jenis_sertifikasi = $row['jenis_sertifikasi'];

                                        $mulai_berlaku = $row['mulai_berlaku'];

                                        $akhir_berlaku = $row['akhir_berlaku'];

                                        $countdown = $row['masa_habis'];

                                        $masa_habis = $row['masa_habis'];

  

                                        $mulai_berlaku = date('Y-m-d', strtotime($mulai_berlaku));



                                        $gambar = $row['dokumentasi'];

                                        if($gambar==null){

                                            $gambar='Tidak Ada Photo';

                                        }else {

                                            $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';

                                        }





                                            ?>

                                            <tr>

                                                <td>

                                                <div class="btn-group">

                                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#4045AA; height:30px; font-size:12px; color:white;">

                                                        <span class="sr-only">Toggle Dropdown</span>

                                                    </button>

                                                        <div class="dropdown-menu">

                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#edit<?= $idl; ?>" style="margin-left: 5px; width: 140px; color: white;">

                                                            Edit

                                                        </button>

                                                        <input type="hidden" name="idbarangygingindihapus" value="<?= $idb; ?>">

                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $idl; ?>" style="margin-left: 5px; width: 140px;">

                                                        Hapus

                                                        </button>

                                                        <a href="lihat_detail/lihatdetail_legal.php?id=<?= $idl; ?>" style="text-decoration: none;">

                                                        <button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" style="margin-left: 5px; width: 140px;">

                                                        Lihat Data

                                                        </button></a>

                                                        </div>

                                                </div>

                                                </td>

                                                <td><a href="lihat_detail/lihatdetail_legal.php?id=<?= $idl; ?>"><?= $gambar; ?></a></td>

                                                <td><a href="lihat_detail/lihatdetail_legal.php?id=<?= $idl; ?>"><?= htmlspecialchars($row['jenis_sertifikasi']) ?></a></td>

                                                <td><?= htmlspecialchars($row['no_sertifikat']) ?></td>

                                                <td><?= htmlspecialchars($row['mengeluarkan']) ?></td>

                                                <td><?= TanggalIndo($mulai_berlaku); ?></td>

                                                <?php

                                                if ($akhir_berlaku !== 'Tidak Ada') {

                                                ?>

                                                    <td><?= TanggalIndo($akhir_berlaku); ?></td>

                                                <?php

                                                } else {

                                                ?>

                                                    <td><?= htmlspecialchars($akhir_berlaku) ?></td>

                                                <?php

                                                }

                                                ?>

                                               

                                                <td><?= htmlspecialchars($row['masa_berlaku']) ?></td>

                                                <?php

                                                if ($masa_habis !== 'Tidak Ada') {

                                                ?>

                                                    <td class="countdown" data-masa-habis="<?= $masa_habis ?>"></td>

                                                <?php

                                                } else {

                                                ?>

                                                    <td><?= htmlspecialchars($masa_habis) ?></td>

                                                <?php

                                                }

                                                ?>

                                                

                                                <td><?= htmlspecialchars($row['keterangan']) ?></td>

                                             

                                            </tr>

                                            <!--Edit Modal -->

                                            <div class="modal fade" id="edit<?= $idl; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data Legal</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post" enctype="multipart/form-data">

                                                            <div class="modal-body">

                                                                <input type="hidden" name="idl" value="<?= $idl; ?>">

                                                                Edit Foto/Scan Sertifikat :

                                                                <input type="file" name="gambardepan" multiple accept="image/*" class="form-control"><br>

                                                                Jenis Sertifikasi : 

                                                                <input type="text" name="jenis_sertifikasi" value="<?= $row['jenis_sertifikasi'] ?>" class="form-control" required><br>

                                                                Edit File PDF Sertifikat :

                                                                <input type="file" name="fileserti" multiple accept=".pdf" class="form-control"><br>

                                                                No. Sertifikat : 

                                                                <input type="text" name="no_sertifikat" value="<?= $row['no_sertifikat'] ?>" class="form-control" required><br>

                                                                Mengeluarkan : 

                                                                <input type="text" name="mengeluarkan" value="<?= $row['mengeluarkan'] ?>" class="form-control"  required><br>

                                                                Mulai Berlaku :

                                                                <input type="date" name="mulai_berlaku" id="mulai_berlaku_<?= $idl; ?>" value="<?= $mulai_berlaku;?>" class="form-control"  required><br>

                                                                Akhir Berlaku :

                                                                <input type="date" name="akhir_berlaku" id="akhir_berlaku_<?= $idl; ?>" value="<?= $row['akhir_berlaku'] ?>" class="form-control"><br>

                                                                Masa Berlaku : 

                                                                <input type="text" name="masa_berlaku" value="<?= $row['masa_berlaku'] ?>" class="form-control"  required><br>

                                                                Masa Habis : 

                                                                <input type="datetime-local" name="masa_habis" value="<?php echo $countdown; ?>" class="form-control"><br>

                                                                Keterangan :

                                                                <input type="text" name="keterangan" class="form-control" value="<?= $row['keterangan'] ?>" placeholder="Keterangan" required><br>

                                                                

                                                                <button type="submit" class="btn btn-custom" name="editlegal" style="float: right;">Submit <i class="fas fa-arrow-circle-right"></i></button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $idl; ?>">

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

                                                                Apakah Anda yakin ingin menghapus <strong> <?= $jenis_sertifikasi; ?>?</strong>

                                                                <input type="hidden" name="idl" value="<?= $idl; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapuslegal">Hapus</button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>

                                        <?php

                                        }

                                        ?>

                                       

                                       </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    <!-- EMAIL NOTIF -->

                    <div class="fixed-button d-flex justify-content-end align-items-end text-end"> 

                        <button type="button" class="btn mb-2 fade-up" style="width:150px;" data-toggle="modal" data-target="#tambahEmailModal"><img src="assets/notif.png" class="w-100 " style="float: right;"></button>

                    </div>

                    <div class="d-flex align-items-center justify-content-between small">

                        <div class="modal fade" id="tambahEmailModal">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <!-- ... Bagian HTML modal untuk menambahkan email ... -->

                                    <div class="modal-header">

                                        <h4 class="modal-title">Tambah Email Anda</h4>

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    </div>

                                    <form method="post">

                                        <div class="modal-body" style="font-size: 15px;">

                                            Tambah Email Untuk Dapatkan Notifikasi Legal Complience :

                                            <input type="email" name="email" id="email" placeholder="Alamat Email" class="form-control" required><br>

                                            <button type="submit" name="sendEmailButton" class="btn btn-custom mb-2" style="float: right;">Kirim <i class="fas fa-arrow-circle-right"></i></button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>



                    <?php

                    // Tangani permintaan pengiriman email jika tombol diklik

                    if(isset($_POST['sendEmailButton'])){

                        $email = $_POST['email'];



                        // Periksa apakah email sudah ada di database sebelumnya

                        $checkQuery = "SELECT COUNT(*) as total FROM email_notifikasi WHERE email = ?";

                        $checkStmt = mysqli_prepare($conn_mes, $checkQuery);



                        if ($checkStmt) {

                            mysqli_stmt_bind_param($checkStmt, "s", $email);

                            mysqli_stmt_execute($checkStmt);

                            mysqli_stmt_bind_result($checkStmt, $total);

                            mysqli_stmt_fetch($checkStmt);



                            mysqli_stmt_close($checkStmt);



                            if ($total > 0) {

                                // Email sudah ada di database

                                echo '<script type="text/javascript">      

                                    Swal.fire({

                                        position: "center",

                                        icon: "warning",

                                        title: "Email Sudah Ada",

                                        showConfirmButton: false,

                                        timer: 1500

                                    });

                                    setTimeout(function () { 

                                        window.location.href = "legal.php"; 

                                    }, 1500);

                                    </script>';

                            } else {

                                // Email belum ada, simpan ke database

                                $query = "INSERT INTO email_notifikasi (email) VALUES (?)";

                                $stmt = mysqli_prepare($conn_mes, $query);



                                if ($stmt) {

                                    mysqli_stmt_bind_param($stmt, "s", $email);

                                    mysqli_stmt_execute($stmt);

                                    mysqli_stmt_close($stmt);



                                    // Tambahkan notifikasi berhasil

                                    echo '<script type="text/javascript">      

                                        Swal.fire({

                                            position: "center",

                                            icon: "success",

                                            title: "Data Telah Ditambahkan",

                                            showConfirmButton: false,

                                            timer: 1500

                                        });

                                        setTimeout(function () { 

                                            window.location.href = "legal.php"; 

                                        }, 1500);

                                        </script>';

                                } else {

                                    // Tambahkan notifikasi gagal

                                    echo '<script type="text/javascript">      

                                        Swal.fire({

                                            position: "center",

                                            icon: "error",

                                            title: "Data Gagal Ditambahkan",

                                            showConfirmButton: false,

                                            timer: 1500

                                        });

                                        setTimeout(function () { 

                                            window.location.href = "legal.php"; 

                                        }, 1500);

                                        </script>';

                                }

                            }

                        }

                    };



                    ?>

                    <!-- END NOTIF -->

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



    <script>

    // Ambil semua elemen dengan class "countdown"

    const countdowns = document.querySelectorAll('.countdown');



    let pesanPeringatanDitampilkan = {};





    // Loop untuk setiap elemen

    countdowns.forEach((countdown) => {

    // Ambil waktu masa habis dari data-masa-habis atribut pada elemen

    const masaHabis = new Date(countdown.getAttribute('data-masa-habis')).getTime();



    // Update hitungan mundur setiap detik

    const updateCountdown = () => {

        const now = new Date().getTime();

        const distance = masaHabis - now;



        // Hitung hari, jam, menit, dan detik

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        const seconds = Math.floor((distance % (1000 * 60)) / 1000);



        // Tampilkan hitungan mundur pada elemen yang bersangkutan

        countdown.innerHTML = days + " hari, " + hours + " jam, " +

            minutes + " menit, " + seconds + " detik, ";



            // Tampilkan alert dan ganti warna div menjadi danger jika waktu tersisa 3 bulan

            const waktuTigaBulanSebelum = masaHabis - 7776000000; // Tiga bulan sebelum waktu habis

            if (now >= waktuTigaBulanSebelum && now < masaHabis && !pesanPeringatanDitampilkan[masaHabis]) {

            pesanPeringatanDitampilkan[masaHabis] = true;

            

            countdown.parentElement.classList.add('alert', 'alert-warning');



            // Mendapatkan jenis_sertifikasi dari data saat ini (PHP)

            const jenisSertifikasi = countdown.closest('tr').querySelector('td:nth-child(3)').textContent.trim();



            // Buat pesan peringatan

            const pesanPeringatan = document.createElement('div');

            pesanPeringatan.classList.add('alert', 'alert-warning', 'alert-dismissible', 'mt-3');

             pesanPeringatan.innerHTML = '<button type="button" class="close" data-dismiss="alert">&times;</button>' +

                    'Masa Habis Izin <strong>' + jenisSertifikasi +'</strong> Tersisa <strong>3 bulan</strong> Segera Lakukan Perpanjangan!';

            

            // Sisipkan pesan peringatan di tempat yang diinginkan, misalnya setelah sisipkan

        

            const cardBody = countdown.closest('.sisipkan');

            cardBody.prepend(pesanPeringatan);

            }



        // Tampilkan alert jika waktu telah habis

        if (distance < 0) {

            clearInterval(interval);

            countdown.parentElement.classList.add('alert', 'alert-danger');

            countdown.innerHTML = "Waktu telah habis";



            const jenisSertifikasi = countdown.closest('tr').querySelector('td:nth-child(3)').textContent.trim();



            // Buat pesan pemberitahuan

            const pesanPemberitahuan = document.createElement('div');

            pesanPemberitahuan.classList.add('alert', 'alert-danger', 'alert-dismissible', 'mt-3');

            pesanPemberitahuan.innerHTML = '<button type="button" class="close" data-dismiss="alert">&times;</button>' +

                'Waktu Izin <strong>' + jenisSertifikasi +'</strong> Telah Habis!';



            // Sisipkan pesan pemberitahuan di tempat yang diinginkan, misalnya setelah sisipkan

            const cardBody = countdown.closest('.sisipkan');

            cardBody.prepend(pesanPemberitahuan);

        

        }

    };



    // Panggil fungsi updateCountdown setiap detik

    const interval = setInterval(updateCountdown, 1000);



    // Untuk memastikan hitungan mundur langsung terupdate saat halaman dimuat

    updateCountdown();

    });



    </script>



</body>



<!-- MODAL UNTUK INPUT DATA  -->

<!-- The Modal -->

<div class="modal fade" id="myModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Tambah Data Legal</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <form method="post" enctype="multipart/form-data">

                <div class="modal-body" style="font-size: 15px;">

                <div class="row">

                    <div class="col-md-6">

                        Unggah Foto/Scan Sertifikat :

                        <input type="file" name="gambardepan" multiple accept="image/*" class="form-control" required><br>

                        Jenis Sertifikasi : 

                        <input type="text" name="jenis_sertifikasi" class="form-control" required><br>

                        Unggah File PDF Sertifikat :

                        <input type="file" name="fileserti" class="form-control" multiple accept=".pdf" required><br>

                        No. Sertifikat : 

                        <input type="text" name="no_sertifikat" class="form-control" required><br>

                        Mengeluarkan : 

                        <input type="text" name="mengeluarkan" class="form-control"  required><br>

                        

                    </div>

                    <div class="col-md-6">

                        Mulai Berlaku :

                        <input type="date" name="mulai_berlaku" class="form-control"  required><br>

                        Akhir Berlaku :

                        <input type="date" name="akhir_berlaku" class="form-control" ><br>

                        Masa Berlaku : 

                        <input type="text" name="masa_berlaku" class="form-control"  required><br>

                        Masa Habis : 

                        <input type="datetime-local" name="masa_habis" class="form-control" ><br>

                        Keterangan :

                        <input type="text" name="keterangan" class="form-control" value="-" required><br>



                    </div>

                </div>

                    <button type="submit" class="btn btn-custom form-control" name="submit_legal">Submit <i class="fas fa-arrow-circle-right"></i></button>

                </div>

            </form>

            

        </div>

    </div>

</div>



<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<link rel="stylesheet" href="/resources/demos/style.css">

<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



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

// Menambah data legal

if (isset($_POST['submit_legal'])) {

    $jenis_sertifikasi = strtoupper($_POST['jenis_sertifikasi']);

    $no_sertifikat = strtoupper($_POST['no_sertifikat']);

    $mengeluarkan = strtoupper($_POST['mengeluarkan']);

    $mulai_berlaku = $_POST['mulai_berlaku'];

    $masa_berlaku = strtoupper($_POST['masa_berlaku']);

    $keterangan = strtoupper($_POST['keterangan']);    



    $akhir_berlaku = isset($_POST['akhir_berlaku']) ? $_POST['akhir_berlaku'] : '';

    if (!empty($akhir_berlaku)) {

        $akhir_berlaku = date('Y-m-d', strtotime($akhir_berlaku));

    } else {

        $akhir_berlaku = "Tidak Ada";

    }





    $masa_habis = isset($_POST['masa_habis']) ? $_POST['masa_habis'] : '';



    if (!empty($masa_habis)) {

        $masa_habis_formatted = date('Y-m-d H:i:s', strtotime($masa_habis));

    } else {

        $masa_habis_formatted = "Tidak Ada";

    }





    $gambar_array = $_FILES['gambar'];



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_mes, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username2 = $rowUsername['username'];

    

    // Simpan gambar depan

    $gambar_depan = $_FILES['gambardepan']; // Informasi gambar depan

    $nama_gambar_depan = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    // Move gambar depan ke direktori yang diinginkan

    move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);



    // Check if an file is uploaded

    if (isset($_FILES['fileserti']) && $_FILES['fileserti']['error'] === UPLOAD_ERR_OK) {

        $pdfFiles = $_FILES['fileserti'];

        $pdfFileName = $pdfFiles['name'];

        $pdfFilePath = $pdfFiles['tmp_name'];

        $pdfUploadDir = "lihat_detail/dokumen_legal_operasional/";

    } else {

        $pdfFileName = ""; 

    }



    $newPdfFilePath = $pdfUploadDir . $pdfFileName;

    move_uploaded_file($pdfFilePath, $newPdfFilePath);



    $query = "INSERT INTO legal (dokumentasi, jenis_sertifikasi, no_sertifikat, mengeluarkan, mulai_berlaku, akhir_berlaku, masa_berlaku, masa_habis, keterangan, user_edit_operasional, nama_file, pdf_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn_mes, $query);



        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssssssssssss", $nama_gambar_depan, $jenis_sertifikasi, $no_sertifikat, $mengeluarkan, $mulai_berlaku, $akhir_berlaku, $masa_berlaku, $masa_habis_formatted, $keterangan, $username2, $pdfFileName, $newPdfFilePath);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);



            // Tambahkan notifikasi berhasil

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Ditambahkan",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        } else {

            // Tambahkan notifikasi gagal

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Data Gagal Ditambahkan",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        }

};



//Hapus legal

if (isset($_POST['hapuslegal'])) {

    $idl = $_POST['idl'];



    // Fetch the image path

    $get_image = mysqli_prepare($conn_mes, "SELECT dokumentasi FROM legal WHERE id_legal = ?");

    mysqli_stmt_bind_param($get_image, 'i', $idl);

    mysqli_stmt_execute($get_image);

    mysqli_stmt_bind_result($get_image, $imagePath);

    mysqli_stmt_fetch($get_image);

    mysqli_stmt_close($get_image);



    // Delete the image from the directory

    $image = "images/" . $imagePath;

    if (file_exists($image)) {

        unlink($image);

    }



    // Delete record from the 'legal' table

    $delete_query = mysqli_prepare($conn_mes, "DELETE FROM legal WHERE id_legal = ?");

    mysqli_stmt_bind_param($delete_query, 'i', $idl);

    $hapus = mysqli_stmt_execute($delete_query);

    mysqli_stmt_close($delete_query);



    if ($hapus) {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "success",

            title: "Data Berhasil Dihapus",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

            window.location.href = "legal.php"; 

        }, 1500);

        </script>';

    } else {

        echo 'Gagal';

        header('location:legal.php');

    }

};





//EDIT DATA LEGAL

if (isset($_POST['editlegal'])) {

    $idl = $_POST['idl'];

    $jenis_sertifikasi = strtoupper($_POST['jenis_sertifikasi']);

    $no_sertifikat = strtoupper($_POST['no_sertifikat']);

    $mengeluarkan = strtoupper($_POST['mengeluarkan']);

    $mulai_berlaku = $_POST['mulai_berlaku'];

    $akhir_berlaku = $_POST['akhir_berlaku'];

    $masa_berlaku = strtoupper($_POST['masa_berlaku']);

    $masa_habis = $_POST['masa_habis'];

    $keterangan = strtoupper($_POST['keterangan']);  



    if (!empty($akhir_berlaku)) {

        $akhir_berlaku = date('Y-m-d', strtotime($akhir_berlaku));

    } else {

        $akhir_berlaku = "Tidak Ada";

    }



    if (!isset($masa_habis) || empty($masa_habis)) {

        $masa_habis = "Tidak Ada";

    }



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_mes, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username2 = $rowUsername['username'];

    

    // Simpan gambar depan

    $gambar_depan = $_FILES['gambardepan']; // Informasi gambar depan

    $nama_gambar_depan = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    // Move gambar depan ke direktori yang diinginkan

    move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan);



    // Check if an file is uploaded

    if (isset($_FILES['fileserti']) && $_FILES['fileserti']['error'] === UPLOAD_ERR_OK) {

        $pdfFiles = $_FILES['fileserti'];

        $pdfFileName = $pdfFiles['name'];

        $pdfFilePath = $pdfFiles['tmp_name'];

        $pdfUploadDir = "lihat_detail/dokumen_legal_operasional/";



    } else {

        $pdfFileName = ""; 

    }



    $newPdfFilePath = $pdfUploadDir . $pdfFileName;

    move_uploaded_file($pdfFilePath, $newPdfFilePath);





    if (empty($nama_gambar_depan) && !empty($pdfFileName)) {

        $query = "UPDATE legal SET nama_file=?, pdf_path=?, jenis_sertifikasi=?, no_sertifikat=?, mengeluarkan=?, mulai_berlaku=?, akhir_berlaku=?, masa_berlaku=?, masa_habis=?, keterangan=?, user_edit_operasional=? WHERE id_legal=?";

        $stmt = mysqli_prepare($conn_mes, $query);



        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sssssssssssi", $pdfFileName, $newPdfFilePath, $jenis_sertifikasi, $no_sertifikat, $mengeluarkan, $mulai_berlaku, $akhir_berlaku, $masa_berlaku, $masa_habis, $keterangan, $username2, $idl);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);



            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        } else {

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Data Gagal Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        }

    } elseif (!empty($nama_gambar_depan) && empty($pdfFileName)) {

        $query = "UPDATE legal SET dokumentasi=?, jenis_sertifikasi=?, no_sertifikat=?, mengeluarkan=?, mulai_berlaku=?, akhir_berlaku=?, masa_berlaku=?, masa_habis=?, keterangan=?, user_edit_operasional=? WHERE id_legal=?";

        $stmt = mysqli_prepare($conn_mes, $query);



        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssssssssssi", $nama_gambar_depan, $jenis_sertifikasi, $no_sertifikat, $mengeluarkan, $mulai_berlaku, $akhir_berlaku, $masa_berlaku, $masa_habis, $keterangan, $username2, $idl);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);



            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        } else {

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Data Gagal Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        }

    

    } elseif (!empty($nama_gambar_depan) && !empty($pdfFileName)) {

        $query = "UPDATE legal SET dokumentasi=?, nama_file=?, pdf_path=?, jenis_sertifikasi=?, no_sertifikat=?, mengeluarkan=?, mulai_berlaku=?, akhir_berlaku=?, masa_berlaku=?, masa_habis=?, keterangan=?, user_edit_operasional=? WHERE id_legal=?";

        $stmt = mysqli_prepare($conn_mes, $query);



        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssssssssssssi", $nama_gambar_depan, $pdfFileName ,$newPdfFilePath , $jenis_sertifikasi, $no_sertifikat, $mengeluarkan, $mulai_berlaku, $akhir_berlaku, $masa_berlaku, $masa_habis, $keterangan, $username2, $idl);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);



            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        } else {

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Data Gagal Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        }

    

    } else {

        $query = "UPDATE legal SET jenis_sertifikasi=?, no_sertifikat=?, mengeluarkan=?, mulai_berlaku=?, akhir_berlaku=?, masa_berlaku=?, masa_habis=?, keterangan=?, user_edit_operasional=? WHERE id_legal=?";

        $stmt = mysqli_prepare($conn_mes, $query);



        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sssssssssi", $jenis_sertifikasi, $no_sertifikat, $mengeluarkan, $mulai_berlaku, $akhir_berlaku, $masa_berlaku, $masa_habis, $keterangan, $username2, $idl);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);



            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "success",

                    title: "Data Telah Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        } else {

            echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Data Gagal Diedit",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                    window.location.href = "legal.php"; 

                }, 1500);

                </script>';

        }

    }

};





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