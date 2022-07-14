<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=""> <span class="logo-name">Marins Cake</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown <?php echo ($this->uri->segment(3) == 'dashboard') ? 'active' : '' ?>">
                <a href="<?php echo base_url() ?>kasir/kasir_page/dashboard" class="nav-link"><i data-feather="home"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Transaksi</li>
            <li class="dropdown <?php echo ($this->uri->segment(3) === 'langsung') ? 'active' : '' ?>">
                <a href="<?php echo base_url() ?>kasir/kasir_page/langsung" class="nav-link"><i data-feather="shopping-cart"></i><span>Transaksi Langsung</span></a>
            </li>
            <li class="dropdown <?php echo ($this->uri->segment(3) === 'preorder') ? 'active' : '' ?>">
                <a href="<?php echo base_url() ?>kasir/kasir_page/preorder" class="nav-link"><i data-feather="shopping-bag"></i><span>Transaksi Preorder</span></a>
            </li>
            <li class="menu-header">Pengaturan</li>
            <li class="dropdown <?php echo ($this->uri->segment(2) === 'akun') ? 'active' : '' ?>">
                <a href="<?php echo base_url() ?>kasir/akun" class="nav-link "><i data-feather="settings"></i><span>Pengaturan Akun</span></a>
            </li>
        </ul>
    </aside>
</div>