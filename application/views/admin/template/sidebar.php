<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=""><span class="logo-name">Marins Cake</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown <?php echo ($this->uri->segment(2) == '') ? 'active' : '' ?>">
                <a href="<?php echo base_url() ?>admin" class="nav-link"><i data-feather="home"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown <?php echo ($this->uri->segment(2) === 'produk') ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="package"></i><span>Produk</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/produk/kategori">Kategori Produk</a></li>
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/produk">Produk</a></li>
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/produk/tambah_produk">Tambah Produk</a></li>
                </ul>
            </li>
            <li class="dropdown <?php echo ($this->uri->segment(2) === 'transaksi') ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-cart"></i><span>Transaksi</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/transaksi/langsung/<?= date('Y-m') ?>">Transaksi Langsung</a></li>
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/transaksi/preorder/<?= date('Y-m') ?>">Transaksi Preorder</a></li>
                </ul>
            </li>
            <li class="menu-header">Laporan</li>
            <li class="dropdown <?php echo ($this->uri->segment(2) === 'karyawan') ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>Karyawan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/karyawan">Daftar Karyawan</a></li>
                </ul>
            </li>
            <li class="dropdown <?php echo ($this->uri->segment(2) === 'laporan' || $this->uri->segment(2) === 'modal') ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/modal/pengeluaran_modal/<?= date('Y-m') ?>">Laporan Pengeluaran</a></li>
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/laporan/laporan_gaji/<?= date('Y-m') ?>">Laporan Gaji</a></li>
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/laporan/laporan_penjualan/<?= date('Y-m') ?>">Laporan Penjualan</a></li>
                    <li><a class="nav-link" href="<?php echo base_url() ?>admin/laporan/laporan_keuntungan/<?= date('Y-m') ?>">Laporan Keuntungan</a></li>
                </ul>
            </li>
            <li class="menu-header">Lainnya</li>
            <li class="dropdown <?php echo ($this->uri->segment(2) == 'user' || $this->uri->segment(2) == 'pengiriman' || $this->uri->segment(2) == 'slider') ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="settings"></i><span>Pengaturan</span></a>
                <ul class="dropdown-menu">
                    <li> <a href="<?php echo base_url() ?>admin/user" class="nav-link "><i data-feather="user"></i><span>Pengaturan User</span></a></li>
                    <li> <a href="<?php echo base_url() ?>admin/pengiriman" class="nav-link "><i data-feather="truck"></i><span>Pengiriman</span></a></li>
                    <li> <a href="<?php echo base_url() ?>admin/slider" class="nav-link "><i data-feather="airplay"></i><span>Slider</span></a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>