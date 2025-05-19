<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin_htg' && $_SESSION['role'] !== 'legal_htg') {
    header("Location: ../login.php");
    exit;
}
?>
<html>
<head>
  <title>Export Data Legal Operasional</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

  <style>
    .gambarfoto{
            width:100px;
            
        }
  </style>
</head>

<body>
<div class="container">
			<h2 class="text-center py-4">Data Legal Operasional</h2>
            <a href="../legal.php" class="btn btn-danger float-right mb-3"><i class="fas fa-arrow-left"></i></a>
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="legalop" width="100%" cellspacing="0" style="margin-left: -10px;">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>JENIS SERTIFIKASI</th>
                                                <th>NO. SERTIFIKAT</th>
                                                <th>MENGELUARKAN</th>
                                                <th>MULAI BERLAKU</th>
                                                <th>AKHIR BERLAKU</th>
                                                <th>MASA BERLAKU</th>
                                                <th>MASA HABIS</th>
                                                <th>KETERANGAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $i=1;
                                        // Query untuk mengambil data dari tabel "legal"
                                        $query = "SELECT * FROM legal";
                                        $result = mysqli_query($conn_htg, $query);

                                        if (!$result) {
                                            die('Query Error: ' . mysqli_error($conn_htg));
                                        }
                                        // Loop untuk menampilkan data dari hasil query
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
                                            $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
                                        }


                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$i++?></td>
                                                <td><?= htmlspecialchars($row['jenis_sertifikasi']) ?></td>
                                                <td><?= htmlspecialchars($row['no_sertifikat']) ?></td>
                                                <td><?= htmlspecialchars($row['mengeluarkan']) ?></td>
                                                <td><?= TanggalIndo($mulai_berlaku);?></td> 
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
                                        <?php
                                        };
                                        ?>

                                        </tbody>
                                    </table>
					
				</div>
                
</div>
	
<script>
$(document).ready(function() {
    $('#legalop').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: 'Export to PDF',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(doc) {
                    doc.defaultStyle.fontSize = 8; // Atur ukuran font default
                    doc.styles.tableHeader.fontSize = 8; // Atur ukuran font untuk header tabel
                    doc.styles.tableBodyEven.fontSize = 8; // Atur ukuran font untuk body tabel
                }
            },
            'copy', 'csv', 'excel', 'print'
        ]
    });
});


</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

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

        // Tampilkan hitungan mundur pada elemen yang bersangkutan
        countdown.innerHTML = days + " hari, " + hours + " jam, " +
            minutes + " menit, " + seconds + " detik, ";

        // Tampilkan alert dan ganti warna div menjadi danger jika waktu tersisa 3 bulan
        const waktuTigaBulanSebelum = masaHabis - 7776000000; // Satu bulan = 2592000000 milidetik
        if (now >= waktuTigaBulanSebelum && now < masaHabis) {
            // Ganti warna div menjadi danger
            countdown.parentElement.classList.add('alert', 'alert-warning');

            console.log("Pengiriman email notifikasi 3 bulan sebelum habis.");
        }

        // Tampilkan alert jika waktu telah habis
        if (distance < 0) {
            clearInterval(interval);
            countdown.parentElement.classList.add('alert', 'alert-danger');
            countdown.innerHTML = "Waktu telah habis";

        }
    };

    // Panggil fungsi updateCountdown setiap detik
    const interval = setInterval(updateCountdown, 1000);

    // Untuk memastikan hitungan mundur langsung terupdate saat halaman dimuat
    updateCountdown();
});

    </script>


</body>

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