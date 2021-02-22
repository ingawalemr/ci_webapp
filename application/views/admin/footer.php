<!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong> &copy; 2020 <a href="http://mahadevr.co.in/">Admin</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>public/admin/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url() ?>public/admin/plugins/summernote/summernote-bs4.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote({
    	height: '300px'
    })
  })
</script>
</body>
</html>
