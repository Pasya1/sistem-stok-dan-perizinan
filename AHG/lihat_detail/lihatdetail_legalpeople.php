<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin_ahg' && $_SESSION['role'] !== 'legal_ahg') {
    header("Location: ../login.php");
    exit;
}

$id_legalpeople = $_GET['id_legalpeople'];

$get = mysqli_prepare($conn_ahg, "SELECT * FROM legal_people WHERE id_legalpeople=?");
mysqli_stmt_bind_param($get, "s", $id_legalpeople);
mysqli_stmt_execute($get);
$result = mysqli_stmt_get_result($get);
$fetch = mysqli_fetch_assoc($result);

$gambar = $fetch['dokumentasi'];
$nama_pegawai = htmlspecialchars($fetch['nama_lengkap']); 
$jenis_sertifikat = htmlspecialchars($fetch['jenis_sertifikat']); 
$nomor_sertifikat = htmlspecialchars($fetch['nomor_sertifikat']); 
$instansi_mengeluarkan = htmlspecialchars($fetch['instansi_mengeluarkan']); 
$tanggal_mengeluarkan = htmlspecialchars($fetch['tanggal_mengeluarkan']); 
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
    <title>DETAIL LEGAL PEOPLE</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../sweetalert2.min.css">
    <style>
         .gambarfoto{
            width:90%;
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
            background-color: #DD5555; 
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

        /* Shape di belakang item saat aktif/dipilih */
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
                    <a href="../legal_people.php" class="btn btn-danger mb-2 shadow" style="font-size:14px; font-weight: lighter;"><i class="fas fa-arrow-left"></i> </a><br>
                    </div>    
                        <h1 class="mt-3 text-center mb-4" style="color:#DD5555; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">DATA LEGAL PEOPLE</h1>
                        <div class="card-body">
                            <div class="row mt-5">
                                <h4 style="color:#DD5555; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Detail</h4>
                            </div>
                            <div class="row mt-3" style="background-color:#DD5555; border-radius:3px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                <div class="col-md-5">
                                    <div class="gambarfoto mt-2 d-flex align-items-center justify-content-center shadow"><?=$gambar;?></div>
                                </div>
                                <div class="col-md-7 mt-5">
                                    <div class="row" style="color:#fff; font-size:12px;">
                                        <div class="col-md-6 col-12">
                                            <h5>NAMA LENGKAP :</h5>
                                            <p><?=$nama_pegawai;?></p>

                                            <h5>JENIS SERTIFIKAT :</h5>
                                            <p><?=$jenis_sertifikat;?></p>
                                                
                                            <h5>NOMOR SERTIFIKAT :</h5>
                                            <p><?=$nomor_sertifikat;?></p>
                                        </div>
                                        <div class="col-6">
                                            <h5>INSTANSI YANG MENGELUARKAN :</h5>
                                            <p><?=$instansi_mengeluarkan;?></p>

                                            <h5>KETERANGAN :</h5>
                                            <p><?=$keterangan;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row justify-content-center mt-5" style="color:#fff; ">
                                    <div class=" col-md-3 text-center py-3 mx-3 mb-3" style="background-color:#DD5555; border-radius:10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                        <h4>Tanggal Mengeluarkan</h4>
                                        <div class="dropdown-divider mb-2"></div>
                                        <div class="py-4"><?=TanggalIndo($tanggal_mengeluarkan);?></div>
                                    </div>
                                    <div class=" col-md-3 text-center py-3 mx-3 mb-3" style="background-color:#DD5555; border-radius:10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                        <h4>Masa Habis</h4>
                                        <div class="dropdown-divider mb-2"></div>
                                        <?php
                                            if ($masa_habis !== 'Tidak Ada') {
                                        ?>
                                            <div class="py-4"><?=TanggalIndo($masa_habis);?></div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="py-4"><?= $masa_habis;?></div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                            </div>
                            <div class="row" id="serti">
                                <div class="col-md-12 my-4">
                                    <h4 style="color:#DD5555;">FILE SERTIFIKAT :</h4>
                                </div>  
                                <div class="col-md-12">
                                    <?php
                                    $ambildarilegal = "SELECT * FROM legal_people where id_legalpeople = '$id_legalpeople'";
                                    $result = mysqli_query($conn_ahg, $ambildarilegal);
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                        $nama_file = $row['nama_file'];
                                        $pdf_path = $row['pdf_path'];

                                        echo '<img src="../assets/pdficon.png" style="width:10%;" class="mx-2">';
                                        echo '<a href="../' . $row['pdf_path'] . '">' . $row['nama_file'] . '</a></img><br>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5" >
                                <div class="col-md-6">
                                    <h4 style="color:#DD5555;">LAMPIRAN :</h4>
                                </div>    
                                <div class="col-md-6">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="background-color:#DD5555; float: right; color:white;">Tambah Dokumen/Gambar +</button>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <!-- MENAMPILKAN DOKUMEN -->
                                    <?php
                                    $query = "SELECT * FROM dokumen_legal_people where id_legalpeople = '$id_legalpeople'";
                                    $result = mysqli_query($conn_ahg, $query);
                                            
                                    // Menampilkan data
    
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<div class="row d-flex bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                                $nama_sertfikat = $row['nama_berkas'];
                                                $link_file1 = $row['pdf_path'];
                                                $id_berkas_people = $row['id_berkas_people'];
                        
                                                if($nama_sertfikat==NULL){
                                                    
                                                }else{
                                                    echo '<div class="col-md-3 d-flex align-items-center mt-3 mb-3">';
                                                        echo '<img src="../assets/pdficon.png" style="width:20%;" class="mx-2">';
                                                        echo '<a href="' . $row['pdf_path'] . '">' . $row['nama_berkas'] . '</a></img><br>';
                                                        ?>
                                                        <button type="button" class="btn btn-danger mb-2 mx-2 mt-4 justify-content-center align-items-center d-flex" data-toggle="modal" data-target="#deleteFilepeopleModal<?= $id_berkas_people; ?>" style="width: 20px;">
                                                        <div class="fas fa-trash" style="width: 15px;"></div>
                                                        </button>
                                                        <?php

                                                    echo '</div>';
                                                }

                                                ?>

                                                <!-- MODAL HAPUS DOKUMEN -->
                                                <div class="modal fade" id="deleteFilepeopleModal<?= $id_berkas_people; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteFilepeopleModalLabel<?= $id_berkas_people; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteFilepeopleModalLabel<?= $id_berkas_people; ?>">Konfirmasi Hapus Berkas</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus <strong><?= $nama_sertfikat?> ?</strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post">
                                                                <input type="hidden" name="id_berkas_people" value="<?= $id_berkas_people; ?>">
                                                                <button type="submit" name="hapus_berkas_people" class="btn btn-danger">Hapus</button>
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
                                            echo "*Tidak ada File Terlampir";
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                                    <!-- UNTUK MENAMPILKAN GAMBAR -->
                                <div class="col-md-12 mt-3">
                                    <?php
                                    $query = "SELECT * FROM dokumen_legal_people where id_legalpeople = '$id_legalpeople'";
                                    $result = mysqli_query($conn_ahg, $query);
                                            
                                    // Menampilkan data
    
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<div class="row d-flex bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $nama_gambar_serti = $row['nama_gambar'];
                                            $link_gambar = $row['gambar_path'];
                                            $id_berkas_people = $row['id_berkas_people'];
                    
                                            if($nama_gambar_serti==NULL){
                                                
                                            }else{
                                                echo '<div class="col-md-3 d-flex align-items-center text-center mt-3 mb-3">';
                                                    echo '<a href="' . $row['gambar_path'] . '" target="_blank">';
                                                    echo '<img src="' . $row['gambar_path'] . '" alt="Gambar" class="gambarterkait"></a>';
                                                    ?>
                                                    <button type="button" class="btn btn-danger mb-2 mx-2 mt-4 justify-content-center align-items-center d-flex" data-toggle="modal" data-target="#deleteGambarpeopleModal<?= $id_berkas_people; ?>" style="width: 20px;">
                                                    <div class="fas fa-trash" style="width: 15px;"></div>
                                                    </button>
                                                    <?php
                                                echo '</div>';
                                            }

                                            ?>

                                            <!-- MODAL HAPUS GAMBAR -->
                                            <div class="modal fade" id="deleteGambarpeopleModal<?= $id_berkas_people; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteGambarpeopleModalLabel<?= $id_berkas_people; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteGambarpeopleModalLabel<?= $id_berkas_people; ?>">Konfirmasi Hapus Gambar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <strong><?= $nama_gambar_serti?> ?</strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <input type="hidden" name="id_berkas_people" value="<?= $id_berkas_people; ?>">
                                                            <button type="submit" name="hapus_gambar_people" class="btn btn-danger">Hapus</button>
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
                                            echo "*Tidak ada Gambar Terlampir";
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
                <h4 class="modal-title">Tambah Data Sertifikat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body" style="font-size: 15px;">
                    <input type="hidden" name="id_legalpeople" value="<?= $id_legalpeople; ?>">
                    Pilih Dokumen PDF:
                    <input type="file" name="pdf_file[]" id="pdf_file" multiple accept=".pdf" class="form-control"><br>
                    Pilih Gambar:
                    <input type="file" name="image_file[]" id="image_file" multiple accept="image/*" class="form-control"><br>
                    <button type="submit" class="btn btn-custom" name="submit_dokumen_people">Submit</button>
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
if (isset($_POST['submit_dokumen_people'])) {
    $pdfUploadDir = "../lihat_detail/dokumen_people/";
    $imageUploadDir = "../lihat_detail/gambar-gambar_people/";
    $id_legalpeople = filter_input(INPUT_POST, 'id_legalpeople', FILTER_SANITIZE_NUMBER_INT);

    // Handling PDF files
    if (!empty($_FILES['pdf_file'])) {
        $pdfFiles = $_FILES['pdf_file'];

        foreach ($pdfFiles['tmp_name'] as $key => $tmp_name) {
            $pdfFileName = $pdfFiles['name'][$key];
            $pdfFilePath = $pdfUploadDir . $pdfFileName;
            move_uploaded_file($pdfFiles['tmp_name'][$key], $pdfFilePath);

            if ($pdfFileName != NULL) {
                // Insert PDF file data into the database
                $sqlPDF = "INSERT INTO dokumen_legal_people (nama_berkas, pdf_path, id_legalpeople) VALUES ('$pdfFileName', '$pdfFilePath','$id_legalpeople')";
                mysqli_query($conn_ahg, $sqlPDF);
            }
        }
    }

    // Handling image files
    if (!empty($_FILES['image_file'])) {
        $imageFiles = $_FILES['image_file'];

        foreach ($imageFiles['tmp_name'] as $key => $tmp_name) {
            $imageFileName = $imageFiles['name'][$key];
            $imageFilePath = $imageUploadDir . $imageFileName;
            move_uploaded_file($imageFiles['tmp_name'][$key], $imageFilePath);

            if ($imageFileName != NULL) {
                // Insert image file data into the database
                $sqlImage = "INSERT INTO dokumen_legal_people (nama_gambar, gambar_path, id_legalpeople) VALUES ('$imageFileName', '$imageFilePath','$id_legalpeople')";
                mysqli_query($conn_ahg, $sqlImage);
            }
        }
    }

    echo '<script type="text/javascript">      
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Data Telah Ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function () { 
                    window.location.href = "lihatdetail_legalpeople.php?id_legalpeople=' . $id_legalpeople . '";  
                }, 1500);
                </script>';
}


//Hapus Gambar
if (isset($_POST['hapus_gambar_people'])) {
    $id_berkas_people = filter_input(INPUT_POST, 'id_berkas_people', FILTER_SANITIZE_NUMBER_INT);

    $result = mysqli_query($conn_ahg, "SELECT * FROM dokumen_legal_people WHERE id_berkas_people='$id_berkas_people'");
    $get = mysqli_fetch_array($result);
    $lokgambar = "../lihat_detail/gambar-gambar_people/" . $get['nama_gambar'];
    unlink($lokgambar);

    $hapusgambarpeople = mysqli_query($conn_ahg, "DELETE FROM dokumen_legal_people WHERE id_berkas_people='$id_berkas_people'");
    
    if ($hapusgambarpeople) {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Data Berhasil Dihapus",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "lihatdetail_legalpeople.php?id_legalpeople=' . $get['id_legalpeople'] . '";  
        }, 1500);
        </script>';
    } else {
        echo 'Gagal';
        header('Location: lihatdetail_legalpeople.php?id_legalpeople=' . $get['id_legalpeople']);
    }
};

//Hapus File
if (isset($_POST['hapus_berkas_people'])) {
    $id_berkas_people = filter_input(INPUT_POST, 'id_berkas_people', FILTER_SANITIZE_NUMBER_INT);

    $file = mysqli_query($conn_ahg, "SELECT * FROM dokumen_legal_people WHERE id_berkas_people='$id_berkas_people'");
    $get = mysqli_fetch_array($file);
    $lokfile = "../lihat_detail/dokumen_people/" . $get['nama_berkas'];
    unlink($lokfile);

    $hapusdokpeople = mysqli_query($conn_ahg, "DELETE FROM dokumen_legal_people WHERE id_berkas_people='$id_berkas_people'");
    if ($hapusdokpeople) {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Data Berhasil Dihapus",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "lihatdetail_legalpeople.php?id_legalpeople=' . $get['id_legalpeople'] . '";   
        }, 1500);
        </script>';
    } else {
        echo 'Gagal';
        header('Location: lihatdetail_legalpeople.php?id_legalpeople=' . $get['id_legalpeople']);
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