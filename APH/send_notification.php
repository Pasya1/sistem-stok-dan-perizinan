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
    <title>Email Notification</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>
<div class="col-md-12 ">
    <button type="button" class="btn btn-warning btn-block mb-2 " data-toggle="modal" data-target="#tambahEmailModal" style="margin-left: 5px; width: 300px; float:right;">Dapatkan Notifikasi?? </button>
</div>
<div class="d-flex align-items-center justify-content-between small">
    <div class="modal fade" id="tambahEmailModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Email Anda</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post">
                    <div class="modal-body" style="font-size: 15px;">
                        Tambah Email Untuk Dapatkan Notifikasi Legal Complience :
                        <input type="email" name="email" id="email" placeholder="Alamat Email" class="form-control" required><br>
                        <button type="submit" name="sendEmailButton" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Tangani permintaan pengiriman email jika tombol diklik
if(isset($_POST['sendEmailButton'])){
    $email = $_POST['email'];

    // Simpan email ke database jika diperlukan
    $query = "INSERT INTO email_notifikasi (email) VALUES (?)";
    $stmt = mysqli_prepare($conn_aph, $query);

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
                window.location.href = "send_notification.php"; 
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
                window.location.href = "send_notification.php"; 
            }, 1500);
            </script>';
    }
};
?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>


<?php

// Ambil email dari database untuk pengiriman notifikasi
$query = "SELECT * FROM email_notifikasi";
$result = mysqli_query($conn_aph, $query);


if ($result->num_rows > 0) {
    $emailPenerima = array();
    
    // Memasukkan alamat email ke dalam array
    while ($row = $result->fetch_assoc()) {
        $emailPenerima[] = $row['email'];
    }

    $mail = new PHPMailer(true);
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'mitraharungasindo0@gmail.com';                     // SMTP username
    $mail->Password   = 'svxe phwi fvbg lhzz';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to conn_htgect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    // Kirim email ke setiap alamat dalam array
    foreach ($emailPenerima as $email) {
        $mail->clearAddresses();
        $mail->addAddress($email);
        //Recipients
        $mail->setFrom('mitraharungasindo0@gmail.com', 'PT Amanah Putera Harun');
        
        $sekarang = date("Y-m-d H:i:s");
        $tigaBulanKedepan = date("Y-m-d H:i:s", strtotime("+3 months")); 

        // Query untuk mengambil data "masa_habis" dari database
        $querymasahabis = "SELECT masa_habis, jenis_sertifikasi FROM  legal WHERE masa_habis BETWEEN '$sekarang' AND '$tigaBulanKedepan'";
        $result = $conn_aph->query($querymasahabis);
        while ($row = $result->fetch_assoc()) {
            $masaHabis = $row['masa_habis'];
            $namaLegal = $row['jenis_sertifikasi'];

            // Mengatur Subject Email dengan nama_legal yang sesuai
            $mail->Subject = 'Ayo Lakukan Segera Perpanjangan Legal - ' . $namaLegal . ' Kamu, Sob!';
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
            <title>Reminder Perpanjangan Legal</title>
            <style>
                body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                }
                .header {
                background-color: #f2f2f2;
                padding: 10px;
                text-align: center;
                margin-top: 10px;
                }
                .content {
                padding: 20px;
                margin: 20px auto;
                max-width: 600px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #ffffff;
                text-align : justify;
                }
                .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                color: #ffffff;
                text-decoration: none;
                border-radius: 5px;
                }
            </style>
            </head>
            <body>
            <div class="header">
                <h1>Peringatan Penting <i class="fas fa-clock"></i></h1>
            </div>
            <div class="content">
                <p>Halo PT. AMANAH PUTERA HARUN,</p>
                <p>Waktu berlalu begitu cepat, bukan? Kami ingin mengingatkan kamu tentang sesuatu yang penting nih! Legal - <b>' . $namaLegal . '</b> kamu akan segera berakhir atau sudah berakhir dalam waktu dekat.</p>
                <p>Pastikan untuk memperpanjang legal tersebut ya! Ini penting buat kelancaran bisnis dan nggak bikin ribet urusan hukum.</p>
                <p>CEK TERUS UNTUK MASA HABISNYA YAA DAN JANGAN LUPA MENGUPDATE DI SISTEM JIKA TELAH MELAKUKAN PERPANJANGAN. <i class="fas fa-hourglass-half"></i></p>
                <a href="https://harungroupisls.com/choose.php" target="_blank" class="button">Cek Website Kami</a>
                <p>Terima kasih sudah jadi bagian dari keluarga kami! <i class="far fa-smile"></i></p>
            </div>
            </body>
            </html>';
            $mail->AltBody = 'Halo PT. AMANAH PUTERA HARUN,<br><br>' .
            'Waktu berlalu begitu cepat, bukan? Kami ingin mengingatkan kamu tentang sesuatu yang penting nih! Legal - <b>' . $namaLegal . '</b> kamu akan segera berakhir atau sudah berakhir dalam waktu dekat.<br><br>' .
            'Pastikan untuk memperpanjang legal tersebut ya! Ini penting buat kelancaran bisnis dan nggak bikin ribet urusan hukum.<br>' .
            'Dan untuk detail waktu masa habis legalnya kamu bisa cek di website kami yaa.<br><br>' .
            'Terima kasih sudah jadi bagian dari keluarga kami! 😊';
            $mail->isHTML(true); 

            try {
                $mail->send();
                echo 'Email notifikasi ke' .$email. 'berhasil dikirim.';
            } catch (Exception $e) {
                echo 'Gagal mengirim email notifikasi: ', $mail->ErrorInfo;
            }
        }
        
    }
}
?>

</body>
</html>


