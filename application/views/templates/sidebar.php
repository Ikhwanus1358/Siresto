    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
    <div class="sidebar-brand-icon">
    <i class="fas fa-store"></i></div>
    <div class="sidebar-brand-text mx-3">SI Resto </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Query Dari Menu -->
<?php
$role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`,`menu`
                    FROM `user_menu` JOIN `user_access_menu` 
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = '$role_id'
                    ORDER BY `user_access_menu`.`menu_id` ASC
                    ";

$menu = $this->db2->query($queryMenu)->result_array();
?>
<!-- Loop Nama Menu -->
    <?php foreach ($menu as $m) : ?>
<div class="sidebar-heading">  
    Menu
</div>

<!-- Sub Menu Sesuai Menu -->
<?php 
$menuId = $m['id'];
$querySubMenu = "SELECT *
                    FROM `user_sub_menu` JOIN `user_menu` 
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    WHERE `user_sub_menu`.`menu_id` = '$menuId'
                ";
$subMenu = $this->db2->query($querySubMenu)->result_array();
?>

        <?php foreach ($subMenu as $sm) : ?>
        <?php if($title == $sm['title']) : ?>
            <li class="nav-item active">
            <?php else : ?>
            <li class="nav-item">
        <?php endif; ?>
            <a class="nav-link" href="<?= base_url($sm['url']); ?>">
            <i class="<?= $sm['icon']; ?>"></i>
            <span><?= $sm['title']; ?></span></a>
            </li>
        <?php endforeach; ?>

<!-- Divider -->
<hr class="sidebar-divider">

<?php endforeach; ?>


<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<a href="<?= base_url('auth/logout'); ?>"  class="mr-2 btn btn-light mb-3" id="tombol-logout">Logout</a>
</div>

<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->