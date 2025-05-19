<nav class="sb-topnav navbar navbar-expand navbar-light shadow-lg" style="background-color:#3E578D;">
        <a class="navbar-brand mr-4" href="../../index.php">PT. Amanah Putera Harun</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#" style="color:#fff;" ><i class="fas fa-align-left"></i></button>
      
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white;">
                    <i class="fas fa-user-circle"></i> <i class="fas fa-caret-down" style="font-size: 12px;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../profil.php">Akun</a>
                    <a class="dropdown-item" href="../../index.php">Company Profile</a>
                    <?php
                        if($_SESSION['role'] == 'admin_aph'){
                    ?>
                    <a class="dropdown-item" href="../akunuser.php">Kelola Akun User</a>
                    <?php
                        }
                    ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>