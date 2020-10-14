<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk Management</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambahProduk"><i class="fas fa-plus-square fa-fw text-white-50"></i> Tambah Produk Baru</button>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Card -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Diorder</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Looping p -->
                                <?php 
                                $no = 1; 
                                foreach ($produk as $p) :
                                ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= filter_output($p['nama']); ?></td>
                                    <td><?= filter_output($p['kategori']); ?></td>
                                    <td><?= filter_output($p['harga']); ?></td>
                                    <td><?= filter_output($p['stok']); ?></td>
                                    <td><?= filter_output($p['diorder']); ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/daftarproduk/'.$p['id']); ?>" class="badge badge-info"><i class="fas fa-fw fa-info"></i> Detail</a> |
                                        <a href="" data-name="<?= $p['nama']; ?>" data-href="<?= base_url('admin/deleteproduk/' . $p['id']) ?>" data-toggle="modal" data-target="#modalKonfirmasiHapusProduk" class="badge badge-danger"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                    </td>
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