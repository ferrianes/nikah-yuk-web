<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sub Menu Admin</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambahAksesMenuBaru"><i class="fas fa-plus-square fa-fw text-white-50"></i> Tambah Sub Menu Baru</button>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Card -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Submenu</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?= $this->session->flashdata('pesan'); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Submenu</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Looping Menu -->
                                <?php $no = 1; foreach ($submenus as $submenu) : ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= filter_output($submenu['title']); ?></td>
                                    <td><?= filter_output($submenu['menu']); ?></td>
                                    <td><?= filter_output($submenu['url']); ?></td>
                                    <td><?= filter_output($submenu['icon']); ?></td>
                                    <td>
                                        <a href="<?= base_url('menu/editAccessMenu/'.$submenu['id']); ?>" class="badge badge-primary"><i class="fas fa-fw fa-edit"></i> Edit</a> | 
                                        <a href="" data-name="<?= $submenu['menu']; ?>" data-href="<?= base_url('menu/deleteAccessMenu/' . $submenu['id']) ?>" data-toggle="modal" data-target="#modalKonfirmasiHapusAksesMenu" class="badge badge-danger"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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