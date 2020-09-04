<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
    <div class="sidebar-brand-icon">
        <i class="fas fa-tools"></i>
    </div>
    <div class="sidebar-brand-text mx-3">NikahYuk Admin Panel</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Looping Menu -->
<?php foreach ($menus_by_access_menu as $menu) : ?>

<!-- Heading -->
<div class="sidebar-heading">
    <?= filter_output($menu['menu']); ?>
</div>
    <!-- Ambil Data Dari Menu Id -->
    <?php 
    $menuId = $menu['id'];
    $subMenus = $this->Utama_model->getDatas('sub_menus', ['menu_id' => $menuId]);
    // var_dump($subMenus);
    if(isset($subMenus['status']) && $subMenus['status'] === FALSE) :
        else :
            // Looping Sub Menu
            foreach ($subMenus as $subMenu) :
            ?>
            <!-- Nav Item -->
            <li class="nav-item <?= ($title == $subMenu['title'] ? 'active' : ''); ?>">
                <a class="nav-link py-2" href="<?= filter_output(base_url($subMenu['url'])); ?>">
                    <i class="<?= filter_output($subMenu['icon']); ?>"></i>
                    <span><?= filter_output($subMenu['title']); ?></span>
                </a>
            </li>
            <?php endforeach; 
    endif; ?>

<!-- Divider -->
<hr class="sidebar-divider mb-2">

<?php endforeach; ?>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->