    <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu" style="overflow-y:auto; min-width: 240px;">
                    <div class="nav">
                        <img src="./assets/logohtg.png" class="mt-2 mx-auto" style="width:90px; display: block;">
                        <div class="sb-sidenav-menu-heading" style="margin-bottom: -10px;">Dashboard</div>
                        <a class="nav-link" href="./dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                            <div class="ms-5" style="margin-left:7px;">Dashboard</div>
                        </a>
                        <div class="sb-sidenav-menu-heading" style="margin-top: -15px;">Legal</div>
                        <a class="nav-link " id="legalToggle" style="opacity:1;">
                            <div class="sb-nav-link-icon"><i class="fas fa-gavel"></i></div>
                            <div class="ms-5" style="margin-left: 8px; ">Legal Compliance <i class="fas fa-caret-down"></i></div>
                        </a>
                            <ul class="submenu" id="legalSubmenu" style="display: none; background-color:#; opcaity:0.1;">
                                <a href="./legal_people.php" class="nav-link subH" ><i class="fas fa-users mx-2"></i> People</a>
                                <a href="./legal.php" class="nav-link subH" ><i class="fas fa-cogs mx-2"></i> Process</a>
                                <a href="./legal_infrastruktur.php" class="nav-link subH" ><i class="fas fa-building mx-2"></i> Infrastruktur</a>
                                <a href="./hasilaudit.php" class="nav-link subH" ><i class="fas fa-book mx-2"></i> Hasil Audit</a>
                            </ul>
                        <!-- JS -->
                        <script>
                            document.getElementById('legalToggle').addEventListener('click', function() {
                                const legalSubmenu = document.getElementById('legalSubmenu');
                                legalSubmenu.style.display = (legalSubmenu.style.display === 'block') ? 'none' : 'block';
                            });
                        </script>
                        <!-- end -->
                        <div class="sb-sidenav-menu-heading" style="margin-top: -15px;">Goods</div>
                        <a class="nav-link" href="./ordering.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            <div class="ms-5" style="margin-left:7px;">Permintaan Barang</div>
                        </a>
                        <a class="nav-link " id="barang" style="opacity:1;">
                            <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                            <div class="ms-5" style="margin-left: 8px; ">Logistik <i class="fas fa-caret-down"></i></div>
                        </a>
                            <ul class="submenu" id="legalSubmenu2" style="display: none; background-color:#; opcaity:0.1;">
                                <a href="./masuk.php" class="nav-link subH" ><i class="fas fa-parachute-box mx-2"></i> Barang Masuk</a>
                                <a href="./keluar.php" class="nav-link subH" ><i class="fas fa-truck mx-2"></i> Barang Keluar</a>
                                <a href="./barang.php" class="nav-link subH" ><i class="fas fa-cubes mx-2"></i> Stok Barang</a>
                            </ul>
                        <!-- JS -->
                        <script>
                            document.getElementById('barang').addEventListener('click', function() {
                                const legalSubmenu2 = document.getElementById('legalSubmenu2');
                                legalSubmenu2.style.display = (legalSubmenu2.style.display === 'block') ? 'none' : 'block';
                            });
                        </script>
                        <!-- end -->
                        <div class="sb-sidenav-menu-heading" style="margin-top: -15px;">People</div>
                        <a class="nav-link" href="./supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            <div class="ms-5" style="margin-left:7px;">Data Supplier</div>
                        </a>
                        <a class="nav-link" href="./karyawan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                            <div class="ms-5" style="margin-left:11px;">Data Karyawan</div>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <script>
        const currentLocation = window.location.href;
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
        if (link.href === currentLocation) {
            link.classList.add('active'); 
        }
        });
        </script>