<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Booking</h1>
    </div>
    
    <!-- Content Row -->

    <div class="row">

        <!-- Area Card -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><a href="<?= base_url('booking') ?>" style="text-decoration: none;">Daftar Booking</a><i class="fas fa-fw fa-angle-right"></i>Detail Booking</h6><i class="text-primary fas fa-fw fa-info"></i></h6>
                    <!-- Dropdown -->
                    <!-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <p class="col-6 col-md-2 mb-1">Nama Customer</p>
                        <p class="col-6 mb-1">: <?= $kustomer['nm_lengkap'] ?></p>
                    </div>
                    <div class="row">
                        <p class="col-6 col-md-2">ID Booking</p>
                        <p class="col-6">: <?= $booking['id_booking'] ?></p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($detail as $d) : ?>
                                    <tr>
                                        <th scope="col"><?= $no; ?></th>
                                        <th scope="col"><?= $d['nama']; ?></th>
                                    </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->