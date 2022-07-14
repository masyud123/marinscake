<!-- <footer class="main-footer">
  <div class="footer-left">
    <a href="templateshub.net">Templateshub</a></a>
  </div>
  <div class="footer-right">
  </div>
</footer>
</div>
</div> -->
<!-- General JS Scripts -->


<script src="<?= base_url() ?>assets/js/app.min.js"></script>

<script src="<?= base_url() ?>assets/bundles/datatables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>

<!-- Page Specific JS File -->
<script src="<?= base_url() ?>assets/js/page/datatables.js"></script>
  <script src="<?=base_url('assets/bundles/sweetalert/sweetalert.min.js')?>"></script>
  <!-- Page Specific JS File -->
  <script src="<?=base_url('assets/js/page/sweetalert.js')?>"></script>
<!-- JS Libraies -->
<script src="<?= base_url() ?>assets/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Page Specific JS File -->
<script src="<?= base_url() ?>assets/js/page/index.js"></script>
<!-- Template JS File -->
<script src="<?= base_url() ?>assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="<?= base_url() ?>assets/js/custom.js"></script>

<script src="<?= base_url() ?>assets/bundles/select2/dist/js/select2.full.min.js"></script>

<script src="<?= base_url() ?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>

<script type="text/javascript">
  $(function() {
    $(document).on('click', '.btn-add', function(e) {
      e.preventDefault();

      var dynaForm = $('.dynamic-wrap'),
        currentEntry = $(this).parents('.entry:first'),
        newEntry = $(currentEntry.clone()).appendTo(dynaForm);

      newEntry.find('input').val('');
      dynaForm.find('.entry:not(:last) .btn-add')
        .removeClass('btn-add').addClass('btn-remove')
        .removeClass('btn-success').addClass('btn-danger')
        .html('<span class="fas fa-minus"></span>');
    }).on('click', '.btn-remove', function(e) {
      $(this).parents('.entry:first').remove();

      e.preventDefault();
      return false;
    });
  });
</script>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>