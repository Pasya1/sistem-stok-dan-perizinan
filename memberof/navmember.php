    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="z-index: 1000;">
      <div class="container">
        <div data-aos="fade-down">
          <a class="navbar-brand" href="#"><img src="../img/harun group logo nav.svg" /></a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
            <ul class="navbar-nav ms-auto mb-lg-0">
              <li class="nav-item">
                <div data-aos="fade-down">
                  <a class="nav-link" href="../index.php">Home</a>
                </div>  
              </li>
              <li class="nav-item dropdown" style="z-index: 999;">
                <div data-aos="fade-down">
                  <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Group
                  </a>
                  <ul class="dropdown-menu" >
                    <li><a class="dropdown-item" href="aph.php">PT. Amanah Putera Harun </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="mhg.php">PT. Mitra Harun Gasindo</a></li>
                    <li><hr class="dropdown-divider"></li>  
                    <li><a class="dropdown-item" href="htg.php">PT. Harun Tabung Gasindo</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="ahg.php">PT. Amanah Harun Gasindo</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="hcg.php">PT. Harun Citra Gas</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="mes.php">PT. Mitra Energi Selaras</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <div data-aos="fade-down">
                  <a class="nav-link" href="../about.php">About us</a>
                </div>
              </li>
              <li class="nav-item">
                <div data-aos="fade-down">
                  <a class="nav-link" href="../contact.php">Contact</a>
                </div>  
              </li>
              <li class="nav-item ps-5">
                <div data-aos="fade-down">
                  <a class="nav-link login" href="../choose.php" style="border-radius: 7px; background-color: #29AE00; color:white;">Masuk Ke Sistem</a>
                </div>  
              </li>
            </div>
          </ul>
        </div>
      </div>
    </nav>
    
    <script>
    const currentLocation = window.location.href;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
      if (link.href === currentLocation) {
        link.classList.add('active'); 
      }
    });
    </script>