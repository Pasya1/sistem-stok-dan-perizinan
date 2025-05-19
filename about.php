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
  <script src="script.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="sweetalert2.min.css">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

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
        #about {
          background: linear-gradient(-45deg, #384B42, #1E5D58, #7AB083);
          background-size: 400% 400%;
          animation: gradient 5s ease infinite;
          color: white;
          text-align: justify;
          padding: 20px; 
        }
  </style>
  <title>harun group.</title>
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- End Navbar -->

    <!-- Start Splash -->
    <div class="section" id="about">
        <div class="container px-3 justify-content-center">
            <div data-aos="zoom-in" data-aos-duration="3000">
                <div class="h2 my-5 text-center">HISTORY</div>
                <div class="col-md-12 text-center">
                    <p>Harun Group didirikan pada tahun 1993, dengan lokasi operasional pertamanya di Pelabuhan Muara Baru, Jakarta Utara, dengan nama PT Haji Harun Harahap. Perusahaan ini merupakan SPBB atau SPBU terapung untuk menyalurkan bbm solar subsidi untuk kapal-kapal ikan yang berada di wilayah pelabuhan muara baru.</p>
                </div>
                <div class="d-flex mt-5 pt-5 mx-2 justify-content-center">
                    <div class="col-md-6 mx-4">
                        <div class="h3 text-center pb-3">Visi</div>
                        <ul class="visi-misi">
                            <li>Menjadi Perusahaan Komersial di Bidang Energi.</li>
                            <li>Memberdayakan kemampuan sumber daya manusia lokal untuk menghadapi persaingan bisnis global yang ketat dan memberikan nilai tambah bagi pelanggan dan masyarakat.</li>
                        </ul>
                    </div>
                    <div class="col-md-6 mx-4">
                        <div class="h3 text-center pb-3">Misi</div>
                        <ul class="visi-misi mb-5">
                            <li>Menjalankan produk di bidang energi, produk turunan minyak dan gas yang bersubsidi.</li>
                            <li>Menjadi bagian pengembangan distribusi di bidang energi yang ditunjuk oleh pemerintahan.</li>
                            <li>Memberikan pelayanan yang terbaik kepada pelanggan dengan jaminan kualitas dan kuantitas.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div data-aos="zoom-out" data-aos-duration="1000">
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="img/gambarkantor1.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>H3 HEAD OFFICE</h5>
                </div>
                </div>
                <div class="carousel-item ">
                <img src="img/gambarkantor2.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>H3 HEAD OFFICE</h5>
                </div>
                </div>
                <div class="carousel-item ">
                <img src="img/gambarkantor3.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>H3 HEAD OFFICE</h5>
                </div>
                </div>
                <div class="carousel-item ">
                <img src="img/gambarkantor4.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>H3 HEAD OFFICE</h5>
                </div>
                </div>
                <div class="carousel-item  ">
                <img src="img/gambarkantor5.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>H3 HEAD OFFICE</h5>
                </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
    </div>
</div>

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
