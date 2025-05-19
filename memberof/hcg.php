<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <link href="member.css" rel="stylesheet" />
  <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap">
  <script src="../script.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="sweetalert2.min.css">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
    .judulabout{
        color: #9A031E;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.25);
        font-family: Rubik;
        font-size: 35px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }
    .isiabout{
        color: #9A031E;
        text-align: justify;
        font-family: Inter;
        font-size: 20px;
        font-style: normal;
        font-weight: 200;
        line-height: normal;
        transition: background-color 0.3s ease-in-out;
        padding: 20px;
    }

    .isiabout:hover {
        background: #9A031E;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color: #fff;
        font-size: 20px;
        flex-shrink: 0;
        padding: 20px;
    }
    
    /* css bg splash */
    .context {
    width: 100%;
    position: absolute;
    top:35vh;
    z-index: 998;
    
    }

    .context h1{
        text-align: center;
        color: #fff;
        font-size: 40px;
    }


    .area{
        background: #9A031E;  
        background: -webkit-linear-gradient(to left, #8f94fb, #9A031E);  
        width: 100%;
        height:100vh;
        z-index: 250;
    
    }

    .circles{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 200;
    }

    .circles li{
        position: absolute;
        display: block;
        list-style: none;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.2);
        animation: animate 25s linear infinite;
        bottom: -150px;
        
    }

    .circles li:nth-child(1){
        left: 25%;
        width: 80px;
        height: 80px;
        animation-delay: 0s;
    }


    .circles li:nth-child(2){
        left: 10%;
        width: 20px;
        height: 20px;
        animation-delay: 2s;
        animation-duration: 12s;
    }

    .circles li:nth-child(3){
        left: 70%;
        width: 20px;
        height: 20px;
        animation-delay: 4s;
    }

    .circles li:nth-child(4){
        left: 40%;
        width: 60px;
        height: 60px;
        animation-delay: 0s;
        animation-duration: 18s;
    }

    .circles li:nth-child(5){
        left: 65%;
        width: 20px;
        height: 20px;
        animation-delay: 0s;
    }

    .circles li:nth-child(6){
        left: 75%;
        width: 110px;
        height: 110px;
        animation-delay: 3s;
    }

    .circles li:nth-child(7){
        left: 35%;
        width: 150px;
        height: 150px;
        animation-delay: 7s;
    }

    .circles li:nth-child(8){
        left: 50%;
        width: 25px;
        height: 25px;
        animation-delay: 15s;
        animation-duration: 45s;
    }

    .circles li:nth-child(9){
        left: 20%;
        width: 15px;
        height: 15px;
        animation-delay: 2s;
        animation-duration: 35s;
    }

    .circles li:nth-child(10){
        left: 85%;
        width: 150px;
        height: 150px;
        animation-delay: 0s;
        animation-duration: 11s;
    }

    @keyframes animate {

        0%{
            transform: translateY(0) rotate(0deg);
            opacity: 1;
            border-radius: 0;
        }

        100%{
            transform: translateY(-1000px) rotate(720deg);
            opacity: 0;
            border-radius: 50%;
        }

    }
    </style>
  
    <style>
        /* GALERY */
    .carousel {
    position: relative;
    }
    .carousel-item img {
    object-fit: cover;
    }
    #carousel-thumbs {
    background: #9A031E;
    bottom: 0;
    left: 0;
    padding: 0 50px;
    right: 0;
    }
    #carousel-thumbs img {
    border: 5px solid transparent;
    cursor: pointer;
    }
    #carousel-thumbs img:hover {
    border-color: rgba(255,255,255,.3);
    }
    #carousel-thumbs .selected img {
    border-color: #fff;
    }
    .carousel-control-prev,
    .carousel-control-next {
    width: 50px;
    }
    @media all and (max-width: 767px) {
    .carousel-container #carousel-thumbs img {
        border-width: 3px;
    }
    }
    @media all and (min-width: 576px) {
    .carousel-container #carousel-thumbs {
        position: absolute;
    }
    }
    @media all and (max-width: 576px) {
    .carousel-container #carousel-thumbs {
        background: #ccccce;
    }
    }
    </style>
  <title>harun group.</title>
</head>

<body>
    <!-- Navbar -->
    <?php include 'navmember.php'; ?>
    <!-- End Navbar -->

    <!-- STart -->
    <div class="section min-vh-100">
        <div class="area" >
                <ul class="circles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                </ul>
        </div>
    </div>
    <div class="context">
            <div data-aos="fade-up" data-aos-duration="1000">
                <h1>PT. HARUN CITRA GAS</h1>
            </div>
            <div class="col-md-12 text-center justify-content-center px-4" style="font-size:14px; color:white;">
            <div data-aos="zoom-in" data-aos-duration="3000">
              <p class="mt-4" style="line-height: 1;">Bergerak dibidang agen LPG 3kg  </p>
              <p class="mb-5" style="line-height: 1;">bersubsidi di daerah kabupaten Garut.</p>
            </div> 
            <div class="col-md-12 text-center justify-content-center" >
                <div data-aos="fade" data-aos-duration="3000">
                    <button type="button" class="btn-custom mb-5" onclick="scrollToAbout()">Read More</button>
                </div>  
            </div> 
            <div class="col-md-4">
                <div data-aos="fade-right" data-aos-duration="3000">
                    <div class="kotak d-flex justify-content-center text-center align-items-center px-4 pt-2">
                        <img src="../img/logo/logo5.png" style="width: 90px; height: 70px;">
                        <img src="../img/logo/logopertamina.png" style="width: 100px; height: 100px;">
                    </div>
                </div>
            </div>
          </div>
        </div>



    <!-- About -->
    <div class="section min-vh-100 mt-5 pt-2 mx-5 justify-content-center align-items-center" id="about">
        <div class="col-md-12">
            <div data-aos="fade" data-aos-duration="1000">
                <h2 class="judulabout text-center my-5 pt-4 animated-flyIn">About</h2>
            </div>
        </div>
        <div data-aos="fade-up" data-aos-duration="3000">
            <div class="row justify-content-center" style="text-align:justify;">
                <div class="col-md-5">
                    <p class="isiabout animated-flyInup ">PT. Harun Citra Gas adalah agen gas LPG 3kg yang  berdedikasi untuk menyediakan akses yang mudah dan andal terhadap gas rumah tangga di wilayah kabupaten Garut. Perusahaan ini didirikan pada tahun 2017, dengan visi dan misi untuk memenuhi kebutuhan energi  masyarakat sekitar. </p> 
                </div>
                <div class="col-md-5">
                    <p class="isiabout animated-flyIn">Sejak berdiri, PT. Harun Citra Gas telah berkomitmen untuk  memberikan pelayanan terbaik dan menjaga standar keamanan yang tinggi dalam penyediaan gas LPG 3kg.</p> 
                </div>
            </div>
        </div>
    </div>


    <!-- GALERY -->
<div class="section min-vh-50" id="gallery"  style="background: #9A031E;">
    <div class="container" style="background: #9A031E;">
        <div class="carousel-container pt-3 position-relative row">
            <div data-aos="zoom-in" data-aos-duration="3000">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-slide-number="0">
                        <img src="../img/hcg/gambar1.jpeg" class="d-block w-100" alt="..." data-remote="../img/hcg/gambar1.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
                        </div>
                        <div class="carousel-item" data-slide-number="1">
                        <img src="../img/hcg/gambar2.jpeg" class="d-block w-100" alt="..." data-remote="../img/hcg/gambar2.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
                        </div>
                        <div class="carousel-item" data-slide-number="2">
                        <img src="../img/hcg/gambar3.jpeg" class="d-block w-100" alt="..." data-remote="../img/hcg/gambar3.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
                        </div>
                        <div class="carousel-item" data-slide-number="3">
                        <img src="../img/hcg/gambar4.jpeg" class="d-block w-100" alt="..." data-remote="../img/hcg/gambar4.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
                        </div>
                    </div>
                </div>
            </div>
        <!-- Carousel Navigation -->
            <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
                <div data-aos="fade-up" data-aos-duration="1000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <div class="row mx-0">
                            <div id="carousel-selector-0" class="thumb col-4 col-sm-2 px-1 py-2 selected" data-target="#myCarousel" data-slide-to="0">
                            <img src="../img/hcg/gambar1.jpeg" class="img-fluid" alt="...">
                            </div>
                            <div id="carousel-selector-1" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="1">
                            <img src="../img/hcg/gambar2.jpeg" class="img-fluid" alt="...">
                            </div>
                            <div id="carousel-selector-2" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="2">
                            <img src="../img/hcg/gambar3.jpeg" class="img-fluid" alt="...">
                            </div>
                            <div id="carousel-selector-3" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="3">
                            <img src="../img/hcg/gambar4.jpeg" class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- JIKA FOTO LEBIH DARI 6 -->

                <!-- <div class="carousel-item">
                    <div class="row mx-0">
                        <div id="carousel-selector-6" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="6">
                        <img src="" class="img-fluid" alt="...">
                        </div>
                        <div id="carousel-selector-7" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="7">
                        <img src="" class="img-fluid" alt="...">
                        </div>
                        <div id="carousel-selector-8" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="8">
                        <img src="" class="img-fluid" alt="...">
                        </div>
                        <div id="carousel-selector-9" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="9">
                        <img src="" class="img-fluid" alt="...">
                        </div>
                        <div class="col-2 px-1 py-2"></div>
                        <div class="col-2 px-1 py-2"></div>
                    </div>
                </div>
            </div> -->
        <a class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

        </div> 
    </div> 
    </div>
</div>
        
        <!-- Start Map Location -->
    <div class="section min-vh-100">
        <div class="container justify-content-center align-items-center text-center">
            <div data-aos="fade" data-aos-duration="1000">
                <h2 class="judulabout text-center my-5 pt-4 animated-flyIn">Location</h2>
            </div>
            <div data-aos="fade-up" data-aos-duration="1000">
                <div class="col-md-12 mx-3 mb-5">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15850.876049468601!2d106.87667173483908!3d-6.681689530915302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c9b8cb211c97%3A0xd500c11e43c939aa!2sSukamaju%2C%20Kec.%20Megamendung%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1702653241719!5m2!1sid!2sid" style="border:0;" width="100%" height="600" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
   <?php include 'footmember.php'; ?>












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
       $(document).ready(function() {
  // Inisialisasi Carousel
  $('#myCarousel').carousel({
    interval: false
  });
  $('#carousel-thumbs').carousel({
    interval: false
  });

  // Memilih slide berdasarkan thumbnail yang diklik
  $('[data-slide-to]').click(function() {
    var id = parseInt($(this).attr('data-slide-to'));
    $('#myCarousel').carousel(id);
  });

  // Mengatur tindakan saat slide berubah pada carousel utama
  $('#myCarousel').on('slide.bs.carousel', function(e) {
    var id = parseInt($(e.relatedTarget).attr('data-slide-number'));
    $('[data-slide-to]').removeClass('selected');
    $('[data-slide-to=' + id + ']').addClass('selected');
  });
});

    </script>

  <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function scrollToAbout() {
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