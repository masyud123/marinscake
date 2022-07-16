<li class="dropdown dropdown-list-toggle">
  <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle">
    <i class="fas fa-bell text-dark"></i>
    <span class="badge headerBadge1"><?= count($notif) ?></span>
  </a>
  <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
    <div class="dropdown-header">
      Notifikasi
      <div class="float-right">
        <?php if (count($notif) > 0) : ?>
          <a href="<?= base_url() ?>admin/Dashboard/baca_semua_notif">Tandai terbaca semua</a>
        <?php endif ?>
      </div>
    </div>
    <div class="dropdown-list-content dropdown-list-message">
      <?php foreach ($notif as $woi) :
        $awal  = date_create($woi['waktu']);
        $akhir = date_create();
        $diff  = date_diff($awal, $akhir);

        if ($diff->y != null) {
          $time = $diff->y . ' tahun ';
        } elseif ($diff->m != null) {
          $time = $diff->m . ' bulan ';
        } elseif ($diff->d != null) {
          $time = $diff->d . ' hari ';
        } elseif ($diff->h != null) {
          $time = $diff->h . ' jam ';
        } elseif ($diff->i != null) {
          $time = $diff->i . ' menit ';
        } else {
          $time = $diff->s . ' detik ';
        } ?>
        <a href="<?= base_url() ?>admin/transaksi/<?= $woi['keterangan'] == 'booking' ? 'booking' : 'preorder' ?>/<?= date('Y-m') ?>" class="dropdown-item">
          <span class="dropdown-item-avatar text-white">
            <img alt="image" src="<?= base_url() ?>assets/img/cart.png" class="rounded">
          </span> <span class="dropdown-item-desc"> <span class="message-user"><?= $woi['keterangan'] == 'booking' ? 'Booking' : 'Preorder' ?></span>
            <span class="time messege-text"><?= $woi['pesan'] ?></span>
            <span class="time"><?= $time ?> yang lalu</span>
          </span>
        </a>
      <?php endforeach ?>
    </div>
    <div class="dropdown-footer text-center">
      <!-- <a href="#">View All <i class="fas fa-chevron-right"></i></a> -->
    </div>
  </div>
</li>