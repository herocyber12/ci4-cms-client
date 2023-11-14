<?php
session()->start();
if(empty(session()->get('Nama'))){
   route_to('login');
}
// var_dump(session()->get('Nama'));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Desa Dayu Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('cms/vendors/mdi/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('cms/vendors/css/vendor.bundle.base.css')?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('cms/vendors/jvectormap/jquery-jvectormap.css')?>">
    <link rel="stylesheet" href="<?= base_url('cms/vendors/flag-icon-css/css/flag-icon.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('cms/vendors/owl-carousel-2/owl.carousel.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('cms/vendors/owl-carousel-2/owl.theme.default.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('cms/vendors/select2/select2.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('cms/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url('cms/css/style.css')?>">
    <!-- End layout styles -->
	
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <link rel="shortcut icon" href="<?= base_url('cms/images/favicon.png')?>" />
  </head>
  <body>
    <div class="container-scroller">
      <?= $this->include('partials/sidebar')?>
      <div class="container-fluid page-body-wrapper">
        <?= $this->include('partials/navbar') ?>
        <div class="main-panel">
          <?= $this->include('main/konten')?>
          <?= $this->include('partials/footer')?>
        </div>
        
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url('cms/vendors/js/vendor.bundle.base.js')?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url('cms/vendors/select2/select2.min.js')?>"></script>
    <script src="<?= base_url('cms/vendors/typeahead.js/typeahead.bundle.min.js')?>"></script>
    <script src="<?= base_url('cms/vendors/chart.js/Chart.min.js')?>"></script>
    <script src="<?= base_url('cms/vendors/progressbar.js/progressbar.min.js')?>"></script>
    <script src="<?= base_url('cms/vendors/jvectormap/jquery-jvectormap.min.js')?>"></script>
    <script src="<?= base_url('cms/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
    <script src="<?= base_url('cms/vendors/owl-carousel-2/owl.carousel.min.js')?>"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url('cms/js/off-canvas.js')?>"></script>
    <script src="<?= base_url('cms/js/hoverable-collapse.js')?>"></script>
    <script src="<?= base_url('cms/js/misc.js')?>"></script>
    <script src="<?= base_url('cms/js/settings.js')?>"></script>
    <script src="<?= base_url('cms/js/todolist.js')?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?= base_url('cms/js/file-upload.js')?>"></script>
    <script src="<?= base_url('cms/js/typeahead.js')?>"></script>
    <script src="<?= base_url('cms/js/select2.js')?>"></script>
    <script src="<?= base_url('cms/js/chart.js')?>"></script>
    <script src="<?= base_url('cms/js/dashboard.js')?>"></script>
    <!-- End custom js for this page -->
	  
	 <script>
	 	function jenisDataChange(jenisData) {
            if (jenisData === "cpc") {
              document.getElementById("tiket-cpc").style.display = "block";
              document.getElementById("tiket-mp").style.display = "none";
              document.getElementById("tiket-se").style.display = "none";
              document.getElementById("tiket-sa").style.display = "none";
            } else if (jenisData === "mp") {
              document.getElementById("tiket-cpc").style.display = "none";
              document.getElementById("tiket-mp").style.display = "block";
              document.getElementById("tiket-se").style.display = "none";
              document.getElementById("tiket-sa").style.display = "none";
            } else if (jenisData === "se") {
              document.getElementById("tiket-cpc").style.display = "none";
              document.getElementById("tiket-mp").style.display = "none";
              document.getElementById("tiket-se").style.display = "block";
              document.getElementById("tiket-sa").style.display = "none";
            } else if (jenisData === "sa") {
              document.getElementById("tiket-cpc").style.display = "none";
              document.getElementById("tiket-mp").style.display = "none";
              document.getElementById("tiket-se").style.display = "none";
              document.getElementById("tiket-sa").style.display = "block";
            }
          } 
	 	function jenisFasilitasChange(jenisData) {
            if (jenisData === "cpc") {
              document.getElementById("fasilitas-cpc").style.display = "block";
              document.getElementById("fasilitas-mp").style.display = "none";
              document.getElementById("fasilitas-se").style.display = "none";
              document.getElementById("fasilitas-sa").style.display = "none";
            } else if (jenisData === "mp") {
              document.getElementById("fasilitas-cpc").style.display = "none";
              document.getElementById("fasilitas-mp").style.display = "block";
              document.getElementById("fasilitas-se").style.display = "none";
              document.getElementById("fasilitas-sa").style.display = "none";
            } else if (jenisData === "se") {
              document.getElementById("fasilitas-cpc").style.display = "none";
              document.getElementById("fasilitas-mp").style.display = "none";
              document.getElementById("fasilitas-se").style.display = "block";
              document.getElementById("fasilitas-sa").style.display = "none";
            } else if (jenisData === "sa") {
              document.getElementById("fasilitas-cpc").style.display = "none";
              document.getElementById("fasilitas-mp").style.display = "none";
              document.getElementById("fasilitas-se").style.display = "none";
              document.getElementById("fasilitas-sa").style.display = "block";
            }
          } 
		 function previewImage(event){
			 var input = event.target;
  var canvas = document.getElementById("image-preview");
  var context = canvas.getContext("2d");

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var img = new Image();
      img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        context.drawImage(img, 0, 0);
      };
      img.src = e.target.result;
    };

    reader.readAsDataURL(input.files[0]);
  }
		 }

     var chartData = <?= json_encode($chartdata) ?>

    //  console.log();
	 </script>
  </body>
</html>