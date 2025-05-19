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
        color: #1A5A5F;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.25);
        font-family: Rubik;
        font-size: 35px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }
    .isiabout{
        color: #1A5A5F;
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
        background: #1A5A5F;
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
        background: #1A5A5F;  
        background: -webkit-linear-gradient(to left, #8f94fb, #1A5A5F);  
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
    background: #1A5A5F;
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
                <h1>PT. MITRA HARUN GASINDO</h1>
            </div>
            <div class="col-md-12 text-center justify-content-center px-4" style="font-size:14px; color:white;">
            <div data-aos="zoom-in" data-aos-duration="3000">
              <p class="mt-4" style="line-height: 1;">Merupakan SPBE (Stasiun Pengisian Bulk Elpigi)  </p>
              <p class="mb-5" style="line-height: 1;">yang berlokasi di ciawi, Kota Bogor.</p>
            </div> 
            <div class="col-md-12 text-center justify-content-center" >
                <div data-aos="fade" data-aos-duration="3000">
                    <button type="button" class="btn-custom mb-5" onclick="scrollToAbout()">Read More</button>
                </div>  
            </div> 
            <div class="col-md-4">
                <div data-aos="fade-right" data-aos-duration="3000">
                    <div class="kotak d-flex justify-content-center text-center align-items-center px-4 pt-2">
                        <img src="../img/logo/logo2.png" style="width: 90px; height: 70px;">
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
                    <p class="isiabout animated-flyInup ">PT. Mitra Harun Gasindo  adalah perusahaan yang bergerak di bidang pengisian tabung gas 3kg, yang berlokasi di Ciawi, Kota Bogor.  Perusahaan ini berdiri sejak tahun 2010, memiliki komitmen untuk  menyediakan layanan pengisian tabung gas berkualitas tinggi bagi masyrakat sekitar.</p> 
                </div>
                <div class="col-md-5">
                    <p class="isiabout animated-flyIn">Dengan pengalaman dan dedikasi selama lebih dari satu dekade, PT. Mitra Harun Gasindo telah membangun reputasi yang kuat dalam memberikan pelayanan terbaik kepada pelanggan, menjadikannya salah satu pilihan utama dalam pengisian tabung gas di wilayah Ciawi.</p> 
                </div>
            </div>
        </div>
    </div>


    <!-- GALERY -->
<div class="section min-vh-50" id="gallery"  style="background: #1A5A5F;">
    <div class="container pt-3"  style="background: #1A5A5F;">
        <div class="carousel-container position-relative row">
        
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-slide-number="0">
            <img src="../img/mhg/g1.jpeg" class="d-block w-100" alt="..." data-remote="../img/mhg/g1.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
            </div>
            <div class="carousel-item" data-slide-number="1">
            <img src="../img/mhg/g2.jpeg" class="d-block w-100" alt="..." data-remote="../img/mhg/g2.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
            </div>
            <div class="carousel-item" data-slide-number="2">
            <img src="../img/mhg/g3.jpg" class="d-block w-100" alt="..." data-remote="../img/mhg/g3.jpg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
            </div>
            <div class="carousel-item" data-slide-number="3">
            <img src="../img/mhg/g4.jpeg" class="d-block w-100" alt="..." data-remote="../img/mhg/g4.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
            </div>
            <div class="carousel-item" data-slide-number="4">
            <img src="../img/mhg/g5.jpeg" class="d-block w-100" alt="..." data-remote="../img/mhg/g5.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
            </div>
            <div class="carousel-item" data-slide-number="5">
            <img src="../img/mhg/g6.jpeg" class="d-block w-100" alt="..." data-remote="../img/mhg/g6.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
            </div>
            <div class="carousel-item" data-slide-number="6">
            <img src="../img/mhg/g7.jpg" class="d-block w-100" alt="..." data-remote="../img/mhg/g7.jpg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
            </div>
            <div class="carousel-item" data-slide-number="7">
            <img src="../img/mhg/g8.jpeg" class="d-block w-100" alt="..." data-remote="../img/mhg/g8.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
            </div>
            <div class="carousel-item" data-slide-number="8">
            <img src="../img/mhg/g9.jpeg" class="d-block w-100" alt="..." data-remote="../img/mhg/g9.jpeg" data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
            </div>
        </div>
        </div>

        <!-- Carousel Navigation -->
        <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <div class="row mx-0">
                <div id="carousel-selector-0" class="thumb col-4 col-sm-2 px-1 py-2 selected" data-target="#myCarousel" data-slide-to="0">
                <img src="../img/mhg/g1.jpeg" class="img-fluid" alt="...">
                </div>
                <div id="carousel-selector-1" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="1">
                <img src="../img/mhg/g2.jpeg" class="img-fluid" alt="...">
                </div>
                <div id="carousel-selector-2" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="2">
                <img src="../img/mhg/g3.jpg" class="img-fluid" alt="...">
                </div>
                <div id="carousel-selector-3" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="3">
                <img src="../img/mhg/g4.jpeg" class="img-fluid" alt="...">
                </div>
                <div id="carousel-selector-4" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="4">
                <img src="../img/mhg/g5.jpeg" class="img-fluid" alt="...">
                </div>
                <div id="carousel-selector-5" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="5">
                <img src="../img/mhg/g6.jpeg" class="img-fluid" alt="...">
                </div>
            </div>
            </div>
            <div class="carousel-item">
            <div class="row mx-0">
                <div id="carousel-selector-6" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="6">
                <img src="../img/mhg/g7.jpg" class="img-fluid" alt="...">
                </div>
                <div id="carousel-selector-7" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="7">
                <img src="../img/mhg/g8.jpeg" class="img-fluid" alt="...">
                </div>
                <div id="carousel-selector-6" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="8">
                <img src="../img/mhg/g9.jpeg" class="img-fluid" alt="...">
                </div>
                <div class="col-2 px-1 py-2"></div>
                <div class="col-2 px-1 py-2"></div>
            </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-thumbs" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-thumbs" role="button" data-slide="next">
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.901031318904!2d106.85475597418895!3d-6.659186765097968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8fa41b6398f%3A0xef34c880bf70bd0e!2sSpbe%20Pt.%20Mitra%20Harun%20Gasindo!5e0!3m2!1sid!2sid!4v1702651497021!5m2!1sid!2sid" style="border:0;" width="100%" height="600" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
     $('#myCarousel').carousel({
        interval: false
        });
        $('#carousel-thumbs').carousel({
        interval: false
        });

      
        $('[id^=carousel-selector-]').click(function() {
        var id_selector = $(this).attr('id');
        var id = parseInt( id_selector.substr(id_selector.lastIndexOf('-') + 1) );
        $('#myCarousel').carousel(id);
        });

        // Only display 3 items in nav on mobile.
        if ($(window).width() < 575) {
        $('#carousel-thumbs .row div:nth-child(4)').each(function() {
            var rowBoundary = $(this);
            $('<div class="row mx-0">').insertAfter(rowBoundary.parent()).append(rowBoundary.nextAll().addBack());
        });
        $('#carousel-thumbs .carousel-item .row:nth-child(even)').each(function() {
            var boundary = $(this);
            $('<div class="carousel-item">').insertAfter(boundary.parent()).append(boundary.nextAll().addBack());
        });
        }

        // Hide slide arrows if too few items.
        if ($('#carousel-thumbs .carousel-item').length < 2) {
        $('#carousel-thumbs [class^=carousel-control-]').remove();
        $('.machine-carousel-container #carousel-thumbs').css('padding','0 5px');
        }

        // when the carousel slides, auto update
        $('#myCarousel').on('slide.bs.carousel', function(e) {
        var id = parseInt( $(e.relatedTarget).attr('data-slide-number') );
        $('[id^=carousel-selector-]').removeClass('selected');
        $('[id=carousel-selector-'+id+']').addClass('selected');
        });
        
        // when user swipes, go next or previous
        $('#myCarousel').swipe({
        fallbackToMouseEvents: true,
        swipeLeft: function(e) {
            $('#myCarousel').carousel('next');
        },
        swipeRight: function(e) {
            $('#myCarousel').carousel('prev');
        },
        allowPageScroll: 'vertical',
        preventDefaultEvents: false,
        threshold: 75
        });
        
        $('#myCarousel .carousel-item img').on('click', function(e) {
        var src = $(e.target).attr('data-remote');
        if (src) $(this).ekkoLightbox();
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