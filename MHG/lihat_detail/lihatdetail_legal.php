<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'legal') {
    header("Location: ../login.php");
    exit;
}

$id_legal = $_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM legal WHERE id_legal = ?");
mysqli_stmt_bind_param($stmt, 's', $id_legal);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$fetch = mysqli_fetch_assoc($result);

$gambar = $fetch['dokumentasi'];
$jenis_sertifikasi = htmlspecialchars($fetch['jenis_sertifikasi']);
$no_sertifikat = htmlspecialchars($fetch['no_sertifikat']);
$mengeluarkan = htmlspecialchars($fetch['mengeluarkan']);
$mulai_berlaku = htmlspecialchars($fetch['mulai_berlaku']);
$akhir_berlaku = htmlspecialchars($fetch['akhir_berlaku']);
$masa_berlaku = htmlspecialchars($fetch['masa_berlaku']);
$masa_habis = htmlspecialchars($fetch['masa_habis']);
$keterangan = htmlspecialchars($fetch['keterangan']);

if($gambar==null){
    $gambar='Tidak Ada Photo';
}else {
    $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
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
    <title>DETAIL LEGAL PROCESS</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../sweetalert2.min.css">
    <style>
         .gambarfoto{
            width:100%;
            height:90%;
            border-radius:5px;
        }
        h5{
            font-size:15px;
        }
        .gambarterkait{
            width:70%;
            
        }
        .gambarterkait:hover{
            transform: scale(1.7);
            transition: 0.5 ease;
        }
        .gambarfoto img {
            border: 2px solid #fff; 
            border-radius: 5px; 
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

    <?php include 'navdetail.php'; ?>

    <div id="layoutSidenav">
        <?php include 'sidenavdetail.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="row py-2 ">    
                    <a href="../legal.php" class="btn btn-danger mb-2 shadow" style="font-size:14px; font-weight: lighter;"><i class="fas fa-arrow-left"></i> </a><br>
                    </div>    
                    <h1 class="mt-3 text-center mb-4" style="color:#427D9D; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);"><?=$jenis_sertifikasi;?></h1>
                        <div class="card-body">
                            <div class="row mt-5">
                                <h4 style="color:#427D9D; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Detail Legal</h4>
                            </div>
                            <div class="row mt-3" style="background-color:#427D9D; border-radius:3px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                <div class="col-md-5">
                                    <div class="gambarfoto mt-2 d-flex align-items-center justify-content-center shadow"><?=$gambar;?></div>
                                </div>
                                <div class="col-md-7 mt-3">
                                    <div class="row" style="color:#fff; font-size:12px;">
                                        <div class="col-md-6 col-12">
                                            <h5>JENIS SERTIFIKASI :</h5>
                                            <p><?=$jenis_sertifikasi;?></p>

                                            <h5>NO. SERTIFIKAT :</h5>
                                            <p><?=$no_sertifikat;?></p>

                                            <h5>MENGELUARKAN :</h5>
                                            <p><?=$mengeluarkan;?></p>
                                                
                                            <h5>MASA BERLAKU :</h5>
                                            <p><?=$masa_berlaku;?></p>
                                            
                                            <h5>KETERANGAN :</h5>
                                            <p><?=$keterangan;?></p>
                                        </div>
                                        <div class="col-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row justify-content-center mt-5" style="color:#fff; ">
                                <div class=" col-md-3 text-center py-3 mx-3 mb-3" style="background-color:#427D9D; border-radius:10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                    <h4>Mulai Berlaku</h4>
                                    <div class="dropdown-divider mb-2"></div>
                                    <?=TanggalIndo($mulai_berlaku);?>
                                </div>
                                <div class=" col-md-3 text-center py-3 mx-3 mb-3" style="background-color:#427D9D; border-radius:10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                    <h4>Akhir Berlaku</h4>
                                    <div class="dropdown-divider mb-2"></div>
                                    <?php
                                        if ($akhir_berlaku !== 'Tidak Ada') {
                                    ?>
                                        <p><?=TanggalIndo($akhir_berlaku);?></p>
                                    <?php
                                    } else {
                                    ?>
                                        <p><?= htmlspecialchars($akhir_berlaku) ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class=" col-md-3 text-center py-3 mx-3 mb-3" style="background-color:#427D9D; border-radius:10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                    <h4>Masa Habis</h4>
                                    <div class="dropdown-divider mb-2"></div>
                                    <?php
                                        if ($masa_habis !== 'Tidak Ada') {
                                    ?>
                                        <p class="countdown" style="margin-top:-5px;" data-masa-habis="<?= $masa_habis ?>"></p>
                                    <?php
                                    } else {
                                    ?>
                                        <p><?= htmlspecialchars($masa_habis) ?></p>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="row" id="serti">
                                <div class="col-md-12 my-4">
                                    <h4 style="color:#427D9D;">FILE SERTIFIKAT :</h4>
                                </div>  
                                <div class="col-md-12">
                                    <?php
                                    $ambildarilegal = "SELECT * FROM legal where id_legal = '$id_legal'";
                                    $result = mysqli_query($conn, $ambildarilegal);
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                        $nama_file = $row['nama_file'];
                                        $pdf_path = $row['pdf_path'];

                                        echo '<img src="../assets/pdficon.png" style="width:10%;" class="mx-2">';
                                        echo '<a href="../' . $row['pdf_path'] . '">' . $row['nama_file'] . '</a></img><br>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <div class="col-md-6">
                                    <h4 style="color:#427D9D;">LAMPIRAN :</h4>
                                </div>    
                                <div class="col-md-6">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="background-color:#427D9D; float: right; color:white;">Tambah Dokumen/Gambar +</button>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <!-- MENAMPILKAN DOKUMEN -->
                                    <?php
                                    $query = "SELECT * FROM dokumen_legal where id_legal = '$id_legal'";
                                    $result = mysqli_query($conn, $query);
                                            
                                    // Menampilkan data
    
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<div class="row d-flex bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                                $nama_file = $row['nama_berkas'];
                                                $link_file = $row['pdf_path'];
                                                $id_berkas = $row['id_berkas'];
                        
                                                if($nama_file==NULL){
                                                    
                                                }else{
                                                    echo '<div class="col-md-3 d-flex align-items-center mt-3 mb-3">';
                                                        echo '<img src="../assets/pdficon.png" style="width:20%;" class="mx-2">';
                                                        echo '<a href="' . $row['pdf_path'] . '">' . $row['nama_berkas'] . '</a></img><br>';
                                                        ?>
                                                        <button type="button" class="btn btn-danger mb-2 mx-2 mt-4 justify-content-center align-items-center d-flex" data-toggle="modal" data-target="#deleteFile1Modal<?= $id_berkas; ?>" style="width: 20px;">
                                                        <div class="fas fa-trash" style="width: 15px;"></div>
                                                        </button>
                                                        <?php

                                                    echo '</div>';
                                                }

                                                ?>

                                                <!-- MODAL HAPUS DOKUMEN -->
                                                <div class="modal fade" id="deleteFile1Modal<?= $id_berkas; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteFile1ModalLabel<?= $id_berkas; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteFile1ModalLabel<?= $id_berkas; ?>">Konfirmasi Hapus Berkas</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus <strong><?= $nama_file?> ?</strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post">
                                                                <input type="hidden" name="id_berkas" value="<?= $id_berkas; ?>">
                                                                <button type="submit" name="hapus_berkas" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <?php

                                            }
                                        echo '</div>';
                                    } else {
                                        echo '<div class="row px-2 py-3 bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                            echo "*Tidak Ada Dokumen Terlampir";
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                                    <!-- UNTUK MENAMPILKAN GAMBAR -->
                                <div class="col-md-12 mt-3">
                                    <?php
                                    $query = "SELECT * FROM dokumen_legal where id_legal = '$id_legal'";
                                    $result = mysqli_query($conn, $query);
                                            
                                    // Menampilkan data
    
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<div class="row d-flex bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $nama_gambar = $row['nama_gambar'];
                                            $link_gambar = $row['gambar_path'];
                                            $id_berkas = $row['id_berkas'];
                    
                                            if($nama_gambar==NULL){
                                                
                                            }else{
                                                echo '<div class="col-md-3 d-flex align-items-center text-center mt-3 mb-3">';
                                                    echo '<a href="' . $row['gambar_path'] . '" target="_blank">';
                                                    echo '<img src="' . $row['gambar_path'] . '" alt="Gambar" class="gambarterkait"></a>';
                                                    ?>
                                                    <button type="button" class="btn btn-danger mb-2 mx-2 mt-4 justify-content-center align-items-center d-flex" data-toggle="modal" data-target="#deleteGambar1Modal<?= $id_berkas; ?>" style="width: 20px;">
                                                    <div class="fas fa-trash" style="width: 15px;"></div>
                                                    </button>
                                                    <?php
                                                echo '</div>';
                                            }

                                            ?>

                                            <!-- MODAL HAPUS GAMBAR -->
                                            <div class="modal fade" id="deleteGambar1Modal<?= $id_berkas; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteGambar1ModalLabel<?= $id_berkas; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteGambar1ModalLabel<?= $id_berkas; ?>">Konfirmasi Hapus Gambar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <strong><?= $nama_gambar?> ?</strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <input type="hidden" name="id_berkas" value="<?= $id_berkas; ?>">
                                                            <button type="submit" name="hapus_gambar" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php                                            

                                        }
                                        echo '</div>';
                                    } else {
                                        echo '<div class="row px-2 py-3 bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                            echo "*Tidak Ada Gambar Terlampir";
                                        echo '</div>';
                                    }
                                    ?>
                                </div> 
                                   
                                        
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
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
        })
    </script>

    <script>
        // Ambil semua elemen dengan class "countdown"
        const countdowns = document.querySelectorAll('.countdown');
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

                // Tampilkan hitungan mundur pada elemen
                countdown.innerHTML = days + " hari, " + hours + " jam, "
                    + minutes + " menit, " + seconds + " detik, ";

                // Tampilkan alert jika waktu tersisa 3 bulan
                if (now >= waktuTigaBulanSebelum && now < masaHabis) {
                    alert("Waktu tersisa 3 bulan sebelum habis!");
                }

                // Tampilkan alert jika waktu telah habis
                if (distance < 0) {
                    clearInterval(interval  );
                    countdown.innerHTML = "Waktu telah habis";
                    // Tampilkan alert
                    alert("Waktu telah habis!");
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
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Legal</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body" style="font-size: 15px;">
                    <input type="hidden" name="idl" value="<?= $id_legal; ?>">
                    Pilih Dokumen PDF:
                    <input type="file" name="pdf_file[]" id="pdf_file" multiple accept=".pdf" class="form-control"><br>
                    Pilih Gambar:
                    <input type="file" name="image_file[]" id="image_file" multiple accept="image/*" class="form-control"><br>
                    <button type="submit" class="btn btn-primary" name="submit_dokumen">Submit</button>
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
if (isset($_POST['submit_dokumen'])) {
    $pdfUploadDir = "../lihat_detail/dokumen/";
    $imageUploadDir = "../lihat_detail/gambar-gambar_legal/";

    $pdfFiles = $_FILES['pdf_file'];
    $imageFiles = $_FILES['image_file'];

    $id_legal = $_POST['idl'];

    // Prepare PDF statement
    $pdfStmt = mysqli_prepare($conn, "INSERT INTO dokumen_legal (nama_berkas, pdf_path, id_legal) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($pdfStmt, "ssi", $pdfFileName, $pdfFilePath, $id_legal);

    // Upload PDF files
    foreach ($pdfFiles['tmp_name'] as $key => $tmp_name) {
        $pdfFileName = $pdfFiles['name'][$key];
        $pdfFilePath = $pdfUploadDir . $pdfFileName;

        move_uploaded_file($pdfFiles['tmp_name'][$key], $pdfFilePath);

        if ($pdfFileName != NULL) {
            mysqli_stmt_execute($pdfStmt);
        }
    }

    // Prepare image statement
    $imageStmt = mysqli_prepare($conn, "INSERT INTO dokumen_legal (nama_gambar, gambar_path, id_legal) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($imageStmt, "ssi", $imageFileName, $imageFilePath, $id_legal);

    // Upload image files
    foreach ($imageFiles['tmp_name'] as $key => $tmp_name) {
        $imageFileName = $imageFiles['name'][$key];
        $imageFilePath = $imageUploadDir . $imageFileName;

        move_uploaded_file($imageFiles['tmp_name'][$key], $imageFilePath);

        if ($imageFileName != NULL) {
            mysqli_stmt_execute($imageStmt);
        }
    }

    // Close prepared statements
    mysqli_stmt_close($pdfStmt);
    mysqli_stmt_close($imageStmt);

    echo '<script type="text/javascript">      
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Data Telah Ditambahkan",
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function () { 
                window.location.href = "lihatdetail_legal.php?id=' . $id_legal . '";  
            }, 1500);
            </script>';
}


//Hapus Gambar
if (isset($_POST['hapus_gambar'])) {
    $id_berkas = $_POST['id_berkas'];

    // Prepared statement untuk menghapus data dari tabel dokumen_legal
    $delete_query = "DELETE FROM dokumen_legal WHERE id_berkas = ?";
    
    // Hapus gambar dari direktori
    $select_query = "SELECT nama_gambar FROM dokumen_legal WHERE id_berkas = ?";
    $select_statement = mysqli_prepare($conn, $select_query);
    mysqli_stmt_bind_param($select_statement, "s", $id_berkas);
    mysqli_stmt_execute($select_statement);
    $result = mysqli_stmt_get_result($select_statement);
    $row = mysqli_fetch_assoc($result);
    $nama_gambar = $row['nama_gambar'];
    $lokgambar = "../lihat_detail/gambar-gambar_legal/" . $nama_gambar;
    unlink($lokgambar);

    // Hapus data dari tabel dokumen_legal
    $delete_statement = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($delete_statement, "s", $id_berkas);
    $hapusgambar1 = mysqli_stmt_execute($delete_statement);

    if ($hapusgambar1) {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Data Berhasil Dihapus",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "lihatdetail_legal.php?id=' . $id_legal . '"; 
        }, 1500);
        </script>';
    } else {
        echo 'Gagal';
        header('Location: lihatdetail_legal.php?id=' . $id_legal);
    }
};

//Hapus File
if (isset($_POST['hapus_berkas'])) {
    $id_berkas = $_POST['id_berkas'];

    // Prepared statement untuk menghapus data dari tabel dokumen_legal
    $delete_query = "DELETE FROM dokumen_legal WHERE id_berkas = ?";
    
    // Hapus file dari direktori
    $select_query = "SELECT nama_berkas FROM dokumen_legal WHERE id_berkas = ?";
    $select_statement = mysqli_prepare($conn, $select_query);
    mysqli_stmt_bind_param($select_statement, "s", $id_berkas);
    mysqli_stmt_execute($select_statement);
    $result = mysqli_stmt_get_result($select_statement);
    $row = mysqli_fetch_assoc($result);
    $nama_berkas = $row['nama_berkas'];
    $lokfile = "../lihat_detail/dokumen/" . $nama_berkas;
    unlink($lokfile);

    // Hapus data dari tabel dokumen_legal
    $delete_statement = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($delete_statement, "s", $id_berkas);
    $hapusdok1 = mysqli_stmt_execute($delete_statement);

    if ($hapusdok1) {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Data Berhasil Dihapus",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "lihatdetail_legal.php?id=' . $id_legal . '"; 
        }, 1500);
        </script>';
    } else {
        echo 'Gagal';
        header('Location: lihatdetail_legal.php?id=' . $id_legal);
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