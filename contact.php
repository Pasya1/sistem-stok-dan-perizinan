<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <link href="css/maincompany.css" rel="stylesheet" />
  <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <link rel="stylesheet" href="sweetalert2.min.css">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <style>
    .footertextdesc{
      color: #FFF;
      text-align: justify;
      font-family: Inter;
      font-size: 15px;
      font-style: normal;
      font-weight: 400;
      line-height: normal;
    }
    .btn-pesan{
      background: #137C26;
      box-shadow: 0px 11px 4px 0px rgba(0, 0, 0, 0.25) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.31);
      color: white;
      width: 100px;
      height: 35px;
      border: none;
    }
    .btn-pesan:hover{
      opacity: 0.9;
      background: #1A5A5F;
    }
  </style>
  <title>harun group.</title>
</head>

<body>
    <!-- Navbar -->
  <?php include 'navbar.php'; ?>
    <!-- End Navbar -->

  <!-- Start Contact -->
  <div class="section min-vh-100" style="background: url('./img/bg contact.png'); color: white; font-weight: bold;">
    <div class="container ">
        <div class="row">
            <div class="col-md-6 pt-5">
                <form method="post" action="sendmasukkan.php">
                  <div data-aos="fade-right" data-aos-duration="1000">
                    <label for="inputNama" class="form-label text-contact">Nama Lengkap</label>
                    <input type="text" class="form-control input-btn" id="inputNama" name="inputNama" aria-describedby="nama" required><br>

                    <label for="inputEmail" class="form-label text-contact">Email</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control input-btn" id="inputEmail" name="inputEmail" aria-describedby="Email" required>
                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                    </div><br>

                    <label for="inputTelp" class="form-label text-contact">No telepon</label>
                    <input type="text" class="form-control input-btn" id="inputTelp" aria-describedby="telp" name="inputTelp" required><br>

                    <label for="inputCompany" class="form-label text-contact">Nama Perusahaan</label>
                    <input type="text" class="form-control input-btn" id="inputCompany" aria-describedby="company" name="inputCompany" required><br>

                    <label for="inputNeeds" class="form-label text-contact">Apa yang Anda butuhkan ?!</label>
                    <textarea class="form-control input-btn" id="inputNeeds" style="height: 100px" name="inputNeeds" required></textarea><br>

                    <button type="submit" class="btn-pesan float-end" name="kirimmasukan">Kirim Pesan</button>
                  </div>
                </form>
            </div>
              <div class="col-md-6">
                <div data-aos="fade-up" data-aos-duration="3000">
                  <h2 class="text-center mb-4 mt-5 pt-5" style="text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.25); font-size: 40px; font-weight: 600;">harun group.</h2>
                  <div class="icon-list ">
                      <div class="col-md-12 pt-4 d-flex">
                          <i class="fas fa-envelope" style="width: 35px;"></i>
                          <p class="footertextdesc mb-0">harun_group@yahoo.com</p>
                      </div>
                      <div class="col-md-12 py-3 d-flex">
                          <i class="fas fa-phone-alt" style="width: 20px;"></i>
                          <p class="footertextdesc mb-0 ms-3">(021) 390-2628</p>
                      </div>
                      <div class="col-md-12 mb-5 d-flex">
                          <i class="fas fa-map-marker-alt" style="width: 20px;"></i>
                          <p class="footertextdesc mb-0 ms-3">Jl. Kramat II No.67, RT.8/RW.4, Kwitang, Kec. Senen, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10420</p>
                      </div>
                    </div>
                  </div>
              </div>
        </div>
    </div>
</div>

  <!-- End info kanan -->

  <!-- Footer -->
  <?php include 'footer.php'; ?>
  <!-- End Footer -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>



  <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function scrollToMember() {
      var memberSection = document.getElementById('about');
      memberSection.scrollIntoView({ behavior: 'smooth' });
    }
  </script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    AOS.init();
  });
  </script>
</body>

</html>


