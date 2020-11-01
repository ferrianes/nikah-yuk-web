<?php use Carbon\Carbon; ?>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Booking</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Customer</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Tanggal Dibooking</th>
                                    <th scope="col">No. Telp Customer</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (is_null($booking)) : ?>
                                <tr>
                                    <td colspan="8" class="text-center">Data kosong</td>
                                </tr>
                                <?php else : ?>
                                    <!-- Looping product -->
                                    <?php 
                                    $no = 1; 
                                    foreach ($booking as $key => $booking) : 
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= filter_output($booking['nm_lengkap']); ?></td>
                                        <td><?= filter_output($booking['produk']); ?></td>
                                        <td><?= Carbon::parse(filter_output($booking['tgl_booking']))->locale('id_ID')->isoFormat('dddd, D MMMM Y'); ?></td>
                                        <td><?= filter_output($booking['telepon']); ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/detailbooking/'.$booking['id_booking']); ?>" class="badge badge-info"><i class="fas fa-fw fa-info"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $no++; 
                                    endforeach; 
                                endif;    
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->