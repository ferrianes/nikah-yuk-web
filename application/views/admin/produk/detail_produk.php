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
                    <h6 class="m-0 font-weight-bold text-primary"><a href="<?= base_url('admin/daftarproduk') ?>" style="text-decoration: none;">Daftar Produk</a><i class="fas fa-fw fa-angle-right"></i>Detail Produk</h6><i class="text-primary fas fa-fw fa-info"></i></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <?php if (isset ($thumbnail['status']) && $thumbnail['status'] === FALSE) : ?>
                                <img src="<?= base_url('assets/img/api/produk/noimage_content.jpg') ?>" class="img-thumbnail" alt="">
                            <?php else : ?>
                                <div class="img-container">
                                    <img src="<?= base_url('assets/img/api/produk/' . $thumbnail[0]['gambar']) ?>" class="img-thumbnail" alt="">
                                    <div class="middle">
                                        <a href="" data-href="<?= base_url('admin/deletegaleri/' . $thumbnail[0]['id'] . '/' . $produk['id']) ?>" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalKonfirmasiHapusGaleri"><i class="fas fa-trash fa-fw"></i></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="text-dark">Nama Produk</h5>
                                    <?= $produk['nama'] ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="text-dark">Kategori</h5>
                                    <?php $kategori = $this->Utama_model->getDatas('kategori', ['id' => $produk['id_kategori']])[0];  ?>
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
                                    $crncy->setTextAttribute(NumberFormatter::CURRENCY_CODE, 'IDR');
                                    $crncy->setAttribute(NumberFormatter::FRACTION_DIGITS, 0); 
                                    echo $crncy->formatCurrency($produk['harga'], "IDR"); 
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
                        <?php if (!isset($produk_gambar['status']) OR !$produk_gambar['status'] == false) : ?>
                            <?php foreach($produk_gambar as $produk_gambar) : ?>
                                <div class="col-md-4 text-center mt-2">
                                    <div class="img-container">
                                        <?php
                                        // Cek ekstensi dari galeri
                                        $file_parts = pathinfo($produk_gambar['gambar']);
								
                                        if ($file_parts['extension'] == 'mp4' OR $file_parts['extension'] == 'ogg' OR $file_parts['extension'] == 'webm') : ?>
                                            <video autoplay loop muted class="w-100 thumb-video">
                                                <source src="<?= base_url('assets/img/api/products/') . $produk_gambar['gambar'] ?>" type="video/<?= $file_parts['extension'] ?>">
                                                Your browser does not support HTML video.
                                            </video>
                                        <?php else : ?>
                                            <img class="product-img img-thumbnail" src="<?= base_url('assets/img/api/products/') . $produk_gambar['gambar'] ?>" alt="">
                                        <?php endif;  ?>
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