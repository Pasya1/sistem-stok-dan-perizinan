<?php
require 'koneksi.php';

if (@$_SESSION['role'] == 'admin_mes') {
    header('Location: index.php');
    exit;
} elseif (@$_SESSION['role'] == 'visitor_mes') {
    header('Location: visitor/index.php');
    exit;
} elseif (@$_SESSION['role'] == 'logistik_mes') {
    header('Location: index.php');
    exit;
} elseif (@$_SESSION['role'] == 'legal_mes') {
    header('Location: index.php');
    exit;
} elseif (@$_SESSION['role'] == 'supply_mes') {
    header('Location: index.php');
    exit;
} elseif (@$_SESSION['role'] == 'keuangan_mes') {
    header('Location: visitor/index.php');
    exit;
}elseif (@$_SESSION['role'] == 'owner_mes') {
    header('Location: visitor/index.php');
    exit;
}elseif (@$_SESSION['role'] == 'management_mes') {
    header('Location: visitor/index.php');
    exit;
}elseif (@$_SESSION['role'] == 'ketua_operasional_mes') {
    header('Location: visitor/index.php');
    exit;
}


if (isset($_POST['login_mes'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM login WHERE username=?";
    $stmt = mysqli_prepare($conn_mes, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $role = $user['role'];

        date_default_timezone_set('Asia/Jakarta');
        
        $currentDateTime = date('Y-m-d H:i:s');

        // Tambahkan perintah SQL untuk memperbarui last_login
        $updateLastLoginQuery = "UPDATE login SET last_login = '$currentDateTime' WHERE username = ?";
        $stmtUpdateLastLogin = mysqli_prepare($conn_mes, $updateLastLoginQuery);
        mysqli_stmt_bind_param($stmtUpdateLastLogin, 's', $username);
        mysqli_stmt_execute($stmtUpdateLastLogin);
        mysqli_stmt_close($stmtUpdateLastLogin);

        if ($role == 'admin_mes') {
            $_SESSION['role'] = 'admin_mes';
            header('Location: dashboard.php');
            exit;
        } elseif ($role == 'visitor_mes') {
            $_SESSION['role'] = 'visitor_mes';
            header('Location: visitor/dashboard.php');
            exit;
        } elseif ($role == 'logistik_mes') {
            $_SESSION['role'] = 'logistik_mes';
            header('Location: dashboard.php');
            exit;
        }elseif ($role == 'legal_mes') {
            $_SESSION['role'] = 'legal_mes';
            header('Location: dashboard.php');
            exit;
        }elseif ($role == 'supply_mes') {
            $_SESSION['role'] = 'supply_mes';
            header('Location: dashboard.php');
            exit;
        } elseif ($role == 'keuangan_mes') {
            $_SESSION['role'] = 'keuangan_mes';
            header('Location: visitor/dashboard.php');
            exit;
        } elseif ($role == 'owner_mes') {
            $_SESSION['role'] = 'owner_mes';
            header('Location: visitor/dashboard.php');
            exit;
        } elseif ($role == 'ketua_operasional_mes') {
            $_SESSION['role'] = 'ketua_operasional_mes';
            header('Location: visitor/dashboard.php');
            exit;
        } elseif ($role == 'management_mes') {
            $_SESSION['role'] = 'management_mes';
            header('Location: visitor/dashboard.php');
            exit;
        } 
    } else {
        echo '<script type="text/javascript">alert("Username atau Password Salah");</script>';
        echo '<script type="text/javascript">window.location.href = "login.php";</script>';
    }
    mysqli_stmt_close($stmt);
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
    <title>login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="sweetalert2.min.css">
    <style>
        @keyframes gradient {
          0% {
            background-position: 0% 50%;
          }
          50% {
            background-position: 100% 50%;
          }
          100% {
            background-position: 0% 50%;
          }
        }

        /* Gaya untuk bagian "history" */
        #backrgoundlogin {
          background: linear-gradient(-45deg, #363CAB, #427D9D, #FFB366);
          background-size: 400% 400%;
          animation: gradient 5s ease infinite;
          color: white;
          text-align: justify;
          padding: 20px; 
        }

        #login-error {
        text-align: center;
        }

        .password-input {
            position: relative;

        }

        input[type="username"],
        input[type="password"] {
            border-color: #363CAB;
        }

        button[name="login_mes"] {
            background-color: #363CAB;
            color: white; 
            transition: background-color 0.3s ease; 
        }

        button[name="login_mes"]:hover {
            background-color: #384B42;
            color: white;
        }

        .input-group-append {
            position: absolute;
            top: 160px;
            right: 0px;
            bottom: 0;
            display: flex;
            align-items: center;
            z-index: 999;
        }

        #password-toggle {
            cursor: pointer;
            opacity: 0.7;
            background: none;
            position: absolute; 
            top: 33%; 
            transform: translateY(-30%);
        }
        #password-icon {
            color: #363CAB;
            font-size: 15px;
        }
        #password-icon.fa-eye {
            color: #363CAB;
        }
    </style>

</head>

<body id="backrgoundlogin">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-10 col-sm-12">
                        <div class="card shadow-lg border-0 rounded-lg" style="margin-top: 100px;">
                            <div class="card-body d-flex">
                                <!-- KIRI GAMBAR -->
                                <div class="col-md-5 d-none d-md-block" style="background-image: url('assets/img/gambar3.jpeg'); background-size: 625px 420px; background-position: -170px 0; margin: -20px 0 -20px -20px;">
                                </div>
                                <!-- KANAN KONTEN LOGIN -->
                                <div class="col-md-7 ml-3">
                                    <div class="row">
                                        <div class="col-12 text-center text-md-left">
                                            <img src="assets/logomes.png" class="mt-1" style="width:100px; display: block;">
                                        </div>
                                        <div class="col-12">
                                            <h5 class="text-left font-weight-bold " style="color:#363CAB; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); text-align-justify">PT. MITRA ENERGI SELARAS</h5>
                                            <p class="mt-3" style="color: grey; font-size: 13px;">Selamat datang di sistem perizinan dan stok barang PT. Mitra Energi Selaras</p>
                                            <form method="post">
                                                <div class="form-group">
                                                    <input class="form-control py-2" name="username" id="inputUsername" type="username" placeholder="Username" style="font-size: 14px;" required>
                                                </div>
                                                <div class="form-group">
                                                    <div class="password-input input-group">
                                                        <input class="form-control py-2" name="password" id="inputPassword" type="password" placeholder="Password" style="font-size: 14px;" required>
                                                        <div class="input-group-append" id="password-toggle" style="display: none;">
                                                            <span class="input-group-text bg-transparent border-0">
                                                                <i class="fa fa-eye-slash" id="password-icon"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex justify-content-end">
                                                    <button class="btn ml-auto" name="login_mes">Login</button>
                                                </div>
                                                <div id="login-error" class="mt-2 text-danger"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('inputPassword');
        const passwordToggle = document.getElementById('password-toggle');
        const passwordIcon = document.getElementById('password-icon');

        // Tampilkan ikon mata saat ada input pada password
        passwordInput.addEventListener('input', function () {
            if (passwordInput.value.length > 0) {
                passwordToggle.style.display = 'block';
            } else {
                passwordToggle.style.display = 'none';
            }
        });

        passwordToggle.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        });
    });

    </script>
</body>

</html>
  