<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Akses Menu Admin</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Card -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><a href="<?= base_url('menu/access_menu') ?>"
                            style="text-decoration: none;">Daftar Akses Menu</a><i
                            class="fas fa-fw fa-angle-right"></i>Edit Akses Menu</h6><i
                        class="text-primary fas fa-fw fa-edit"></i>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post" action="<?= base_url('menu/editAccessMenu/'.$access_menu['id']); ?>">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="level_id">
                                <?php 
                                $roles = $this->Utama_model->getDatas('level');
                                foreach($roles as $role) : ?>
                                    <option value="<?= $role['id']; ?>" <?= $access_menu['level_id'] === $role['id'] ? 'selected' : '' ?>><?= $role['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="menu">Menu</label>
                            <select class="form-control" id="menu" name="menu_id">
                                <?php 
                                $menu = $this->Utama_model->getDatas('menu');
                                foreach($menu as $menu) : ?>
                                    <option value="<?= $menu['id']; ?>" <?= $access_menu['menu_id'] === $menu['id'] ? 'selected' : '' ?>><?= $menu['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan
                            Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->