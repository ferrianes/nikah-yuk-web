<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin untuk log out?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" untuk mengakhiri sesi anda.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
<?php if ($title == 'Menu Management') : ?>
<!-- Modal Menu Baru -->
<div class="modal fade" id="modalTambahMenuBaru" tabindex="-1" aria-labelledby="modalTambahMenuBaruLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modalTambahMenuBaruLabel">Tambah Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu') ?>">
                <div class="modal-body text-dark">
                    <div class="form-group">
                        <input type="text" name="menu" class="form-control" placeholder="Nama Menu...">
                    </div>
                    <div class="form-group">
                        <input type="text" name="urutan" class="form-control" placeholder="Urutan..">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Menu Baru -->
<div class="modal fade" id="modalKonfirmasiHapusMenu" tabindex="-1" aria-labelledby="modalKonfirmasiHapusMenuLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modalKonfirmasiHapusMenuLabel">Hapus Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu') ?>">
                <div class="modal-body text-dark">
                    <p>Anda yakin untuk menghapus Menu <strong><span id='nama-menu-modal'></span></strong>? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="" class="btn btn-danger btn-ok">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($title == 'Akses Menu Admin') : ?>
<!-- Modal Akses Menu Baru -->
<div class="modal fade" id="modalTambahAksesMenuBaru" tabindex="-1" aria-labelledby="modalTambahAksesMenuBaruLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modalTambahAksesMenuBaruLabel">Tambah Akses Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu/access_menu') ?>">
                <div class="modal-body text-dark">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="level_id">
                            <?php 
                                $roles = $this->Utama_model->getDatas('levels');
                                foreach($roles as $role) :
                                    echo '<option value="'. $role['id'] .'">'. $role['role'] .'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="menu">Menu</label>
                        <select class="form-control" id="menu" name="menu_id">
                            <?php 
                                $menus = $this->Utama_model->getDatas('menus');
                                foreach($menus as $menu) :
                                    echo '<option value="'. $menu['id'] .'">'. $menu['menu'] .'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Menu Baru -->
<div class="modal fade" id="modalKonfirmasiHapusAksesMenu" tabindex="-1" aria-labelledby="modalKonfirmasiHapusAksesMenuLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modalKonfirmasiHapusAksesMenuLabel">Hapus Akses Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu') ?>">
                <div class="modal-body text-dark">
                    <p>Anda yakin untuk menghapus Menu <strong><span id='nama-menu-modal'></span></strong>? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="" class="btn btn-danger btn-ok">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($title == 'Produk Management') : ?>
<!-- Modal Akses Menu Baru -->
<form method="post" action="<?= base_url('product') ?>" enctype="multipart/form-data">
<div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-labelledby="modalTambahProdukLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modalTambahProdukLabel">Tambah Produk Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="id_kategori">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <?php 
                            $kategoris = $this->Utama_model->getDatas('kategoris');
                            foreach($kategoris as $kategori) :
                                echo '<option value="'. $kategori['id'] .'">'. $kategori['nama'] .'</option>';
                            endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                        </div>
                        <input type="text" class="form-control" id="harga" name="harga">
                    </div>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="text" name="stok" id="stok" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="diorder">Diorder</label>
                    <input type="text" name="diorder" id="diorder" class="form-control" value="0">
                </div>
                <div class="form-group">
                    <label for="diskon">Diskon</label>
                    <input type="text" name="diskon" id="diskon" class="form-control" value="0">
                </div>
                <div class="form-group">
                    <label for="gambar">Thumbnail</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>
</form>

<!-- Modal Hapus Menu Baru -->
<div class="modal fade" id="modalKonfirmasiHapusProduk" tabindex="-1" aria-labelledby="modalKonfirmasiHapusProdukLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modalKonfirmasiHapusProdukLabel">Hapus Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body text-dark">
                    <p>Anda yakin untuk menghapus Produk ini? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="" class="btn btn-danger btn-ok">Hapus</a>
                </div>
        </div>
    </div>
</div>
    <?php if ($this->uri->segment(2) == 'detailproduct' OR $this->uri->segment(2) == 'editproduct') : ?>
        <!-- Modal Edit Produk -->
        <form method="post" action="<?= base_url('product/editproduct/' . $produk['id']) ?>" enctype="multipart/form-data">
            <div class="modal fade" id="modalEditProduk" tabindex="-1" aria-labelledby="modalEditProdukLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="modalEditProdukLabel">Tambah Produk Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <div class="form-group">
                                <label for="nama">Nama Produk</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $produk['nama']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control" id="kategori" name="id_kategori">
                                    <option value="" disabled>Pilih Kategori</option>
                                    <?php 
                                        $kategoris = $this->Utama_model->getDatas('kategoris');
                                        foreach($kategoris as $kategori) : ?>
                                            <option value="<?= $kategori['id'] ?>" <?= $kategori['id'] == $produk['id_kategori'] ? 'selected' : '' ?>><?= $kategori['nama'] ?></option>';
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $produk['deskripsi']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" id="harga" name="harga" value="<?= $produk['harga']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="text" name="stok" id="stok" class="form-control" value="<?= $produk['stok']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="diorder">Diorder</label>
                                <input type="text" name="diorder" id="diorder" class="form-control" value="<?= $produk['diorder']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="diskon">Diskon</label>
                                <input type="text" name="diskon" id="diskon" class="form-control" value="<?= $produk['diskon']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Thumbnail</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar">
                                <input type="hidden" name="gambar_lama" value="<?= $thumbnail['id']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal Hapus Galeri -->
        <div class="modal fade" id="modalKonfirmasiHapusGaleri" tabindex="-1" aria-labelledby="modalKonfirmasiHapusGaleriLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="modalKonfirmasiHapusGaleriLabel">Hapus Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('menu') ?>">
                        <div class="modal-body text-dark">
                            <p>Anda yakin untuk menghapus data ini? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <a href="" class="btn btn-danger btn-ok">Hapus</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Galeri -->
        <form method="post" action="<?= base_url('product/tambahgaleri/' . $produk['id']) ?>" enctype="multipart/form-data">
            <div class="modal fade" id="modalTambahGaleri" tabindex="-1" aria-labelledby="modalTambahGaleriLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="modalTambahGaleriLabel">Tambah Galeri</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <div class="form-group">
                                <label for="galeri">Pilih 1 atau beberapa foto</label>
                                <input type="file" class="form-control-file" id="galeri" name="galeri[]" multiple>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
<?php endif; ?>

<?php if ($title == 'Sub Menu Management') : ?>
<!-- Modal Menu Baru -->
<div class="modal fade" id="modalTambahSubmenuBaru" tabindex="-1" aria-labelledby="modalTambahSubmenuBaruLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modalTambahSubmenuBaruLabel">Tambah Submenu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu/submenu') ?>">
                <div class="modal-body text-dark">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Nama Submenu...">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="menu_id">
                            <option disabled selected>Pilih Menu</option>
                            <?php 
                                $menus = $this->Utama_model->getDatas('menus');
                                foreach($menus as $menu) :
                                    echo '<option value="'. $menu['id'] .'">'. $menu['menu'] .'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="url" class="form-control" placeholder="Url..">
                    </div>
                    <div class="form-group">
                        <input type="text" name="icon" class="form-control" placeholder="Icon..">
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6">Apakah Submenu aktif?</label>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_active" id="inlineRadio1"
                                    value="1">
                                <label class="form-check-label" for="inlineRadio1">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_active" id="inlineRadio2"
                                    value="0">
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Menu Baru -->
<div class="modal fade" id="modalKonfirmasiHapusMenu" tabindex="-1" aria-labelledby="modalKonfirmasiHapusMenuLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modalKonfirmasiHapusMenuLabel">Hapus Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu') ?>">
                <div class="modal-body text-dark">
                    <p>Anda yakin untuk menghapus Menu <strong><span id='nama-menu-modal'></span></strong>? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="" class="btn btn-danger btn-ok">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>