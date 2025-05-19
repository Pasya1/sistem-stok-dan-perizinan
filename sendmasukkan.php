<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['kirimmasukan'])) {
    $email_pengirim = 'mitraharungasindo0@gmail.com'; 
    $password_pengirim = 'svxe phwi fvbg lhzz'; 

    try {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;                    
        $mail->isSMTP();                                        
        $mail->Host       = 'smtp.gmail.com';  
        $mail->SMTPAuth   = true;              
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;   
        $mail->Username   = $email_pengirim;
        $mail->Password   = $password_pengirim;

        $mail->setFrom($email_pengirim);
        $mail->addAddress('harun_group@yahoo.com'); 
        $mail->isHTML(true);
        $mail->Subject = 'Saran/Masukkan dari Website';
        $mail->Body    = '<p><strong>Nama:</strong> ' . $_POST['inputNama'] . '</p>' .
                         '<p><strong>Email:</strong> ' . $_POST['inputEmail'] . '</p>' . 
                         '<p><strong>No Telepon:</strong> ' . $_POST['inputTelp'] . '</p>' .
                         '<p><strong>Perusahaan:</strong> ' . $_POST['inputCompany'] . '</p>' .
                         '<p><strong>Kebutuhan:</strong> ' . $_POST['inputNeeds'] . '</p>';

        $mail->send();
        echo '<script>
                alert("Pesan Anda berhasil dikirim. Terima kasih!");
                window.location = "contact.php";
              </script>';
    } catch (Exception $e) {
        echo '<script>
                alert("Maaf, pesan Anda gagal terkirim. Error: ' . $mail->ErrorInfo . '");
                window.location = "contact.php";
              </script>';
    }
}
?>
