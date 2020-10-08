<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Submenu Management</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Card -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><a href="<?= base_url('menu/submenu') ?>" style="text-decoration: none;">Daftar Submenu</a><i class="fas fa-fw fa-angle-right"></i>Edit Submenu</h6><i class="text-primary fas fa-fw fa-edit"></i>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post" action="<?= base_url('menu/editsubmenu/'.$submenu['id']); ?>">
                    	<div class="form-group">
                    		<label for="menu">Menu</label>
                    		<select class="form-control" id="menu" name="menu_id">
                    			<?php 
                                $menus = $this->Utama_model->getDatas('menus');
                                foreach($menus as $menu) : ?>
                    			<option value="<?= $menu['id']; ?>"
                    				<?= $submenu['menu_id'] === $menu['id'] ? 'selected' : '' ?>>
                    				<?= $menu['menu']; ?></option>
                    			<?php endforeach; ?>
                    		</select>
                    	</div>
                        <div class="form-group">
                            <label for="title">Judul Submenu</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?= $submenu['title']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" name="url" id="url" class="form-control" value="<?= $submenu['url']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" name="icon" id="icon" class="form-control" value="<?= $submenu['icon']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="is_active">Apakah aktif?</label>
                            <div class="form-check">
                            	<input class="form-check-input" type="radio" name="is_active" id="exampleRadios1"
                            		value="1" <?= $submenu['is_active'] == 1 ? 'checked' : '' ?>>
                            	<label class="form-check-label" for="exampleRadios1">
                            		Aktif
                            	</label>
                            </div>
                            <div class="form-check">
                            	<input class="form-check-input" type="radio" name="is_active" id="exampleRadios2"
                            		value="0" <?= $submenu['is_active'] == 0 ? 'checked' : '' ?>>
                            	<label class="form-check-label" for="exampleRadios2">
                            		Tidak Aktif
                            	</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->