<?php
require '../../koneksi.php';

if ($_SESSION['role'] !== 'visitor_htg' && $_SESSION['role'] !== 'keuangan_htg' && $_SESSION['role'] !== 'management_htg' && $_SESSION['role'] !== 'owner_htg' && $_SESSION['role'] !== 'ketua_operasional_htg') {
    header("Location: ../../login.php");
    exit;
}
$role = $_SESSION['role'];

$id_audit = $_GET['id_audit'];

$get = mysqli_prepare($conn_htg, "SELECT * FROM hasil_audit WHERE id_audit=?");
mysqli_stmt_bind_param($get, "s", $id_audit);
mysqli_stmt_execute($get);
$result = mysqli_stmt_get_result($get);
$fetch = mysqli_fetch_assoc($result);

$gambar = $fetch['dokumentasi'];
$jenis_audit = htmlspecialchars($fetch['jenis_audit']); 
$tanggal_audit = htmlspecialchars($fetch['tanggal_audit']); 
$badan_audit = htmlspecialchars($fetch['badan_audit']); 
$temuan_audit = htmlspecialchars($fetch['temuan_audit']); 
$hasil_audit = htmlspecialchars($fetch['hasil_audit']); 
$keterangan = htmlspecialchars($fetch['keterangan']);


if($gambar==null){
    $gambar='Tidak Ada Photo';
}else {
    $gambar = '<img src="../../images/'.$gambar.'" class="gambarfoto"> ';
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
    <title>DETAIL HASIL AUDIT</title>
    <link href="../../css/styles.css" rel="stylesheet" />
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

    <?php include 'navdetailvisitor.php'; ?>

    <div id="layoutSidenav">
        <?php include 'sidenavdetailvisitor.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="row py-2 ">    
                    <a href="../hasilaudit.php" class="btn btn-danger mb-2 shadow" style="font-size:14px; font-weight: lighter;"><i class="fas fa-arrow-left"></i> </a><br>
                    </div>    
                    <h1 class="mt-3 text-center mb-4" style="color:#1E7458; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);"><?=$jenis_audit;?></h1>
                        <div class="card-body">
                            <div class="row mt-5">
                                <h4 style="color:#1E7458; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Detail Hasil Audit</h4>
                            </div>
                            <div class="row mt-3" style="background-color:#1E7458; border-radius:3px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                <div class="col-md-5">
                                    <div class="gambarfoto mt-2 d-flex align-items-center justify-content-center shadow"><?=$gambar;?></div>
                                </div>
                                <div class="col-md-7 mt-3">
                                    <div class="row" style="color:#fff; font-size:12px; text-transform: uppercase;">
                                        <div class="col-md-6 col-12">
                                            <h5>JENIS AUDIT :</h5>
                                            <p><?=$jenis_audit;?></p>

                                            <h5>TANGGAL AUDIT :</h5>
                                            <p><?=TanggalIndo($tanggal_audit);?></p>

                                            <h5>BADAN AUDIT :</h5>
                                            <p><?=$badan_audit;?></p>
                                                
                                        </div>
                                        <div class="col-6">
                                            <h5>TEMUAN AUDIT :</h5>
                                            <p><?=$temuan_audit;?></p>
                                            
                                            <h5>HASIL AUDIT :</h5>
                                            <p><?=$hasil_audit;?></p>

                                            <h5>KETERANGAN :</h5>
                                            <p><?=$keterangan;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row" id="serti">
                                <div class="col-md-12 my-4">
                                    <h4 style="color:#1E7458;">FILE HASIL AUDIT :</h4>
                                </div>  
                                <div class="col-md-12">
                                    <?php
                                     $ambildarilegal = "SELECT * FROM hasil_audit where id_audit = '$id_audit'";
                                     $result = mysqli_query($conn_htg, $ambildarilegal);
                                     
                                     while($row = mysqli_fetch_assoc($result)){
                                         $nama_file = $row['nama_file'];
                                         $pdf_path = $row['pdf_path'];

                                        echo '<img src="../../assets/pdficon.png" style="width:10%;" class="mx-2">';
                                        echo '<a href="../../' . $row['pdf_path'] . '">' . $row['nama_file'] . '</a></img><br>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <div class="col-md-12">
                                    <h4 style="color:#1E7458;">LAMPIRAN :</h4>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <!-- MENAMPILKAN DOKUMEN -->
                                    <?php
                                    // MENAMPILKAN DOKUMEN
                                    $query = "SELECT * FROM dokumen_hasil_audit where id_audit = '$id_audit'";
                                    $result = mysqli_query($conn_htg, $query);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo '<div class="row d-flex bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $nama_file2 = $row['nama_berkas'];
                                            $link_file2 = $row['pdf_path'];
                                            $id_berkas_hasil_audit = $row['id_berkas_hasil_audit'];

                                            if ($nama_file2 == NULL) {
                                               
                                            } else {
                                                echo '<div class="col-md-3 d-flex align-items-center mt-3 mb-3">';
                                                echo '<img src="../../assets/pdficon.png" style="width:20%;" class="mx-2">';
                                                echo '<a href="../' . $row['pdf_path'] . '">' . $row['nama_berkas'] . '</a></img><br>';
                                                ?>
                                                <?php
                                                echo '</div>';
                                            }

                                            ?>

                                        <?php
                                        }
                                        echo '</div>';
                                    } else {
                                        echo '<div class="row px-2 py-3 bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        echo "*Data Dokumen Tidak Ditemukan";
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                                    <!-- UNTUK MENAMPILKAN GAMBAR -->
                                <div class="col-md-12 mt-3">
                                <?php
                                    $query = "SELECT * FROM dokumen_hasil_audit where id_audit = '$id_audit'";
                                    $result = mysqli_query($conn_htg, $query);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo '<div class="row d-flex bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $nama_gambar2 = $row['nama_gambar'];
                                            $link_gambar2 = $row['gambar_path'];
                                            $id_berkas_hasil_audit = $row['id_berkas_hasil_audit'];


                                            if ($nama_gambar2 == NULL) {
                                               
                                            } else {
                                                echo '<div class="col-md-3 d-flex align-items-center text-center mt-3 mb-3">';
                                                    echo '<a href="../' . $row['gambar_path'] . '" target="_blank">';
                                                    echo '<img src="../' . $row['gambar_path'] . '" alt="Gambar" class="gambarterkait"></a>';
                                                    ?>
                                                    <?php
                                                  
                                        
                                                echo '</div>';
                                            }
                                        
                                            ?>
                                        <?php                                            

                                        }
                                        echo '</div>';
                                    } else {
                                        echo '<div class="row px-2 py-3 bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        echo "*Data Gambar Tidak Ditemukan";
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
    <script src="../../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../../assets/demo/chart-area-demo.js"></script>
    <script src="../../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../../assets/demo/datatables-demo.js"></script>

    <script>
        var loader = document.getElementById("prelouder");

        window.addEventListener("load", function() {
            loader.style.display = "none";
        })
    </script>


</body>

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