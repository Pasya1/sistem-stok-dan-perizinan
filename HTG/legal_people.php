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

    <title>Legal People</title>

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

        background-color: #1E7458; 

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



    .bgdanger {

    background-color: rgba(255, 0, 0, 0.3); 

    }

    .bgwarning {

    background-color: rgba(255, 255, 0, 0.3); 

    }

    .bgputih {

    background-color: #fff; 

    }

    .modal-lg {

        max-width: 800px !important; 

    }



    </style>

</head>



<body class="sb-nav-fixed">

<?php

    if ($_SESSION['role'] !== 'admin_htg' && $_SESSION['role'] !== 'legal_htg') {

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

                            <h1 class="mt-3 text-center mb-4" style="color:#1E7458;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">LEGAL PEOPLE</h1>

                            <a href="export/exportlegalpeople.php" class="btn btn-info mb-2 shadow" style=" float: right;"><i class="fas fa-book"></i> Cetak Data Legal People</a>

                            <button type="button" class="btn btn-custom mx-1 mb-3 shadow" data-toggle="modal" data-target="#myModal" style=" float: right;">

                                <i class="fas fa-plus"></i> Tambah Data Legal People

                            </button>

                        </div>

                        <div class="">

                            <div class="table-responsive shadow-lg px-2 py-5" style="border-radius: 10px;">

                            <?php

                                date_default_timezone_set('Asia/Jakarta');

                                $query = mysqli_query($conn_htg, "SELECT * FROM legal_people");

                                while ($fetch = mysqli_fetch_array($query)) {

                                    $tanggalMasaHabis = date('Y-m-d', strtotime($fetch['masa_habis']));

                                    

                                    if ($fetch['masa_habis'] !== 'Tidak Ada') {

                                        $nama_lengkap = $fetch['nama_lengkap'];

                                        $jenis_sertifikat = $fetch['jenis_sertifikat'];

                                    

                                        $tanggalSaatIni = date('Y-m-d');

                                        $difference = strtotime($tanggalMasaHabis) - strtotime($tanggalSaatIni);

                                        $daysDifference = floor($difference / (60 * 60 * 24));



                                        $divClass = '';

                                            if ($tanggalMasaHabis <= $tanggalSaatIni) {

                                                $divClass = 'alert alert-danger alert-dismissible';

                                            } elseif ($daysDifference <= 3 * 30) {

                                                $divClass = 'alert alert-warning alert-dismissible';

                                            }



                                        if ($divClass != '') {

                                            echo '<div class="' . $divClass . '">';

                                            if ($tanggalMasaHabis == $tanggalSaatIni || $daysDifference <= 3 * 30) {

                                                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';

                                            }

                                            if ($tanggalMasaHabis <= $tanggalSaatIni) {

                                                echo 'Perhatian! Waktu Sertifikat <strong>' . $jenis_sertifikat . '</strong> milik <strong>' . $nama_lengkap . '</strong> telah habis';

                                            } elseif ($daysDifference <= 3 * 30) {

                                                echo 'Perhatian! Masa Habis Sertifikat <strong>' . $jenis_sertifikat . '</strong> milik <strong>' . $nama_lengkap . '</strong> akan segera habis';

                                            }

                                            echo '</div>';

                                        }

                                    }

                                ?>

                                <?php

                                }

                                ?>

                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px;">

                                    <thead style="background-color: #1E7458; color:white; text-transform: uppercase;">

                                    <tr>

                                        <th>Aksi</th>

                                        <th>Foto/Scan Sertifikat</th>

                                        <th>Nama lengkap</th>

                                        <th>Jenis Sertifikat</th>

                                        <th>Nomor Sertifikat</th>

                                        <th>Instansi Yang Mengeluarkan</th>

                                        <th>Tanggal Mengeluarkan</th>

                                        <th>Masa Habis</th>

                                        <th>Keterangan</th>

                                    </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                        date_default_timezone_set('Asia/Jakarta');

                                        // Query untuk mengambil data dari tabel "legal"

                                        $query = "SELECT * FROM legal_people";

                                        $result = mysqli_query($conn_htg, $query);



                                        if (!$result) {

                                            die('Query Error: ' . mysqli_error($conn_htg));

                                        }



                                        while ($row = mysqli_fetch_assoc($result)) {

                                            

                                        $id_legalpeople = $row['id_legalpeople'];

                                        $nama_lengkap = $row['nama_lengkap'];

                                        $jenis_sertifikat = $row['jenis_sertifikat'];



                                        $tanggalMasaHabis = $row['masa_habis'];

                                        $tanggalSaatIni = date('Y-m-d');



                                        if ($tanggalMasaHabis !== null && $tanggalMasaHabis !== '0000-00-00' && $tanggalMasaHabis !== 'Tidak Ada') {

                                    

                                            $tanggalMasaHabis = date('Y-m-d', strtotime($tanggalMasaHabis));



                                            $difference = strtotime($tanggalMasaHabis) - strtotime($tanggalSaatIni);

                                            $daysDifference = floor($difference / (60 * 60 * 24));

                                        }



                                        $gambar = $row['dokumentasi'];

                                        if($gambar==null){

                                            $gambar='Tidak Ada Photo';

                                        }else {

                                            $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';

                                        }





                                        ?>

                                            <tr class="<?php echo ($tanggalMasaHabis == 'Tidak Ada') ? 'bgputih' : (($tanggalMasaHabis <= $tanggalSaatIni) ? 'bgdanger' : ($daysDifference <= 3 * 30 ? 'bgwarning' : '')); ?>">

                                                <td>

                                                <div class="btn-group">

                                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#1E7458; height:30px; font-size:12px; color:white;">

                                                        <span class="sr-only">Toggle Dropdown</span>

                                                    </button>

                                                        <div class="dropdown-menu">

                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#edit<?= $id_legalpeople; ?>" style="margin-left: 5px; width: 140px; color: white;">

                                                            Edit

                                                        </button>

                                                        <input type="hidden" name="idbarangygingindihapus" value="<?= $idb; ?>">

                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $id_legalpeople; ?>" style="margin-left: 5px; width: 140px;">

                                                        Hapus

                                                        </button>

                                                        <a href="lihat_detail/lihatdetail_legalpeople.php?id_legalpeople=<?= $id_legalpeople; ?>" style="text-decoration: none;">

                                                        <button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" style="margin-left: 5px; width: 140px;">

                                                        Lihat Data

                                                        </button></a>

                                                        </div>

                                                </div>

                                                </td>

                                                <td><a href="lihat_detail/lihatdetail_legalpeople.php?id_legalpeople=<?= $id_legalpeople; ?>"><?= $gambar; ?></a></td>

                                                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>

                                                <td><a href="lihat_detail/lihatdetail_legalpeople.php?id_legalpeople=<?= htmlspecialchars($id_legalpeople); ?>#serti"><?= htmlspecialchars($row['jenis_sertifikat']) ?></a></td>

                                                <td><?= htmlspecialchars($row['nomor_sertifikat']) ?></td>

                                                <td><?= htmlspecialchars($row['instansi_mengeluarkan']) ?></td>

                                                <td style="text-transform: uppercase;"><?= htmlspecialchars(TanggalIndo($row['tanggal_mengeluarkan'])) ?></td>

                                                <?php

                                                if ($tanggalMasaHabis !== 'Tidak Ada') {

                                                ?>

                                                    <td style="text-transform: uppercase;"><?= htmlspecialchars(TanggalIndo($row['masa_habis'])) ?></td>

                                                <?php

                                                } else {

                                                ?>

                                                    <td style="text-transform: uppercase;"><?= htmlspecialchars($row['masa_habis']) ?></td>

                                                <?php

                                                }

                                                ?>

                                                <td><?= htmlspecialchars($row['keterangan']) ?></td>



                                             

                                            </tr>

                                            <!--Edit Modal -->

                                            <div class="modal fade" id="edit<?= $id_legalpeople; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data Legal People</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post" enctype="multipart/form-data">

                                                            <div class="modal-body">

                                                                <input type="hidden" name="id_legalpeople" value="<?= $id_legalpeople; ?>">

                                                                Edit Foto/Scan Sertifikat :

                                                                <input type="file" name="gambardepan" multiple accept="image/*" class="form-control"><br>

                                                                Nama Lengkap :  

                                                                <input type="text" name="nama_lengkap" value="<?= $row['nama_lengkap'] ?>" class="form-control" required><br>

                                                                Edit File PDF Sertifikat :

                                                                <input type="file" name="fileserti" multiple accept=".pdf" class="form-control"><br>

                                                                Jenis Sertifikat :

                                                                <input type="text" name="jenis_sertifikat" value="<?= $row['jenis_sertifikat'] ?>" class="form-control"  required><br>

                                                                Nomor Sertifikat :

                                                                <input type="text" name="nomor_sertifikat" value="<?= $row['nomor_sertifikat'] ?>" class="form-control"  required><br>

                                                                Instansi Yang Mengeluarkan :

                                                                <input type="text" name="instansi_mengeluarkan" value="<?= $row['instansi_mengeluarkan'] ?>" class=" form-control" required><br>

                                                                Tanggal Mengeluarkan :

                                                                <input type="date" name="tanggal_mengeluarkan" value="<?= $row['tanggal_mengeluarkan'] ?>" class=" form-control" required><br>

                                                                Masa Habis :

                                                                <input type="date" name="masa_habis" value="<?= $row['masa_habis'] ?>" class=" form-control"><br>                                                                

                                                                Keterangan :

                                                                <input type="text" name="keterangan" class="form-control" value="<?= $row['keterangan'] ?>" placeholder="Keterangan" required><br>

                                                                

                                                                <button type="submit" class="btn btn-custom" name="editlegal_people" style="float: right;">Submit <i class="fas fa-arrow-circle-right"></i></button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $id_legalpeople; ?>">

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

                                                                Apakah Anda yakin ingin menghapus Data <strong> <?= $nama_lengkap; ?></strong> Dengan Sertifikat <strong> <?= $jenis_sertifikat; ?>?</strong>

                                                                <input type="hidden" name="id_legalpeople" value="<?= $id_legalpeople; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapuslegal_people">Hapus</button>

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



    <!-- body belum ada -->

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



<!-- MODAL UNTUK INPUT DATA  -->

<!-- The Modal -->

<div class="modal fade" id="myModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Tambah Data Legal People</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <form method="post" enctype="multipart/form-data">

                <div class="modal-body" style="font-size: 15px;">

                <div class="row">

                    <div class="col-md-6">

                        <label for="gambardepan" class="form-label">Unggah Foto/Scan Sertifikat:</label>

                        <input type="file" name="gambardepan" multiple accept="image/*" class="form-control" required><br>

                        

                        <label for="nama_lengkap" class="form-label">Nama Lengkap:</label>

                        <input type="text" name="nama_lengkap" class="form-control" required><br>

                        

                        <label for="fileserti" class="form-label">Unggah File PDF Sertifikat:</label>

                        <input type="file" name="fileserti" class="form-control" multiple accept=".pdf" required><br>

                        

                        <label for="jenis_sertifikat" class="form-label">Jenis Sertifikat:</label>

                        <input type="text" name="jenis_sertifikat" class="form-control" required><br>



                        <label for="nomor_sertifikat" class="form-label">Nomor Sertifikat:</label>

                        <input type="text" name="nomor_sertifikat" class="form-control" required><br>

                    </div>

                    <div class="col-md-6">

                        

                        <label for="instansi_mengeluarkan" class="form-label">Instansi Yang Mengeluarkan:</label>

                        <input type="text" name="instansi_mengeluarkan" class="form-control" required><br>

                        

                        <label for="tanggal_mengeluarkan" class="form-label">Tanggal Mengeluarkan:</label>

                        <input type="date" name="tanggal_mengeluarkan" class="form-control" required><br>

                        

                        <label for="masa_habis" class="form-label">Masa Habis:</label>

                        <input type="date" name="masa_habis" class="form-control"><br>

                        

                        <label for="keterangan" class="form-label">Keterangan:</label>

                        <input type="text" name="keterangan" class="form-control" value="-"><br>

                    </div>

                </div>

                <button type="submit" class="btn btn-custom form-control" name="submit_legal_people">Submit <i class="fas fa-arrow-circle-right"></i></button>



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

if (isset($_POST['submit_legal_people'])) {

    $nama_lengkap = strtoupper($_POST['nama_lengkap']);

    $jenis_sertifikat = strtoupper($_POST['jenis_sertifikat']);

    $nomor_sertifikat = strtoupper($_POST['nomor_sertifikat']);

    $instansi_mengeluarkan = strtoupper($_POST['instansi_mengeluarkan']);

    $tanggal_mengeluarkan = $_POST['tanggal_mengeluarkan'];

    $masa_habis = $_POST['masa_habis'];

    $keterangan = strtoupper($_POST['keterangan']);



    if (!isset($masa_habis) || empty($masa_habis)) {

        $masa_habis = "Tidak Ada";

    }



    // Check if an image is uploaded

    if (isset($_FILES['gambardepan']) && $_FILES['gambardepan']['error'] === UPLOAD_ERR_OK) {

        $gambar_depan = $_FILES['gambardepan'];

        $nama_gambar_depan_people = $gambar_depan['name'];

        $lokasi_gambar_depan = $gambar_depan['tmp_name'];

        $folder_simpan = "images/";



        move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan_people);

    } else {

        $nama_gambar_depan_people = ""; 

    }



    // Check if an file is uploaded

    if (isset($_FILES['fileserti']) && $_FILES['fileserti']['error'] === UPLOAD_ERR_OK) {

        $pdfFiles = $_FILES['fileserti'];

        $pdfFileName = $pdfFiles['name'];

        $pdfFilePath = $pdfFiles['tmp_name'];

        $pdfUploadDir = "lihat_detail/dokumen_people/";



    } else {

        $pdfFileName = ""; 

    }



    $newPdfFilePath = $pdfUploadDir . $pdfFileName;

    move_uploaded_file($pdfFilePath, $newPdfFilePath);



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_htg, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username2 = $rowUsername['username'];





    $query = "INSERT INTO legal_people (dokumentasi, nama_lengkap, jenis_sertifikat, nomor_sertifikat, instansi_mengeluarkan, tanggal_mengeluarkan, masa_habis, keterangan, nama_file, pdf_path, user_edit_people) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn_htg, $query);

    

    if ($stmt) {

        mysqli_stmt_bind_param($stmt, "sssssssssss", $nama_gambar_depan_people, $nama_lengkap, $jenis_sertifikat, $nomor_sertifikat, $instansi_mengeluarkan, $tanggal_mengeluarkan, $masa_habis, $keterangan, $pdfFileName, $newPdfFilePath, $username2);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

    

        // Success notification

        echo '<script type="text/javascript">      

            Swal.fire({

                position: "center",

                icon: "success",

                title: "Data Telah Ditambahkan",

                showConfirmButton: false,

                timer: 1500

            });

            setTimeout(function () { 

                window.location.href = "legal_people.php"; 

            }, 1500);

            </script>';

    } else {

        // Error notification

        echo '<script type="text/javascript">      

            Swal.fire({

                position: "center",

                icon: "error",

                title: "Data Gagal Ditambahkan",

                showConfirmButton: false,

                timer: 1500

            });

            setTimeout(function () { 

                window.location.href = "legal_people.php"; 

            }, 1500);

            </script>';

    }

}    



//Hapus legal

if (isset($_POST['hapuslegal_people'])) {

    $id_legalpeople = $_POST['id_legalpeople'];



    // Fetch the image path and delete the associated image

    $get_image_query = mysqli_query($conn_htg, "SELECT dokumentasi FROM legal_people WHERE id_legalpeople='$id_legalpeople'");

    $image_data = mysqli_fetch_assoc($get_image_query);

    $image_path = "images/" . $image_data['dokumentasi'];



    if (file_exists($image_path)) {

        unlink($image_path);

    }



    $file = mysqli_query($conn_htg, "SELECT * FROM legal_people WHERE id_legalpeople='$id_legalpeople'");

    $get = mysqli_fetch_array($file);

    $lokfile = "lihat_detail/dokumen_people/" . $get['nama_file'];

    unlink($lokfile);



    $hapuspeople = mysqli_query($conn_htg, "DELETE FROM legal_people WHERE id_legalpeople='$id_legalpeople'");

    

    if ($hapuspeople) {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "success",

            title: "Data Berhasil Dihapus",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

            window.location.href = "legal_people.php"; 

        }, 1500);

        </script>';

    } else {

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "error",

            title: "Gagal Menghapus Data",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

            window.location.href = "legal_people.php"; 

        }, 1500);

        </script>';

    }

};



//EDIT DATA LEGAL

if (isset($_POST['editlegal_people'])) {

    $id_legalpeople = $_POST['id_legalpeople'];

    $nama_lengkap = strtoupper($_POST['nama_lengkap']);

    $jenis_sertifikat = strtoupper($_POST['jenis_sertifikat']);

    $nomor_sertifikat = strtoupper($_POST['nomor_sertifikat']);

    $instansi_mengeluarkan = strtoupper($_POST['instansi_mengeluarkan']);

    $tanggal_mengeluarkan = $_POST['tanggal_mengeluarkan'];

    $masa_habis = $_POST['masa_habis'];

    $keterangan = strtoupper($_POST['keterangan']);



    if (!isset($masa_habis) || empty($masa_habis)) {

        $masa_habis = "Tidak Ada";

    }



    // Simpan gambar depan

    $gambar_depan = $_FILES['gambardepan']; 

    $nama_gambar_depan_people = $gambar_depan['name'];

    $lokasi_gambar_depan = $gambar_depan['tmp_name'];

    $folder_simpan = "images/";



    // Move gambar depan ke direktori yang diinginkan

    move_uploaded_file($lokasi_gambar_depan, $folder_simpan . $nama_gambar_depan_people);



     // Check if an file is uploaded

     if (isset($_FILES['fileserti']) && $_FILES['fileserti']['error'] === UPLOAD_ERR_OK) {

        $pdfFiles = $_FILES['fileserti'];

        $pdfFileName = $pdfFiles['name'];

        $pdfFilePath = $pdfFiles['tmp_name'];

        $pdfUploadDir = "lihat_detail/dokumen_people/";



    } else {

        $pdfFileName = ""; 

    }



    $newPdfFilePath = $pdfUploadDir . $pdfFileName;

    move_uploaded_file($pdfFilePath, $newPdfFilePath);



    $role = $_SESSION['role'];



    // Mendapatkan username dari tabel login berdasarkan role

    $ambilUsername = mysqli_prepare($conn_htg, "SELECT username, iduser FROM login WHERE role = ?");

    mysqli_stmt_bind_param($ambilUsername, "s", $role);

    mysqli_stmt_execute($ambilUsername);

    $resultUsername = mysqli_stmt_get_result($ambilUsername);

    $rowUsername = mysqli_fetch_assoc($resultUsername);



    $username2 = $rowUsername['username'];



   // Check if an image was uploaded

   if (empty($nama_gambar_depan_people) && !empty($pdfFileName)) {

    $query = "UPDATE legal_people SET nama_file=?, pdf_path=?, nama_lengkap=?, jenis_sertifikat=?, nomor_sertifikat=?, instansi_mengeluarkan=?, tanggal_mengeluarkan=?, masa_habis=?, keterangan=?, user_edit_people=? WHERE id_legalpeople=?";

    $stmt = mysqli_prepare($conn_htg, $query);



        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssssssssssi", $pdfFileName, $newPdfFilePath, $nama_lengkap, $jenis_sertifikat, $nomor_sertifikat, $instansi_mengeluarkan, $tanggal_mengeluarkan, $masa_habis, $keterangan, $username2, $id_legalpeople);

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

                    window.location.href = "legal_people.php"; 

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

                    window.location.href = "legal_people.php"; 

                }, 1500);

                </script>';

        }

    } elseif (!empty($nama_gambar_depan_people) && empty($pdfFileName)) {

        $query = "UPDATE legal_people SET dokumentasi=?, nama_lengkap=?, jenis_sertifikat=?, nomor_sertifikat=?, instansi_mengeluarkan=?, tanggal_mengeluarkan=?, masa_habis=?, keterangan=?, user_edit_people=? WHERE id_legalpeople=?";

        $stmt = mysqli_prepare($conn_htg, $query);    

        

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sssssssssi", $nama_gambar_depan_people, $nama_lengkap, $jenis_sertifikat, $nomor_sertifikat, $instansi_mengeluarkan, $tanggal_mengeluarkan, $masa_habis, $keterangan, $username2, $id_legalpeople);

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

                    window.location.href = "legal_people.php"; 

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

                        window.location.href = "legal_people.php"; 

                    }, 1500);

                    </script>';

            }

        } elseif (!empty($nama_gambar_depan_people) && !empty($pdfFileName)) {

        $query = "UPDATE legal_people SET dokumentasi=?, nama_lengkap=?, jenis_sertifikat=?, nomor_sertifikat=?, instansi_mengeluarkan=?, tanggal_mengeluarkan=?, masa_habis=?, keterangan=?, nama_file=?, pdf_path=?, user_edit_people=? WHERE id_legalpeople=?";

        $stmt = mysqli_prepare($conn_htg, $query);



        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sssssssssssi", $nama_gambar_depan_people, $nama_lengkap, $jenis_sertifikat, $nomor_sertifikat, $instansi_mengeluarkan, $tanggal_mengeluarkan, $masa_habis, $keterangan, $pdfFileName, $newPdfFilePath, $username2, $id_legalpeople);

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

                    window.location.href = "legal_people.php"; 

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

                    window.location.href = "legal_people.php"; 

                }, 1500);

                </script>';

        }

    }else {

        $query = "UPDATE legal_people SET nama_lengkap=?, jenis_sertifikat=?, nomor_sertifikat=?, instansi_mengeluarkan=?, tanggal_mengeluarkan=?, masa_habis=?, keterangan=?, user_edit_people=? WHERE id_legalpeople=?";

        $stmt = mysqli_prepare($conn_htg, $query);    

        

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssssssssi", $nama_lengkap, $jenis_sertifikat, $nomor_sertifikat, $instansi_mengeluarkan, $tanggal_mengeluarkan, $masa_habis, $keterangan, $username2, $id_legalpeople);

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

                    window.location.href = "legal_people.php"; 

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

                        window.location.href = "legal_people.php"; 

                    }, 1500);

                    </script>';

            }

    }

}









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