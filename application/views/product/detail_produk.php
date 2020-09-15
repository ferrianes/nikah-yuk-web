<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk Management</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#modalEditProduk"><i class="fas fa-edit fa-fw text-white-50"></i> Ubah Produk</button>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Card -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><a href="<?= base_url('product') ?>" style="text-decoration: none;">Daftar Produk</a><i class="fas fa-fw fa-angle-right"></i>Detail Produk</h6><i class="text-primary fas fa-fw fa-info"></i></h6>
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
                <?php if(validation_errors()) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Data Gagal Diinput!</strong>
                        <?= validation_errors('<div>', '</div>'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?= $this->session->flashdata('pesan'); ?>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <img src="<?= base_url('assets/img/api/products/' . $thumbnail['gambar']) ?>" class="img-thumbnail" alt="">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="text-dark">Nama Produk</h5>
                                    <?= $produk['nama'] ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="text-dark">Kategori</h5>
                                    <?php $kategori = $this->Utama_model->getDatas('kategoris', ['id' => $produk['id_kategori'], $produk['id_kategori']])[0];  ?>
                                    <?= $kategori['nama'] ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="text-dark">Deskripsi</h5>
                                    <?= $produk['deskripsi'] ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="text-dark">Harga</h5>
                                    <?php 
                                    $crncy = new NumberFormatter( 'id_ID', NumberFormatter::CURRENCY );
                                    ?>
                                    <?= $crncy->formatCurrency($produk['harga'], "IDR"); 
                                    ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="text-dark">Stok</h5>
                                    <?= $produk['stok'] ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="text-dark">Diorder</h5>
                                    <?= $produk['diorder'] ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="text-dark">Diskon</h5>
                                    <?= $produk['diskon'] ?>%
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr class="sidebar-divider mb-2">
                    <div class="row justify-content-end">
                        <div class="col-12 col-md-4">
                            <h2 class="text-center mt-2 text-uppercase text-dark">Galeri</h2>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-sm btn-primary text-center float-right mt-md-2" data-toggle="modal"  data-target="#modalTambahGaleri"><i class="fas fa-plus-square fa-fw text-white-50"></i> Tambah Galeri</button>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <?php if (!isset($produks_gambar['status']) OR !$produks_gambar['status'] == false) : ?>
                            <?php foreach($produks_gambar as $produk_gambar) : ?>
                                <div class="col-md-4 text-center mt-2">
                                    <div class="img-container">
                                        <img class="product-img img-thumbnail" src="<?= base_url('assets/img/api/products/') . $produk_gambar['gambar'] ?>" alt="">
                                        <div class="middle">
                                            <a href="" data-href="<?= base_url('product/deletegaleri/' . $produk_gambar['id'] . '/' . $produk['id']) ?>" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalKonfirmasiHapusGaleri"><i class="fas fa-trash fa-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; 
                        else :
                            echo 'Foto tidak ditemukan';
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->