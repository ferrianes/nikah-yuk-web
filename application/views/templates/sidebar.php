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

<!-- Query Menu -->
<?php
$level_id = $this->session->userdata('level');
$queryMenu = "SELECT `admin_menu`.`id`, `menu` 
                FROM `admin_menu` JOIN `admin_access_menu` 
                    ON  `admin_menu`.`id` = `admin_access_menu`.`menu_id`
                WHERE `admin_access_menu`.`level_id` = $level_id
            ORDER BY `admin_access_menu`.`menu_id` ASC
            ";

$menus = $this->db->query($queryMenu)->result_array();
?>

<!-- Looping Menu -->
<?php foreach ($menus as $menu) : ?>

<!-- Heading -->
<div class="sidebar-heading">
    <?= filter_output($menu['menu']); ?>
</div>

    <?php 
    $menuId = $menu['id'];
    $querySubMenu = "SELECT * FROM `admin_sub_menu` WHERE `menu_id` = $menuId AND `is_active` = 1";
    $subMenus = $this->db->query($querySubMenu)->result_array();

    // Looping Sub Menu
    foreach ($subMenus as $subMenu) :
    ?>
    <!-- Nav Item -->
    <li class="nav-item <?= ($title == $subMenu['title'] ? 'active' : ''); ?>">
        <a class="nav-link" href="<?= filter_output(base_url($subMenu['url'])); ?>">
            <i class="<?= filter_output($subMenu['icon']); ?>"></i>
            <span><?= filter_output($subMenu['title']); ?></span>
        </a>
    </li>
    <?php endforeach; ?>

<!-- Divider -->
<hr class="sidebar-divider">

<?php endforeach; ?>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->