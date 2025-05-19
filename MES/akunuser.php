<?php

require 'koneksi.php';



if ($_SESSION['role'] !== 'admin_mes') {

    header("Location: login.php");

    exit;

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

    <title>Kelola Akun User</title>

    <link href="css/styles.css" rel="stylesheet" />

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

    .modal-lg {

        max-width: 800px !important; 

    }

    </style>

</head>



<body class="sb-nav-fixed">

    <div id="prelouder"></div>



    <?php include 'nav/navmhg.php'; ?>



    <div id="layoutSidenav">

    <?php include 'nav/sidenavmhg.php'; ?>

        

        <div id="layoutSidenav_content">

            <main>

                <div class="container-fluid">

                    <div class=" mb-4">

                        <div class="">

                            <h1 class="mt-3 text-center mb-4" style="color:#4045AA;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">KELOLA AKUN USER</h1>

                            

                            <!-- <button type="button" class="btn btn-custom mx-1 shadow mb-3" data-toggle="modal" data-target="#myModal2" style="float: right;">

                                Tambah User Baru +

                            </button> -->

                            <!-- <button type="button" class="btn btn-info mx-1 shadow mb-3" data-toggle="modal" data-target="#myModalganti" style="float: right; color: white;">

                                Ganti Password User

                            </button> -->

                        </div>

                        <div class="">

                            <div class="table-responsive shadow-lg px-3 py-5">

                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px;">

                                    <thead style="background-color: #4045AA; color:white;">

                                        <tr>

                                            <th>Aksi</th>

                                            <th>Id User</th>

                                            <th>Role</th>

                                            <th>Username</th>

                                            <th>Password</th>

                                            <th>Last Time Login</th>

                                            <th>Last Time Password Change</th>

                                            <th>Email Yang Mengganti Password</th>

                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php

                                        $ambilsemuadata = mysqli_query($conn_mes, "select * from login");

                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {

                                            $iduser = $data['iduser'];

                                            $username = $data['username'];

                                            $password = $data['password'];

                                            $role = $data['role'];

                                            $lasttime_password_change = $data['lasttime_password_change'];

                                            $last_login = $data['last_login'];

                                            $email = $data['email'];



                                        ?>



                                            <tr>

                                                <td>

                                                <div class="btn-group">

                                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" style="background-color:#4045AA; height:30px; font-size:12px; color:white;">

                                                        <span class="sr-only">Toggle Dropdown</span>

                                                    </button>

                                                        <div class="dropdown-menu">

                                                        <button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#gantipw<?= $iduser; ?>" style="margin-left: 5px; width: 140px;">

                                                            Ganti Password

                                                        </button>

                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#edituser<?= $iduser; ?>" style="margin-left: 5px; width: 140px; color: white;">

                                                            Edit

                                                        </button>

                                                        <input type="hidden" name="idbarangygingindihapus" value="<?= $iduser; ?>">

                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#delete<?= $iduser; ?>" style="margin-left: 5px; width: 140px;">

                                                        Hapus

                                                        </button>

                                                        </div>

                                                </div>

                                                </td>

                                                <td><?= htmlspecialchars($iduser) ?></td>

                                                <td><?= htmlspecialchars($role) ?></td>

                                                <td><?= htmlspecialchars($username) ?></td>

                                                <td><?= htmlspecialchars($password) ?></td>

                                                <td><?= htmlspecialchars($last_login) ?></td>

                                                <td><?= htmlspecialchars($lasttime_password_change) ?></td>

                                                <td><?= htmlspecialchars($email) ?></td>

                

                                            </tr>



                                            <!-- GANTI PW MODAL -->

                                            <div class="modal fade" id="gantipw<?= $iduser; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Ganti Password User</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                <div class="form-group">

                                                                    Email : <br>

                                                                    <input type="email" name="email" id="email" class="form-control" required>

                                                                </div>

                                                                <div class="form-group">

                                                                    Password Baru : <br>

                                                                    <input type="password" name="new_password" id="pwbaru_lupa" class="form-control" required>

                                                                </div>



                                                                <div class="form-group">

                                                                    Konfirmasi Password Baru : <br>

                                                                    <input type="password" name="confirm_new_password" id="konfrmasipwbaru_lupa" class="form-control" required>

                                                                </div>

                                                                <input type="hidden" name="iduser" value="<?= $iduser; ?>">

                                                                <button type="submit" class="btn btn-custom" name="addnewpassword" id="btn">Submit</button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>









                                            <!--Edit Modal -->

                                            <div class="modal fade" id="edituser<?= $iduser; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Edit Data User</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                Role User : 

                                                                <select name="role" id="role" class="form-control" required>

                                                                    <?php

                                                                    $roles = [

                                                                            "admin_htg",

                                                                            "visitor_htg",

                                                                            "logistik_htg",

                                                                            "legal_htg",

                                                                            "supply_htg",

                                                                            "keuangan_htg",

                                                                            "management_htg",

                                                                            "ketua_operasional_htg",

                                                                            "owner_htg"

                                                                          ];



                                                                    foreach ($roles as $statusOption) {

                                                                        $selected = ($statusOption == $role) ? 'selected' : ''; 

                                                                        echo '<option value="' . $statusOption . '" ' . $selected . '>' . ucfirst($statusOption) . '</option>';

                                                                    }

                                                                    ?>

                                                                </select><br>

                                                                Username User : <br>

                                                                <input type="text" name="username" value="<?= $username; ?>" class="form-control" required><br>

                                                                <input type="hidden" name="iduser" value="<?= $iduser; ?>">

                                                                <button type="submit" class="btn btn-custom" name="updateuser">Edit Data</button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>



                                            <!--Delete Modal -->

                                            <div class="modal fade" id="delete<?= $iduser; ?>">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">



                                                        <!-- Modal Header -->

                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Hapus User?</h4>

                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                        </div>



                                                        <!-- Modal body -->

                                                        <form method="post">

                                                            <div class="modal-body">

                                                                Apakah Anda yakin ingin menghapus User <strong><?= $username; ?>?</strong>

                                                                <input type="hidden" name="iduser" value="<?= $iduser; ?>">

                                                                <br><br>

                                                                <button type="submit" class="btn btn-danger" name="hapususer">Hapus</button>

                                                            </div>

                                                        </form>



                                                    </div>

                                                </div>

                                            </div>

                                        <?php

                                        };



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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="js/scripts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <script src="assets/demo/chart-area-demo.js"></script>

    <script src="assets/demo/chart-bar-demo.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

    <script src="assets/demo/datatables-demo.js"></script>

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



<!-- The Modal -->

<!-- <div class="modal fade" id="myModal2">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



            <div class="modal-header">

                <h4 class="modal-title">Tambah User</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <form method="post">

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">

                            Role User : 

                            <select name="role" id="role" class="form-control" required>

                                <option value="">--Pilih--</option>

                                <option value="admin">Admin</option>

                                <option value="visitor">Visitor</option>

                                <option value="logistik">Logistik</option>

                                <option value="legal">Legal</option>

                                <option value="supply">Supply</option>

                                <option value="keuangan">Keuangan</option>

                                <option value="management">Management</option>

                                <option value="ketua_operasional">Ketua Operasional</option>

                                <option value="owner">Owner</option>

                            </select><br>

                            Username :

                            <input type="text" name="username" class="form-control" required><br>

                            Password :

                            <input type="password" name="password" class="form-control" required><br>

                            Confirm Password :

                            <input type="password" name="confirm_password" class="form-control" required><br>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-custom form-control" name="addnewuser">Submit</button>

                </div>

            </form>



        </div>

    </div>

</div> -->



</html>

<!-- <div class="komentar">

    <?php

    // // Menambah data karyawan dengan prepared statement

    // if (isset($_POST['addnewuser'])) {

    //     $role2 = $_POST['role'];

    //     $username = $_POST['username'];

    //     $password = $_POST['password'];

    //     $confirm_password = $_POST['confirm_password'];



    //     if ($password === $confirm_password) {

    //         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



    //         $query = "INSERT INTO login (`role`, `username`, `password`) VALUES (?, ?, ?)";

    //         $stmt = $conn_mes->prepare($query);

    //         $stmt->bind_param("sss", $role2, $username, $hashedPassword);



    //         if ($stmt->execute()) {

    //             // Operasi berhasil

    //             echo '<script type="text/javascript">      

    //                         Swal.fire({

    //                             position: "center",

    //                             icon: "success",

    //                             title: "Data Telah Ditambahkan",

    //                             showConfirmButton: false,

    //                             timer: 1500

    //                         });

    //                         setTimeout(function () { 

    //                         window.location.href = "akunuser.php"; 

    //                         }, 1500);

    //                         </script>';

    //         } else {

    //             // Operasi gagal

    //             echo 'Gagal';

    //             header('location:akunuser.php');

    //         }

    //         $stmt->close();

    //     }

    // }

    ?>

</div> -->







<?php

if (isset($_POST['updateuser'])) {

    $iduser = $_POST['iduser'];

    $role = $_POST['role'];

    $newUsername = $_POST['username'];



    $stmtCheckUsername = $conn_mes->prepare("SELECT COUNT(*) FROM login WHERE username = ?");

    $stmtCheckUsername->bind_param("s", $newUsername);

    $stmtCheckUsername->execute();

    $stmtCheckUsername->bind_result($usernameExists);

    $stmtCheckUsername->fetch();

    $stmtCheckUsername->close();



    if ($usernameExists > 0) {

        echo '<script type="text/javascript">      

                Swal.fire({

                    position: "center",

                    icon: "error",

                    title: "Username Sudah Digunakan, Pilih Username Lain",

                    showConfirmButton: false,

                    timer: 1500

                });

                setTimeout(function () { 

                window.location.href = "akunuser.php"; 

                }, 1500);

                </script>';

    } else {

        $stmtUpdateUser = $conn_mes->prepare("UPDATE login SET role = ?, username = ? WHERE iduser = ?");

        $stmtUpdateUser->bind_param("ssi", $role, $newUsername, $iduser);

        $stmtUpdateUser->execute();

        

        echo '<script type="text/javascript">      

        Swal.fire({

            position: "center",

            icon: "success",

            title: "Data Berhasil Di Update",

            showConfirmButton: false,

            timer: 1500

        });

        setTimeout(function () { 

            window.location.href = "akunuser.php"; 

        }, 1500);

        </script>';

    }

}



//Hapus 

if (isset($_POST['hapususer'])) {

    $iduser = $_POST['iduser'];



    $query = "DELETE FROM login WHERE iduser=?";

    $stmt = $conn_mes->prepare($query);

    $stmt->bind_param("i", $iduser);



    if ($stmt->execute()) {

        // Operasi berhasil

        echo '<script type="text/javascript">      

                    Swal.fire({

                        position: "center",

                        icon: "success",

                        title: "Data Berhasil Dihapus",

                        showConfirmButton: false,

                        timer: 1500

                    });

                    setTimeout(function () { 

                    window.location.href = "akunuser.php"; 

                    }, 1500);

                    </script>';

    } else {

        // Operasi gagal

        echo 'Gagal';

        header('location:akunuser.php');

    }

    $stmt->close();

}







//ganti pw

if (isset($_POST['addnewpassword'])) {

    $newPassword = $_POST['new_password'];

    $confirmNewPassword = $_POST['confirm_new_password'];

    $email = $_POST['email'];

    $idakun = $_POST['iduser'];



    if ($newPassword === $confirmNewPassword) {

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        

        $update_password_query = mysqli_prepare($conn_mes, "UPDATE login SET password = ?, email = ? WHERE iduser = ?");

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

                window.location.href = "akunuser.php"; 

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

                window.location.href = "akunuser.php"; 

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

                window.location.href = "akunuser.php"; 

                }, 1500);

                </script>';

    }

}

?>