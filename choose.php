<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css" />

    <link href="css/maincompany.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <title>Welcome to System</title>


    <style>
    .navbar-nav .nav-link.active {
    color: white !important; 
    }
    .navbar {
        background-color: white !important;
    }
    .gr-1 {
        background: linear-gradient(170deg, #01E4F8 0%, #1D3EDE 100%);
    }

    .gr-2 {
        background: linear-gradient(170deg, #B4EC51 0%, #429321 100%);
    }

    .gr-3 {
        background: linear-gradient(170deg, #C86DD7 0%, #3023AE 100%);
    }
    .gr-4 {
    background: linear-gradient(170deg, #F5F5DC 0%, #D2B48C 100%);
}

    .gr-5 {
        background: linear-gradient(170deg, #FFB6C1 0%, #FF69B4 100%);
    }
    
    .gr-6 {
        background: linear-gradient(170deg, #FF6B6B 0%, #FFB366 100%);
    }

    * {
        transition: .5s;
    }

    .h-100 {
        height: 100vh !important;
    }

    .column {
        margin-top: 3rem;
        padding-left: 3rem;
    }

    .column:hover {
        padding-left: 0;
    }

    .column:hover .card .txt {
        margin-left: 1rem;
    }

    .column:hover .card .txt h1,
    .column:hover .card .txt p {
        color: rgba(255, 255, 255, 1);
        opacity: 1;
    }

    .column:hover .card a {
        color: rgba(255, 255, 255, 1);
    }

    .column:hover .card a:after {
        width: 10%;
    }

    .card {
        min-height: 170px;
        margin: 0;
        padding: 1.7rem 1.2rem;
        border: none;
        border-radius: 0;
        color: rgba(0, 0, 0, 1);
        letter-spacing: .05rem;
        font-family: 'Oswald', sans-serif;
        box-shadow: 0 0 21px rgba(0, 0, 0, .27);
    }

    .card .txt {
        margin-left: -3rem;
        z-index: 1;
    }

    .card .txt h1 {
        font-size: 1.5rem;
        font-weight: 300;
        text-transform: uppercase;
    }

    .card .txt p {
        font-size: .7rem;
        font-family: 'Open Sans', sans-serif;
        letter-spacing: 0rem;
        margin-top: 33px;
        opacity: 0;
        color: rgba(255, 255, 255, 1);
    }

    .card a {
        z-index: 3;
        font-size: .7rem;
        color: rgba(0, 0, 0, 1);
        margin-left: 1rem;
        position: relative;
        bottom: -.5rem;
        text-transform: uppercase;
    }

    .card .goto:after {
        content: "";
        display: inline-block;
        height: 0.5em;
        width: 0;
        margin-right: -100%;
        margin-left: 10px;
        border-top: 1px solid rgba(255, 255, 255, 1);
        transition: .5s;
    }

    .card .ico-card {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .card i {
        position: relative;
        right: -50%;
        top: 60%;
        font-size: 12rem;
        line-height: 0;
        opacity: .2;
        color: rgba(255, 255, 255, 1);
        z-index: 0;
    }

    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="row">
        <h2 class="text-center d-lg-block d-md-block d-sm-none pt-5">WELCOME TO SYSTEM</h2><br>
        <p class="text-center d-lg-block d-md-block d-sm-none">choose your company system</p>
    </div>
    <div class="container h-100">
    <div class="row">
        <div class="col-md-6 col-lg-4 column">
            <a href="APH/profil.php"  style="text-decoration: none;">
            <div class="card gr-4">
                <div class="txt">
                <h1>PT. AMANAH </br>
        PUTERA HARUN</h1>
                <p>SPBU Transportable Menggunakan Container.</p>
                </div>
                <a href="APH/profil.php" class="goto">go to system</a>
                <div class="ico-card">
                <i class="fa fa-rebel"></i>
            </div>
            </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4 column">
            <a href="MHG/profil.php"  style="text-decoration: none;">
            <div class="card gr-1">
                <div class="txt">
                <h1>PT. MITRA </br>
        HARUN GASINDO</h1>
                <p>Stasiun Pengisian Bulk Elpigi.</p>
                </div>
                <a href="MHG/profil.php" class="goto">go to system</a>
                <div class="ico-card">
                <i class="fa fa-rebel"></i>
            </div>
            </div>
            </a>
        </div>
        
        <div class="col-md-6 col-lg-4 column">
            <a href="HTG/profil.php"  style="text-decoration: none;">
            <div class="card gr-2">
                <div class="txt">
                <h1>PT. HARUN </br>
        TABUNG GASINDO</h1>
                <p>Repair, Retest & Repaint Gas 3Kg.</p>
                </div>
                <a href="HTG/profil.php" class="goto">go to system</a>
            <div class="ico-card">
                <i class="fa fa-codepen"></i>
            </div>
            </div>
            </a>
        </div>
        
        
    </div>
    
    <!-- Bagian PT Bawah -->
    <div class="row">
        <div class="col-md-6 col-lg-4 column">
            <a href="AHG/profil.php"  style="text-decoration: none;">
            <div class="card gr-3">
                <div class="txt">
                <h1>PT. AMANAH </br>HARUN GASINDO</h1>
                <p>Agen LPG 3kg bersubsidi.</p>
                </div>
                <a href="AHG/profil.php" class="goto">go to system</a>
            <div class="ico-card">
                <i class="fa fa-empire"></i>
            </div>
            </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4 column">
            <a href="HCG/profil.php"  style="text-decoration: none;">
            <div class="card gr-5">
                <div class="txt">
                <h1>PT. HARUN </br>
        CITRA GAS</h1>
                <p>Agen LPG 3kg bersubsidi.</p>
                </div>
                <a href="HCG/profil.php" class="goto">go to system</a>
            <div class="ico-card">
                <i class="fa fa-codepen"></i>
            </div>
            </div>
            </a>
        </div>
        
        <div class="col-md-6 col-lg-4 column">
            <a href="MES/profil.php"  style="text-decoration: none;">
            <div class="card gr-6">
                <div class="txt">
                <h1>PT. MITRA </br>ENERGI SELARAS</h1>
                <p>Handling agent untuk supply BBM solar B30.</p>
                </div>
                <a href="MES/profil.php" class="goto">go to system</a>
            <div class="ico-card">
                <i class="fa fa-empire"></i>
            </div>
            </div>
            </a>
        </div>
        
    </div>

    </div>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>