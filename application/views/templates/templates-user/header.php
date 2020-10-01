<!DOCTYPE html> 
<html lang="en"> 
 
<head>     
    <meta charset="utf-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <meta http-equiv="X-UA-Compatible" content="ie=edge">     
    <title>NIKAHYUK | <?= $judul; ?></title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">  
    <!-- Nucleo Icons -->
    <link href="<?= base_url(); ?>assets/css/argon-design-system/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/argon-design-system/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="<?= base_url(); ?>assets/css/argon-design-system/argon-design-system.css?v=1.2.0" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/custom/script.css" rel="stylesheet" />
</head> 

<body class="d-flex flex-column min-vh-100">    

<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
    <div class="container">
    <a class="navbar-brand" href="<?= base_url('home/index'); ?>">NIKAHYUK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-default">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a class="navbar-brand" href="<?= base_url('home/index'); ?>">NIKAHYUK</a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            
            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="<?= base_url('home/index'); ?>">
                        <i class="fa fa-home"></i>
                        <span class="nav-link-inner--text">Beranda</span>
                    </a>
                </li>
                <?php if (!empty($this->session->email_kustomer)) : ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="<?= base_url('booking/dataBooking'); ?>">
                            <i class="ni ni-cart"></i>
                            <span class="nav-link-inner--text">Booking Produk <span class="badge badge-default"><?= count($booking_temp) ?></span></span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <span class="nav-link nav-link-icon dropdown-toggle cursor-pointer" href="#" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="avatar avatar-xsm rounded-circle" src="<?= base_url('assets/img/api/kustomer/' . $kustomer['image']); ?>" alt="Foto Kustomer">
                            <span class="nav-link-inner--text">Hi, <b><?= $kustomer['nm_lengkap']; ?></b></span>
                        </span>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                            <a class="dropdown-item" href="<?= base_url('kustomer/profilku'); ?>"><span class="fa fa-user-circle mr-2"></span>Profilku</a>
                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal"><span class="fa fa-sign-out-alt mr-2"></span>Log out</a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" data-toggle="modal" datatarget="#daftarModal" href="#daftarModal">
                            <i class="fa fa-user-plus"></i>
                            <span class="nav-link-inner--text">Daftar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" data-toggle="modal" datatarget="#loginModal" href="#loginModal">
                            <i class="fa fa-sign-in-alt"></i>
                            <span class="nav-link-inner--text">Log in</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#">
                            <i class="ni ni-circle-08"></i>
                            <span class="nav-link-inner--text">Hi, <b><?= $kustomer['nm_lengkap']; ?></b></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            
        </div>
    </div>
  </nav>
  <section class="section-profile-cover section-shaped my-0">
      <!-- Circles background -->
      <img class="bg-image" src="<?= base_url('assets/img/app/home-banner.jpg') ?>" style="width: 100%;">
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>