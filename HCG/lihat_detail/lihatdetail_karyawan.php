<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin_hcg' && $_SESSION['role'] !== 'logistik_hcg' && $_SESSION['role'] !== 'legal_hcg' && $_SESSION['role'] !== 'supply_hcg') {
    header("Location: ../login.php");
    exit;
}

$id_karyawan = $_GET['idkaryawan'];

$get = mysqli_prepare($conn_hcg, "SELECT * FROM karyawan WHERE idkaryawan=?");
mysqli_stmt_bind_param($get, "s", $id_karyawan);
mysqli_stmt_execute($get);
$result = mysqli_stmt_get_result($get);
$fetch = mysqli_fetch_assoc($result);

$gambar = $fetch['foto_karyawan'];
$namakaryawan = htmlspecialchars($fetch['namakaryawan']);
$alamat = htmlspecialchars($fetch['alamat_karyawan']);
$no_telepon = htmlspecialchars($fetch['no_telepon_karyawan']);
$divisi = htmlspecialchars($fetch['divisi']);
$idkaryawan = htmlspecialchars($fetch['idkaryawan']);
$keterangan = htmlspecialchars($fetch['keterangan_karyawan']);
$nik = htmlspecialchars($fetch['nik']);
$status = htmlspecialchars($fetch['status']);
$no_ktp = htmlspecialchars($fetch['no_ktp']);

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
    <title>DETAIL KARYAWAN</title>
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
            background-color: #FF364C; 
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
                    <a href="../karyawan.php" class="btn btn-danger mb-2 shadow" style="font-size:14px; font-weight: lighter;"><i class="fas fa-arrow-left"></i> </a><br>
                    </div>    
                    <h1 class="mt-3 text-center mb-4" style="color:#FF364C; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);"><?=$namakaryawan;?></h1>
                        <div class="card-body">
                            <div class="row mt-5">
                                <h4 style="color:#FF364C; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Detail Karyawan</h4>
                            </div>
                            <div class="row mt-3" style="background-color:#FF364C; border-radius:3px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                <div class="col-md-5">
                                    <div class="gambarfoto mt-2 d-flex align-items-center justify-content-center shadow"><?=$gambar;?></div>
                                </div>
                                <div class="col-md-7 mt-3">
                                    <div class="row" style="color:#fff; font-size:12px;">
                                        <div class="col-md-6 col-12">
                                            <h5>NAMA KARYAWAN :</h5>
                                            <p><?=$namakaryawan;?></p>

                                            <h5>NOMOR INDUK KARYAWAN :</h5>
                                            <p><?=$nik;?></p>
                                            
                                            <h5>DEPARTEMEN :</h5>
                                            <p><?=$divisi;?></p>

                                            <h5>NO TELEPON :</h5>
                                            <p><?=$no_telepon;?></p>
                                        </div>
                                        <div class="col-6">

                                            <h5>NO KTP :</h5>
                                            <p><?=$no_ktp;?></p>

                                            <h5>ALAMAT :</h5>
                                            <p><?=$alamat;?></p>

                                            <h5>STATUS KEPEGAWAIAN :</h5>
                                            <p><?=$status;?></p>

                                            <h5>KETERANGAN :</h5>
                                            <p><?=$keterangan;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row justify-content-center mt-5">
                                <div class="col-md-6">
                                    <h4 style="color:#FF364C;">LAMPIRAN :</h4>
                                </div>    
                                <div class="col-md-6">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="background-color:#FF364C; float: right; color:white;">Tambah Dokumen/Gambar +</button>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <!-- MENAMPILKAN DOKUMEN -->
                                    <?php
                                    // MENAMPILKAN DOKUMEN
                                    $query = "SELECT * FROM dokumen_karyawan where idkaryawan = '$id_karyawan'";
                                    $result = mysqli_query($conn_hcg, $query);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo '<div class="row d-flex bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $nama_file2 = $row['nama_berkas'];
                                            $link_file2 = $row['pdf_path'];
                                            $id_berkas_karyawan = $row['id_berkas_karyawan'];

                                            if ($nama_file2 == NULL) {
                                               
                                            } else {
                                                echo '<div class="col-md-3 d-flex align-items-center mt-3 mb-3">';
                                                echo '<img src="../assets/pdficon.png" style="width:20%;" class="mx-2">';
                                                echo '<a href="' . $row['pdf_path'] . '">' . $row['nama_berkas'] . '</a></img><br>';
                                                ?>
                                                <button type="button" class="btn btn-danger mb-2 mx-2 mt-4 justify-content-center align-items-center d-flex" data-toggle="modal" data-target="#deleteFileModal<?= $id_berkas_karyawan; ?>" style="width: 20px;">
                                                <div class="fas fa-trash" style="width: 15px;"></div>
                                                </button>
                                                <?php
                                                echo '</div>';
                                            }

                                            ?>

                                            <!-- MODAL HAPUS DOKUMEN -->
                                            <div class="modal fade" id="deleteFileModal<?= $id_berkas_karyawan; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteFileModalLabel<?= $id_berkas_karyawan; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteFileModalLabel<?= $id_berkas_karyawan; ?>">Konfirmasi Hapus Berkas</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <strong><?= $nama_file2?> ?</strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <input type="hidden" name="id_berkas_karyawan" value="<?= $id_berkas_karyawan; ?>">
                                                            <button type="submit" name="hapus_berkas_karyawan" class="btn btn-danger">Hapus</button>
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
                                        echo "*Tidak Ada File Terlampir";
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                                    <!-- UNTUK MENAMPILKAN GAMBAR -->
                                <div class="col-md-12 mt-3">
                                <?php
                                    $query = "SELECT * FROM dokumen_karyawan where idkaryawan = '$id_karyawan'";
                                    $result = mysqli_query($conn_hcg, $query);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo '<div class="row d-flex bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $nama_gambar2 = $row['nama_gambar'];
                                            $link_gambar2 = $row['gambar_path'];
                                            $id_berkas_karyawan = $row['id_berkas_karyawan'];


                                            if ($nama_gambar2 == NULL) {
                                               
                                            } else {
                                                echo '<div class="col-md-3 d-flex align-items-center text-center mt-3 mb-3">';
                                                    echo '<a href="' . $row['gambar_path'] . '" target="_blank">';
                                                    echo '<img src="' . $row['gambar_path'] . '" alt="Gambar" class="gambarterkait"></a>';
                                                    ?>
                                                    <button type="button" class="btn btn-danger mb-2 mx-2 mt-4 justify-content-center align-items-center d-flex" data-toggle="modal" data-target="#deleteGambarModal<?= $id_berkas_karyawan; ?>" style="width: 20px;">
                                                    <div class="fas fa-trash" style="width: 15px;"></div>
                                                    </button>
                                                    <?php
                                                  
                                        
                                                echo '</div>';
                                            }
                                        
                                            ?>

                                            <!-- MODAL HAPUS GAMBAR -->
                                            <div class="modal fade" id="deleteGambarModal<?= $id_berkas_karyawan; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteGambarModalLabel<?= $id_berkas_karyawan; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteGambarModalLabel<?= $id_berkas_karyawan; ?>">Konfirmasi Hapus Gambar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <strong><?= $nama_gambar2?> ?</strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <input type="hidden" name="id_berkas_karyawan" value="<?= $id_berkas_karyawan; ?>">
                                                            <button type="submit" name="hapus_gambar_karyawan" class="btn btn-danger">Hapus</button>
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


</body>

<!-- MODAL UNTUK INPUT DATA  -->
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Dokumen Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body" style="font-size: 15px;">
                    <input type="hidden" name="idkaryawan" value="<?= $id_karyawan; ?>">
                    Pilih Dokumen PDF:
                    <input type="file" name="pdf_file2[]" id="pdf_file2" multiple accept=".pdf" class="form-control"><br>
                    Pilih Gambar:
                    <input type="file" name="image_file2[]" id="image_file2" multiple accept="image/*" class="form-control"><br>
                    <button type="submit" class="btn btn-custom" name="submit_dokumen_karyawan">Submit</button>
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
// Menambah data 
if (isset($_POST['submit_dokumen_karyawan'])) {
    $pdfUploadDir2 = "../lihat_detail/dokumen_karyawan/";
    $pdfFiles2 = $_FILES['pdf_file2'];
    $id_karyawan = $_POST['idkaryawan'];

    foreach ($pdfFiles2['tmp_name'] as $key2 => $tmp_name) {
        $pdfFileName2 = $pdfFiles2['name'][$key2];
        $pdfFilePath2 = $pdfUploadDir2 . $pdfFileName2;
        move_uploaded_file($pdfFiles2['tmp_name'][$key2], $pdfFilePath2);

        if ($pdfFileName2 != NULL) {
            $sqlPDF = "INSERT INTO dokumen_karyawan (nama_berkas, pdf_path, idkaryawan) VALUES (?, ?, ?)";
            $stmtPDF = mysqli_prepare($conn_hcg, $sqlPDF);
            mysqli_stmt_bind_param($stmtPDF, 'sss', $pdfFileName2, $pdfFilePath2, $id_karyawan);
            mysqli_stmt_execute($stmtPDF);
            mysqli_stmt_close($stmtPDF);
        }
    }

    $imageUploadDir2 = "../lihat_detail/gambar_karyawan/";
    $imageFiles2 = $_FILES['image_file2'];

    foreach ($imageFiles2['tmp_name'] as $key2 => $tmp_name) {
        $imageFileName2 = $imageFiles2['name'][$key2];
        $imageFilePath2 = $imageUploadDir2 . $imageFileName2;
        move_uploaded_file($imageFiles2['tmp_name'][$key2], $imageFilePath2);

        if ($imageFileName2 != NULL) {
            $sqlImage = "INSERT INTO dokumen_karyawan (nama_gambar, gambar_path, idkaryawan) VALUES (?, ?, ?)";
            $stmtImage = mysqli_prepare($conn_hcg, $sqlImage);
            mysqli_stmt_bind_param($stmtImage, 'sss', $imageFileName2, $imageFilePath2, $id_karyawan);
            mysqli_stmt_execute($stmtImage);
            mysqli_stmt_close($stmtImage);
        }
    }

    // Redirect after processing uploads
    echo '<script type="text/javascript">      
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Data Telah Ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function () { 
                    window.location.href = "lihatdetail_karyawan.php?idkaryawan=' . $id_karyawan . '"; 
                }, 1500);
                </script>';
};


//Hapus Gambar
if (isset($_POST['hapus_gambar_karyawan'])) {
    // Sanitize and validate the input
    $id_berkas_karyawan = filter_input(INPUT_POST, 'id_berkas_karyawan', FILTER_SANITIZE_NUMBER_INT);

    if ($id_berkas_karyawan) {
        // Use prepared statement for database operations
        $querySelect = "SELECT nama_gambar, idkaryawan FROM dokumen_karyawan WHERE id_berkas_karyawan = ?";
        $stmtSelect = mysqli_prepare($conn_hcg, $querySelect);
        mysqli_stmt_bind_param($stmtSelect, 'i', $id_berkas_karyawan);
        mysqli_stmt_execute($stmtSelect);
        $result = mysqli_stmt_get_result($stmtSelect);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $nama_gambar = $row['nama_gambar'];
            $id_karyawan = $row['idkaryawan'];

            // Delete the image file
            $lokgambar = "../lihat_detail/gambar_karyawan/" . $nama_gambar;
            if (file_exists($lokgambar)) {
                unlink($lokgambar);
            }

            // Delete the record from the database
            $queryDelete = "DELETE FROM dokumen_karyawan WHERE id_berkas_karyawan = ?";
            $stmtDelete = mysqli_prepare($conn_hcg, $queryDelete);
            mysqli_stmt_bind_param($stmtDelete, 'i', $id_berkas_karyawan);
            $deleted = mysqli_stmt_execute($stmtDelete);
            mysqli_stmt_close($stmtDelete);

            if ($deleted) {
                echo '<script type="text/javascript">      
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Data Berhasil Dihapus",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () { 
                        window.location.href = "lihatdetail_karyawan.php?idkaryawan=' . $id_karyawan . '"; 
                    }, 1500);
                    </script>';
            } else {
                echo 'Gagal';
                header('Location: lihatdetail_karyawan.php?idkaryawan=' . $id_karyawan);
            }
        } else {
            // Handle invalid or non-existing ID
            echo 'Invalid ID or Record Not Found';
        }

        mysqli_stmt_close($stmtSelect);
    } else {
        // Handle invalid input
        echo 'Invalid Input';
    }
}

//Hapus File
if (isset($_POST['hapus_berkas_karyawan'])) {
    // Sanitize and validate the input
    $id_berkas_karyawan = filter_input(INPUT_POST, 'id_berkas_karyawan', FILTER_SANITIZE_NUMBER_INT);

    if ($id_berkas_karyawan) {
        // Use prepared statement for database operations
        $querySelect = "SELECT nama_berkas, idkaryawan FROM dokumen_karyawan WHERE id_berkas_karyawan = ?";
        $stmtSelect = mysqli_prepare($conn_hcg, $querySelect);
        mysqli_stmt_bind_param($stmtSelect, 'i', $id_berkas_karyawan);
        mysqli_stmt_execute($stmtSelect);
        $result = mysqli_stmt_get_result($stmtSelect);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $nama_berkas = $row['nama_berkas'];
            $id_karyawan = $row['idkaryawan'];

            // Delete the file
            $lokfile = "../lihat_detail/dokumen_karyawan/" . $nama_berkas;
            if (file_exists($lokfile)) {
                unlink($lokfile);
            }

            // Delete the record from the database
            $queryDelete = "DELETE FROM dokumen_karyawan WHERE id_berkas_karyawan = ?";
            $stmtDelete = mysqli_prepare($conn_hcg, $queryDelete);
            mysqli_stmt_bind_param($stmtDelete, 'i', $id_berkas_karyawan);
            $deleted = mysqli_stmt_execute($stmtDelete);
            mysqli_stmt_close($stmtDelete);

            if ($deleted) {
                echo '<script type="text/javascript">      
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Data Berhasil Dihapus",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () { 
                        window.location.href = "lihatdetail_karyawan.php?idkaryawan=' . $id_karyawan . '"; 
                    }, 1500);
                    </script>';
            } else {
                echo 'Gagal';
                header('Location: lihatdetail_karyawan.php?idkaryawan=' . $id_karyawan);
            }
        } else {
            // Handle invalid or non-existing ID
            echo 'Invalid ID or Record Not Found';
        }

        mysqli_stmt_close($stmtSelect);
    } else {
        // Handle invalid input
        echo 'Invalid Input';
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