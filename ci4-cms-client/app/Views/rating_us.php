
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rating Tempat Wisata Desa Dayu</title>
    <!-- plugins:css -->

    <link rel="stylesheet" href="<?= base_url('cms/vendors/mdi/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('cms/vendors/css/vendor.bundle.base.css')?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url('cms/css/style.css')?>">
    <!-- End layout styles -->
    <!-- <link rel="shortcut icon" href="<?= base_url('cms/images/favicon.png')?>" /> -->
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto" id="opa">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Rating Us</h3>
                <form method="post" action="<?= base_url('home/input_rating') ?>" >
				  <div class="form-group">
					<label>Tempat Wisata Yang Baru Dikunjungi</label>
					 <select class="form-control" name="review_tempat">
					  	<option>---Pilih Disini---</option>
					  	<?php foreach($tempat as $b): ?>
              <option value="<?= $b['id_tempat'] ?>"><?= $b['nama_tempat'] ?></option>
              <?php endforeach;?>
					  </select>
				  </div>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="nama" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <textarea name="keterangan" class="form-control" id="editor" placeholder="Tuliskan Pengalaman Anda Disini"></textarea>
                  </div>
					<div class="form-group" id="rating">
            <label>Beri Bintang</label>
  						<input type="hidden" name="rating" id="rating_input">
						<div id="star_rating"></div>
					</div>
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn" value="review">Buat Review</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url('cms/vendors/js/vendor.bundle.base.js')?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url('cms/js/off-canvas.js')?>"></script>
    <script src="<?= base_url('cms/js/hoverable-collapse.js')?>"></script>
    <script src="<?= base_url('cms/js/misc.js')?>"></script>
    <script src="<?= base_url('cms/js/settings.js')?>"></script>
    <script src="<?= base_url('cms/js/todolist.js')?>"></script>
    <!-- endinject --> 
	  <script>
    function createStarRating() {
      const starRating = document.getElementById('star_rating');
      const maxStars = 5; // Jumlah maksimum bintang
      let selectedRating = 0; // Nilai rating yang dipilih

      for (let i = 1; i <= maxStars; i++) {
        const starIcon = document.createElement('i');
        starIcon.classList.add('mdi', 'mdi-star-outline');
        starIcon.dataset.rating = i;

        starIcon.addEventListener('click', function() {
          const rating = this.dataset.rating;

          const previousStars = Array.from(starRating.querySelectorAll('i'));
          previousStars.forEach(function(star) {
            star.classList.remove('mdi-star');
            star.classList.add('mdi-star-outline');
          });

          // Mengubah bintang yang diklik menjadi "mdi-star"
          const clickedStars = Array.from(starRating.querySelectorAll('i')).slice(0, rating);
          clickedStars.forEach(function(star) {
            star.classList.remove('mdi-star-outline');
            star.classList.add('mdi-star');
          });

          selectedRating = rating; // Mengupdate nilai rating yang dipilih
		  const ratingInput = document.getElementById('rating_input');
  		ratingInput.value = selectedRating;
          console.log('Rating:', selectedRating);
        });

        starRating.appendChild(starIcon);
      }
    }

    document.addEventListener('DOMContentLoaded', createStarRating);
  </script>



  </body>
</html>