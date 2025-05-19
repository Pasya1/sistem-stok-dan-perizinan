<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'visitor_ahg' && $_SESSION['role'] !== 'owner_ahg' && $_SESSION['role'] !== 'keuangan_ahg' && $_SESSION['role'] !== 'management_ahg' && $_SESSION['role'] !== 'ketua_operasional_ahg') {
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
    
    <title>Profil Akun</title>

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
        background-color: #DD5555; 
        color: #fff; 
        transition: background-color 0.3s ease;
    }
    .btn-custom:hover {
        opacity : 0.9;
        color: #fff;
    }
    
    /* Gaya untuk item yang aktif/dipilih */
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

    .input-group-append1 {
            position: absolute;
            top:  135px;  
            right: 60px;
            display: flex;
            align-items: center;
            z-index: 999;
        }
        
        #password-toggle1 {
            cursor: pointer;
            opacity: 0.7;
            background: none;
        }
        #password-icon1 {
            color: #DD5555;
        }

        .input-group-append2 {
                position: absolute;
                top:  238px;  
                right: 60px;
                display: flex;
                align-items: center;
                z-index: 999;
            }
            
            #password-toggle2 {
                cursor: pointer;
                opacity: 0.7;
                background: none;
            }
            #password-icon2 {
                color: #DD5555;
            }

            .input-group-append3 {
                position: absolute;
                top:  338px;  
                right: 60px;
                display: flex;
                align-items: center;
                z-index: 999;
            }
            
            #password-toggle3 {
                cursor: pointer;
                opacity: 0.7;
                background: none;
            }
            #password-icon3 {
                color: #DD5555;
            }

            .input-group-append4 {
                position: absolute;
                top:  147px;  
                right: 30px;
                display: flex;
                align-items: center;
                z-index: 999;
            }
            
            #password-toggle4 {
                cursor: pointer;
                opacity: 0.7;
                background: none;
            }
            #password-icon4 {
                color: #DD5555;
            }

            .input-group-append5 {
                position: absolute;
                top:  250px;  
                right: 30px;
                display: flex;
                align-items: center;
                z-index: 999;
            }
            
            #password-toggle5 {
                cursor: pointer;
                opacity: 0.7;
                background: none;
            }
            #password-icon5 {
                color: #DD5555;
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
                        <div class="" >
                        <h1 class="mt-3 text-center mb-4" style="color:#DD5555;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">PROFILE</h1>
                        </div>
                        <div class="row d-flex justify-content-around mt-5">
                            <div class="col-md-5  shadow-lg px-5 py-5">
                                        <?php
                                        $i=1;

                                        $ambiluser = mysqli_query($conn_ahg, "select * from login where role='$role'");
                                        while ($row = mysqli_fetch_assoc($ambiluser)){
                                                $username = $row['username'];
                                                $password = $row['password'];

                                        ?>
                                        <h5 style="color:#DD5555;  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Informasi Profil</h5><br>
                                        <form method="post">
                                            Username :<br>
                                            <input type="text" name="new_username" value="<?= $username ?>" class="form-control" required><br>
                                            Role : <br>
                                            <input type="text" value="<?= $role ?>" class="form-control" disabled><br>
                                            <button name="perbarui" class="btn btn-custom form-control">Perbarui</button>
                                        </form>

                                        <?php
                                        }
                                        ?>
                            </div>
                            <div class="col-md-5 shadow-lg px-5 py-5">
                                    <h5 style="color:#DD5555;  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Ganti Password</h5><br>
                                    <form method="post">
                                    <div class="form-group">
                                            Password Saat Ini :<br>
                                            <input type="password" name="password_lama" id="pwsaatini" class="form-control" required><br>
                                            <div class="input-group-append1" id="password-toggle1" style="display:none ;" >
                                                <span>
                                                    <i class="fa fa-eye-slash" id="password-icon1"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            Password Baru : <br>
                                            <input type="password" name="password_baru" id="pwbaru" class="form-control" required><br>
                                            <div class="input-group-append2" id="password-toggle2" style="display:none ;" >
                                                <span>
                                                    <i class="fa fa-eye-slash" id="password-icon2"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            Konfirmasi Password Baru : <br>
                                            <input type="password" name="konfirmasi_password_baru" id="konfirmasipw" class="form-control" required>
                                            <div class="input-group-append3" id="password-toggle3" style="display:none ;" >
                                                <span>
                                                    <i class="fa fa-eye-slash" id="password-icon3"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-link mx-1 mb-2" data-toggle="modal" data-target="#myModal" style="float: right; background: none; border: none; font-size:14px;">Lupa Password?</button>
                                        <button name="updatepassword" class="btn btn-custom form-control">Perbarui</button>
                                    </form>
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

    <script>

    // password saat ini 1
    document.addEventListener('DOMContentLoaded', function () {
    const passwordInput1 = document.getElementById('pwsaatini');
    const passwordToggle1 = document.getElementById('password-toggle1');
    const passwordIcon1 = document.getElementById('password-icon1');

    // Tampilkan ikon mata saat ada input pada password
    passwordInput1.addEventListener('input', function () {
        if (passwordInput1.value.length > 0) {
            passwordToggle1.style.display = 'block';
        } else {
            passwordToggle1.style.display = 'none';
        }
    });

    passwordToggle1.addEventListener('click', function () {
        if (passwordInput1.type === 'password') {
            passwordInput1.type = 'text';
            passwordIcon1.classList.remove('fa-eye-slash');
            passwordIcon1.classList.add('fa-eye');
        } else {
            passwordInput1.type = 'password';
            passwordIcon1.classList.remove('fa-eye');
            passwordIcon1.classList.add('fa-eye-slash');
        }
    });
    });

    // password Baru 2
    document.addEventListener('DOMContentLoaded', function () {
    const passwordInput2 = document.getElementById('pwbaru');
    const passwordToggle2 = document.getElementById('password-toggle2');
    const passwordIcon2 = document.getElementById('password-icon2');

    // Tampilkan ikon mata saat ada input pada password
    passwordInput2.addEventListener('input', function () {
        if (passwordInput2.value.length > 0) {
            passwordToggle2.style.display = 'block';
        } else {
            passwordToggle2.style.display = 'none';
        }
    });

    passwordToggle2.addEventListener('click', function () {
        if (passwordInput2.type === 'password') {
            passwordInput2.type = 'text';
            passwordIcon2.classList.remove('fa-eye-slash');
            passwordIcon2.classList.add('fa-eye');
        } else {
            passwordInput2.type = 'password';
            passwordIcon2.classList.remove('fa-eye');
            passwordIcon2.classList.add('fa-eye-slash');
        }
    });
    });

    // KONFIRMASI PW 3
    document.addEventListener('DOMContentLoaded', function () {
    const passwordInput3 = document.getElementById('konfirmasipw');
    const passwordToggle3 = document.getElementById('password-toggle3');
    const passwordIcon3 = document.getElementById('password-icon3');

    // Tampilkan ikon mata saat ada input pada password
    passwordInput3.addEventListener('input', function () {
        if (passwordInput3.value.length > 0) {
            passwordToggle3.style.display = 'block';
        } else {
            passwordToggle3.style.display = 'none';
        }
    });

    passwordToggle3.addEventListener('click', function () {
        if (passwordInput3.type === 'password') {
            passwordInput3.type = 'text';
            passwordIcon3.classList.remove('fa-eye-slash');
            passwordIcon3.classList.add('fa-eye');
        } else {
            passwordInput3.type = 'password';
            passwordIcon3.classList.remove('fa-eye');
            passwordIcon3.classList.add('fa-eye-slash');
        }
    });
    });
    </script>


<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Lupa Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        Email : <br>
                        <input type="email" name="email" id="email" class="form-control" required><br>
                    </div>
                    
                    <div class="form-group">
                        Password Baru : <br>
                        <input type="password" name="new_password" id="pwbaru_lupa" class="form-control" required><br>
                        <div class="input-group-append4" id="password-toggle4" style="display:none ;" >
                            <span>
                                <i class="fa fa-eye-slash" id="password-icon4"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        Konfirmasi Password Baru : <br>
                        <input type="password" name="confirm_new_password" id="konfrmasipwbaru_lupa" class="form-control" required><br>
                        <div class="input-group-append5" id="password-toggle5" style="display:none ;" >
                            <span>
                                <i class="fa fa-eye-slash" id="password-icon5"></i>
                            </span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-custom" name="addnewpassword" id="btn">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    // password Lupa 4
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput4 = document.getElementById('pwbaru_lupa');
        const passwordToggle4 = document.getElementById('password-toggle4');
        const passwordIcon4 = document.getElementById('password-icon4');

        // Tampilkan ikon mata saat ada input pada password
        passwordInput4.addEventListener('input', function () {
            if (passwordInput4.value.length > 0) {
                passwordToggle4.style.display = 'block';
            } else {
                passwordToggle4.style.display = 'none';
            }
        });

        passwordToggle4.addEventListener('click', function () {
            if (passwordInput4.type === 'password') {
                passwordInput4.type = 'text';
                passwordIcon4.classList.remove('fa-eye-slash');
                passwordIcon4.classList.add('fa-eye');
            } else {
                passwordInput4.type = 'password';
                passwordIcon4.classList.remove('fa-eye');
                passwordIcon4.classList.add('fa-eye-slash');
            }
        });
    });

        // KONFIRMASI PW 5
        document.addEventListener('DOMContentLoaded', function () {
        const passwordInput5 = document.getElementById('konfrmasipwbaru_lupa');
        const passwordToggle5 = document.getElementById('password-toggle5');
        const passwordIcon5 = document.getElementById('password-icon5');

        // Tampilkan ikon mata saat ada input pada password
        passwordInput5.addEventListener('input', function () {
            if (passwordInput5.value.length > 0) {
                passwordToggle5.style.display = 'block';
            } else {
                passwordToggle5.style.display = 'none';
            }
        });

        passwordToggle5.addEventListener('click', function () {
            if (passwordInput5.type === 'password') {
                passwordInput5.type = 'text';
                passwordIcon5.classList.remove('fa-eye-slash');
                passwordIcon5.classList.add('fa-eye');
            } else {
                passwordInput5.type = 'password';
                passwordIcon5.classList.remove('fa-eye');
                passwordIcon5.classList.add('fa-eye-slash');
            }
        });
    });
</script>

</body>
</html>
<?php
if (isset($_POST['updatepassword'])) {
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password_baru = $_POST['konfirmasi_password_baru'];

    $ambilpw = mysqli_prepare($conn_ahg, "SELECT * FROM login WHERE role = ?");
    mysqli_stmt_bind_param($ambilpw, "s", $role);
    mysqli_stmt_execute($ambilpw);
    $result = mysqli_stmt_get_result($ambilpw);
    $row = mysqli_fetch_assoc($result);

    $password_dari_database = $row['password'];
    $idakun = $row['iduser'];
    
    if (password_verify($password_lama, $password_dari_database)) {
        if ($password_baru === $konfirmasi_password_baru) {
            $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);
            
            $update_password_query = mysqli_prepare($conn_ahg, "UPDATE login SET password = ? WHERE iduser = ?");
            mysqli_stmt_bind_param($update_password_query, "si", $hashed_password, $idakun);
            $execute_update = mysqli_stmt_execute($update_password_query);

            if ($execute_update) {
                echo '<script type="text/javascript">      
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Password Berhasil Dirubah",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () { 
                    window.location.href = "profil.php"; 
                    }, 1500);
                    </script>';
            } else {
                echo '<script type="text/javascript">      
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Gagal Perbarui Password",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function () { 
                window.location.href = "profil.php"; 
                }, 1500);
                </script>';
            }
        } else {
            echo '<script type="text/javascript">      
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Konfirmasi Password Baru Tidak Sama",
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function () { 
            window.location.href = "profil.php"; 
            }, 1500);
            </script>';
        }
    } else {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Password Lama Salah",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "profil.php"; 
        }, 1500);
        </script>';
    }
}

//UNTUK YANG INPUT USERNAME
if (isset($_POST['perbarui'])) {
    $newUsername = $_POST['new_username'];

    $updateQuery = "UPDATE login SET username = ? WHERE role = ?";
    $stmt = mysqli_prepare($conn_ahg, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ss", $newUsername, $role);
    $executeUpdate = mysqli_stmt_execute($stmt);

    if ($executeUpdate) {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Username Berhasil Diganti",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "profil.php"; 
        }, 1500);
        </script>';
    } else {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Username Gagal Diganti",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "profil.php"; 
        }, 1500);
        </script>';
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn_ahg);
}



//lupa password
if (isset($_POST['addnewpassword'])) {
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];
    $email = $_POST['email'];

    $ambilpw = mysqli_prepare($conn_ahg, "SELECT * FROM login WHERE role = ?");
    mysqli_stmt_bind_param($ambilpw, "s", $role);
    mysqli_stmt_execute($ambilpw);
    $result = mysqli_stmt_get_result($ambilpw);
    $row = mysqli_fetch_assoc($result);

    $idakun = $row['iduser'];

    if ($newPassword === $confirmNewPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $update_password_query = mysqli_prepare($conn_ahg, "UPDATE login SET password = ?, email = ? WHERE iduser = ?");
        mysqli_stmt_bind_param($update_password_query, "ssi", $hashedPassword, $email, $idakun);
        $executeUpdate = mysqli_stmt_execute($update_password_query);

        if ($executeUpdate) {
            echo '<script type="text/javascript">      
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Password dan Email berhasil diperbarui",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function () { 
                window.location.href = "profil.php"; 
                }, 1500);
                </script>';
        } else {
            echo '<script type="text/javascript">      
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Gagal memperbarui Password dan Email",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function () { 
                window.location.href = "profil.php"; 
                }, 1500);
                </script>';
        }
    } else {
        echo '<script type="text/javascript">      
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Password Tidak Sesuai",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function () { 
                window.location.href = "profil.php"; 
                }, 1500);
                </script>';
    }
}

?>  