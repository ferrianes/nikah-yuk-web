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
                    <p><strong class="text-danger text-uppercase">Menghapus menu akan menghapus akses menu
                            admin</strong><br>Anda yakin untuk menghapus Menu <strong><span
                                id='nama-menu-modal'></span></strong>? </p>
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
<?php endif; ?>