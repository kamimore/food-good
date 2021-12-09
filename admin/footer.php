
</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
      Copyright © 2018 <a href="javascript:void(0)" target="_blank">Vayuananda</a>. All rights Not reserved.</span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<!-- container-scroller -->

<!-- plugins:js -->
<script src="<?php echo admin_path; ?>assets/js/vendor.bundle.base.js"></script>
<script src="<?php echo admin_path; ?>assets/js/jquery.dataTables.js"></script>
<script src="<?php echo admin_path; ?>assets/js/dataTables.bootstrap4.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?php echo admin_path; ?>assets/js/Chart.min.js"></script>
<script src="<?php echo admin_path; ?>assets/js/bootstrap-datepicker.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?php echo admin_path; ?>assets/js/off-canvas.js"></script>
<script src="<?php echo admin_path; ?>assets/js/hoverable-collapse.js"></script>
<script src="<?php echo admin_path; ?>assets/js/template.js"></script>
<script src="<?php echo admin_path; ?>assets/js/settings.js"></script>
<script src="<?php echo admin_path; ?>assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?php echo admin_path; ?>assets/js/dashboard.js"></script>
<script src="<?php echo admin_path; ?>assets/js/data-table.js"></script>
<!-- End custom js for this page-->
<script type="text/javascript">
//  console.log("hello");
  var title=location.pathname.split('/');
  var titlename=title[title.length-1];
      titlename=titlename.toUpperCase();
  //console.log(titlename);
  $(".booktitle").html(titlename);



//  console.log(title[title.length-1]);
</script>
</body>
</html>
