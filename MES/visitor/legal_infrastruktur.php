<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'visitor_mes' && $_SESSION['role'] !== 'keuangan_mes' && $_SESSION['role'] !== 'management_mes' && $_SESSION['role'] !== 'owner_mes' && $_SESSION['role'] !== 'ketua_operasional_mes') {
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
    <title>Legal Infrastruktur</title>
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
    .bgdanger {
    background-color: rgba(255, 0, 0, 0.3); 
    }
    .bgwarning {
    background-color: rgba(255, 255, 0, 0.3); 
    }
    .bgputih {
    background-color: #fff; 
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
                            <h1 class="mt-3 text-center mb-4" style="color:#4045AA;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">LEGAL INFRASTRUKTUR</h1>
                            <a href="exportvisitor/exportlegalinfrastruktur.php" class="btn btn-info mb-2 shadow" style="float: right;"><i class="fas fa-book"></i> Cetak Data Legal Infrastruktur</a>
                        </div>
                        <div class="">
                            <div class="table-responsive shadow-lg px-3 py-5" style="border-radius: 10px;">
                            <?php
                                date_default_timezone_set('Asia/Jakarta');
                                $query = mysqli_query($conn_mes, "SELECT * FROM legal_infrastruktur");
                                while ($fetch = mysqli_fetch_array($query)) {
                                    $tanggalMasaHabis = date('Y-m-d', strtotime($fetch['masa_berlaku']));

                                    if ($fetch['masa_berlaku'] !== 'Tidak Ada') {
                                        $jenis_sertifikat = $fetch['jenis_sertifikasi'];
                                    
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
                                                echo 'Perhatian! Waktu Sertifikat <strong>' . $jenis_sertifikat . '</strong> telah habis';
                                            } elseif ($daysDifference <= 3 * 30) {
                                                echo 'Perhatian! Masa Habis Sertifikat <strong>' . $jenis_sertifikat . '</strong> akan segera habis';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                ?>
                                <?php
                                }
                                ?>
                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">
                                    <thead style="background-color: #4045AA; color:white;">
                                    <tr>
                                        <th>Aksi</th>
                                        <th>Foto/Scan Sertifikat</th>
                                        <th>Jenis Sertifikasi</th>
                                        <th>No. Sertifikat</th>
                                        <th>Instansi Yang Mengeluarkan</th>
                                        <th>Tanggal Dikeluarkan</th>
                                        <th>Masa Berlaku</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        date_default_timezone_set('Asia/Jakarta');
                                        // Query untuk mengambil data dari tabel "legal"
                                        $query = "SELECT * FROM legal_infrastruktur";
                                        $result = mysqli_query($conn_mes, $query);

                                        if (!$result) {
                                            die('Query Error: ' . mysqli_error($conn_mes));
                                        }
                                        // Loop untuk menampilkan data dari hasil query
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            
                                        $idl_infrastruktur = $row['id_legalinfrastruktur'];
                                        $jenis_sertifikasi = $row['jenis_sertifikasi'];
                                        $tanggalMasaHabis = $row['masa_berlaku'];
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
                                            $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
                                        }


                                        ?>
                                
                                            <tr class="<?php echo ($tanggalMasaHabis == 'Tidak Ada') ? 'bgputih' : (($tanggalMasaHabis <= $tanggalSaatIni) ? 'bgdanger' : ($daysDifference <= 3 * 30 ? 'bgwarning' : '')); ?>">
                                                <td>
                                                <div class="btn-group">
                                                    <a href="lihat_detail_visitor/lihatdetail_legalinfrastruktur.php?id_legal_infrastruktur=<?= $idl_infrastruktur; ?>" style="text-decoration: none;">
                                                        <button type="button" class="btn btn-custom btn-block mb-2" data-toggle="modal" style="width: 40px; height: 30px; position: relative;">
                                                            <i class="fas fa-eye" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                </td>
                                                <td><a href="lihat_detail_visitor/lihatdetail_legalinfrastruktur.php?id_legal_infrastruktur=<?= $idl_infrastruktur; ?>"><?= $gambar; ?></a></td>
                                                <td><a href="lihat_detail_visitor/lihatdetail_legalinfrastruktur.php?id_legal_infrastruktur=<?= $idl_infrastruktur; ?>"><?= htmlspecialchars($row['jenis_sertifikasi']) ?></td>
                                                <td><?= htmlspecialchars($row['no_sertifikat']) ?></td>
                                                <td><?= htmlspecialchars($row['mengeluarkan']) ?></td>
                                                <td><?= htmlspecialchars(TanggalIndo($row['tanggal_dikeluarkan'])) ?></td>
                                                <?php
                                                if ($tanggalMasaHabis !== 'Tidak Ada') {
                                                ?>
                                                    <td><?= htmlspecialchars(TanggalIndo($row['masa_berlaku']))  ?></td>
                                                <?php
                                                } else {
                                                ?>
                                                     <td><?= htmlspecialchars($row['masa_berlaku'])  ?></td>
                                                <?php
                                                }
                                                ?>
                                                <td><?= htmlspecialchars($row['keterangan']) ?></td>

                                            </tr>
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