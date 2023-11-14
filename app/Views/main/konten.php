
<div class="content-wrapper">
			
<?php
                $alert = session()->getFlashdata('alert');
                $type = '';
                $message = ''; 
                if($alert){
                  $type = $alert['type_alert'];
                  $message = $alert['message'];
                }
                ?>
                <div class="alert alert-<?= $type ?> mb-2"><?= $message ?></div>
			<div class="row">
              
              <div class="col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Total Data Pengunjung Website</h4>
                    <canvas id="areaChart" style="height:1px;"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <i class="mdi mdi-eye mr-2"></i>
							            <h3 class="mb-0"><?= count($visitor) ?></h3>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Pengunjung Website</h6>
                  </div>
                </div>
              </div>
            </div>
			<!-- <div class="row">
			  <div class="col-md-6 grid-margin stretch-card mt-1">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Masukan Tempat Wisata</h4>
                    <p class="card-description">Masukan nama tempat dan foto wisata jika ada yang baru. </p>
					          <form class="form-inline" action=" // base_url('home/input_tempat'); ?>" method="post" enctype="multipart/form-data">
                      	<label class="sr-only" for="inlineFormInputName2">Name</label>
                      	<input type="text" name="nama_tempat" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Nama Tempat">
                        <input type="file" name="file_tmpt" class="form-control mb-2 mr-sm-2" placeholder="Input Foto wisata yang ingin ditambahkan"> 
                      	<button type="submit" name="submit" class="btn btn-primary mb-2" value="Submit">Submit</button>
                    </form>
                  </div>
                </div>
			  </div>
			  <div class="col-md-6 grid-margin stretch-card mt-1">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Daftar List Tempat Wisata</h4>
						<p class="card-description">berdasarkan tempat wisata yang sudah diinput</p>
						<select class="form-control">
                            <?php foreach($tempat as $b): ?>
                                <option value="<?= $b['id_tempat'] ?>"><?= $b['nama_tempat'] ?></option>
                            <?php endforeach;?>
						</select>
				    </div>  
				</div>
			  </div>
			</div> -->
			<div class="row" id="container">
			  <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Profil Desa</h4><hr>
                    <form class="forms-sample" action="<?= base_url('home/input_profil') ?>" method="post">
						<div class="mb-3">
							<textarea name="editor" id="editor" placeholder="Masukan Deskripsi Tentang Desa Anda Disini"></textarea>
						</div>
                      <button type="submit" name="submit" class="btn btn-primary mr-2" value="Submit">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
			  <div class="col-md-6 grid-margin stretch-card">
			  	<div class="card">
			  		<div class="card-body">
			  			<h4 class="card-title">Upload Foto Baru</h4>
              
			  			<p class="card-description"> <span style="color: yellow;"><i class="mdi mdi-alert"></i></span> Peringatan ! Foto yang anda upload akan menghapus foto yang ada</p>
			  			<hr>
			  			<form class="form-sample" enctype="multipart/form-data" method="post" action="<?= base_url('home/input_foto') ?>">
			  				<div class="form-group">
			  						<input type="file" id="image-input" class="form-control-file mb-2" name="gambar" onChange="previewImage(event)">
									<div class="text-center">
										<canvas class="img-fluid" id="image-preview"></canvas>
									</div>
			  				</div>
							<button type="submit" name="submit" class="btn btn-primary" value="Submit">Upload</button>
			  			</form>
			  		</div>
			  	</div>	
			  </div>
			</div>
			 <div class="row">
			 <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Foto</h4>
					  <p class="card-description"> Daftar foto yang ada di website </p>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Foto </th>
                            <th> Tanggal </th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            foreach($fotos as $b): 
                            if(!empty($b['nama_file'])){
                              $namafile = $b['nama_file'];
                              $tanggal = $b['date'];
                            } else {
                              $namafile = "null_object.jpg";
                              $tanggal = "Belum Upload Foto";
                            }
                            ?>
							            <tr>
							            	<td><?= $b['id_foto']?></td>
							            	<td><img src="<?= base_url('cms/images/foto_wisata/'.$namafile)?>" class="img-fluid" alt=""></td>
							            	<td><?= $tanggal ?></td>
							            </tr>
                            <?php 
                        
                        endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Aturan Upload Foto</h4>
                    <p class="card-description">Admin Wajib Mengikuti aturan upload foto berikut ini sebelum upload foto</p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <th>Urutan Foto</th>
                            <th>Ukuran Pixel x Pixel</th>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Foto Ke 1</td>
                              <td>1140px X 640px</td>
                            </tr>
                          <tbody>
                            <tr>
                              <td>Foto Ke 2</td>
                              <td>570px X 320px</td>
                            </tr>
                          <tbody>
                            <tr>
                              <td>Foto Ke 3</td>
                              <td>740px X 1340px</td>
                            </tr>
                          <tbody>
                            <tr>
                              <td>Foto Ke 4</td>
                              <td>370px X 320px</td>
                            </tr>
                          <tbody>
                            <tr>
                              <td>Foto Ke 5</td>
                              <td>370px X 325px</td>
                            </tr>
                          <tbody>
                            <tr>
                              <td>Foto Ke 6</td>
                              <td>1540px X 640px</td>
                            </tr>
                          </tbody>
                        </table>
            
                    </div>
                  </div>
                </div>
              </div>
                        
			 </div>
			 <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Form Harga Tiket</h4>
					 <form method="post" action="<?= base_url('home/input_tick'); ?>">
                    	<div class="form-group-lg">
                    	  <label>Tempat Wisata</label>
						  <p class="card-description">Silahkan Isi Tempat Wisata Yang ingin dirubah</p>
                    	  <select class="js-example-basic-multiple" name="tempat_tiket" style="width:100%">
                    	    <?php foreach($tempat as $b): ?>
                                <option value="<?= $b['id_tempat'] ?>"><?= $b['nama_tempat'] ?></option>
                            <?php endforeach;?>
                    	  </select>
                    	</div>
                    	<div class="form-group-lg mt-4">
                    	  <label>Hari</label>
						  <p class="card-description">Silahkan Isi Hari Yang ingin dirubah</p>
                    	  <select class="js-example-basic-multiple" name="hari_tiket" style="width:100%">
                    	    <?php foreach($hari as $a): ?>
                                <option value="<?= $a['id_hari'] ?>"><?= $a['days'] ?></option>
                            <?php endforeach; ?>
                    	  </select>
                    	</div>
						<div class="input-group mb-4 mr-sm-2 mt-sm-4">
                        	<div class="input-group-prepend">
                        	  <div class="input-group-text">Rp.</div>
                        	</div>
                        	<input type="text" name="tiket" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Masukan Harga Tiket Terbaru">
                      	</div>
						 <button type="submit" name="submit" class="btn btn-primary" value="Edit">Submit</button>
					  </form>
                  </div>
                </div>
              </div>
				<div class="col-md grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Daftar Harga Tiket</h4>
							<p class="card-description">List Harga berdasarkan data yang baru diinputkan</p>
							<div class="btn-group mb-4">
								<input type="button" class="btn btn-primary" name="jenis-data" onClick="jenisDataChange('cpc')" value="Puncak Cemoro Pitu">
								<input type="button" class="btn btn-primary" name="jenis-data" onClick="jenisDataChange('mp')" value="Museum Purbakala">
								<input type="button" class="btn btn-primary" name="jenis-data" onClick="jenisDataChange('se')" value="Sumur Emas">
								<input type="button" class="btn btn-primary" name="jenis-data" onClick="jenisDataChange('sa')" value="Sumur Api">
							</div>
							<div id="tiket-cpc" style="display: block;">
                              <p class="card-description">Harga Tiket Puncak Cemoro Pitu</p>
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          
                                          <th>Hari</th>
                                          <th>Harga Rp.</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php 
                                      
                                      $hari = "";
                                      foreach($harga as $a):
                                        switch($a['id_hari']):
                                            case 1:
                                                $hari = "Senin";
                                                break;
                                            case 2:
                                                $hari = "Selasa";
                                                break;
                                            case 3:
                                                $hari = "Rabu";
                                                break;
                                            case 4:
                                                $hari = "Kamis";
                                                break;
                                            case 5:
                                                $hari = "Jumat";
                                                break;
                                            case 6:
                                                $hari = "Sabtu";
                                                break;
                                            case 7:
                                                $hari = "Minggu";
                                                break;
                                            endswitch;
                                            // var_dump($a['id_tempat']);
                                        if($a['id_tempat'] == 1){?>
                                            <tr>
                                              
                                              <td><?= $hari; ?></td>
                                              <td>Rp. <?= $a['harga'] ?></td>  
                                            </tr>
                                      <?php
                                        }
                                      
                                        endforeach; ?>
                                  </tbody>
                              </table>
							</div>
							<div id="tiket-mp" style="display: none;">
                              <p class="card-description">Harga Tiket Museum Purbakala</p>
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          
                                          <th>Hari</th>
                                          <th>Harga Rp.</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php 
                                      
                                      $hari = "";
                                      foreach($harga as $a):
                                        switch($a['id_hari']):
                                            case 1:
                                                $hari = "Senin";
                                                break;
                                            case 2:
                                                $hari = "Selasa";
                                                break;
                                            case 3:
                                                $hari = "Rabu";
                                                break;
                                            case 4:
                                                $hari = "Kamis";
                                                break;
                                            case 5:
                                                $hari = "Jumat";
                                                break;
                                            case 6:
                                                $hari = "Sabtu";
                                                break;
                                            case 7:
                                                $hari = "Minggu";
                                                break;
                                            endswitch;
                                            // var_dump($a['id_tempat']);
                                        if($a['id_tempat'] == 2){?>
                                            <tr>
                                              
                                              <td><?= $hari; ?></td>
                                              <td>Rp. <?= $a['harga'] ?></td>  
                                            </tr>
                                      <?php
                                        }
                                      
                                        endforeach; ?>
                                  </tbody>
                              </table>
							</div>
							<div id="tiket-se" style="display: none;">
                              <p class="card-description">Harga Tiket Sumur Emas</p>
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          
                                          <th>Hari</th>
                                          <th>Harga Rp.</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php 
                                      
                                      $hari = "";
                                      foreach($harga as $a):
                                        switch($a['id_hari']):
                                            case 1:
                                                $hari = "Senin";
                                                break;
                                            case 2:
                                                $hari = "Selasa";
                                                break;
                                            case 3:
                                                $hari = "Rabu";
                                                break;
                                            case 4:
                                                $hari = "Kamis";
                                                break;
                                            case 5:
                                                $hari = "Jumat";
                                                break;
                                            case 6:
                                                $hari = "Sabtu";
                                                break;
                                            case 7:
                                                $hari = "Minggu";
                                                break;
                                            endswitch;
                                            // var_dump($a['id_tempat']);
                                        if($a['id_tempat'] == 3){?>
                                            <tr>
                                              
                                              <td><?= $hari; ?></td>
                                              <td>Rp. <?= $a['harga'] ?></td>  
                                            </tr>
                                      <?php
                                        }
                                      
                                        endforeach; ?>
                                  </tbody>
                              </table>
							</div>
							<div id="tiket-sa" style="display: none;">
                              <p class="card-description">Harga Tiket Sumur Api</p>
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          
                                          <th>Hari</th>
                                          <th>Harga Rp.</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php 
                                      
                                      $hari = "";
                                      foreach($harga as $a):
                                        switch($a['id_hari']):
                                            case 1:
                                                $hari = "Senin";
                                                break;
                                            case 2:
                                                $hari = "Selasa";
                                                break;
                                            case 3:
                                                $hari = "Rabu";
                                                break;
                                            case 4:
                                                $hari = "Kamis";
                                                break;
                                            case 5:
                                                $hari = "Jumat";
                                                break;
                                            case 6:
                                                $hari = "Sabtu";
                                                break;
                                            case 7:
                                                $hari = "Minggu";
                                                break;
                                            endswitch;
                                            // var_dump($a['id_tempat']);
                                        if($a['id_tempat'] == 4){?>
                                            <tr>
                                              
                                              <td><?= $hari; ?></td>
                                              <td>Rp. <?= $a['harga'] ?></td>  
                                            </tr>
                                      <?php
                                        }
                                      
                                        endforeach; ?>
                                  </tbody>
                              </table>
							</div>
						</div>
					</div>  
				</div>
			 </div>
			 <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Form Fasilitas</h4>
					 <form method="post" action="<?= base_url('home/input_fasilitas')?>">
                    	<div class="form-group-lg">
                    	  <label>Tempat Wisata</label>
						  <p class="card-description">Silahkan Isi Tempat Wisata Yang ingin dirubah</p>
                    	  <select name="tempat_fasilitas" class="js-example-basic-multiple" style="width:100%">
                            <?php foreach($tempat as $b): ?>
                                <option value="<?= $b['id_tempat'] ?>"><?= $b['nama_tempat'] ?></option>
                            <?php endforeach;?>
                    	  </select>
                    	</div>
						<input type="text" name="fasilitas" class="form-control mb-2 mt-2" placeholder="Masukan Fasilitas">
						 <button class="btn btn-primary">Submit</button>
					  </form>
                  </div>
                </div>
              </div>
				<div class="col-md grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Daftar Fasilitas</h4>
							<p class="card-description">List Fasilitas berdasarkan data yang baru diinputkan</p>
							<div class="btn-group mb-4">
								<button class="btn btn-primary" name="jenis-fasilitas" onClick="jenisFasilitasChange('cpc')">Puncak Cemoro Pintu</button>
								<button class="btn btn-primary" name="jenis-fasilitas" onClick="jenisFasilitasChange('mp')">Museum Purbakala</button>
								<button class="btn btn-primary" name="jenis-fasilitas" onClick="jenisFasilitasChange('se')">Sumur Emas</button>
								<button class="btn btn-primary" name="jenis-fasilitas" onClick="jenisFasilitasChange('sa')">Sumur Api</button>
							</div>
							<div id="fasilitas-cpc" style="display: block;">
                              <p class="card-description">Fasilitas Puncak Cemoro Pitu</p>
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          
                                          <th>Fasilitas</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php 
                                    
                                      foreach($fasili as $c): 
                                      if($c['id_tempat'] == 1){
                                      ?>
                                        <tr>
                                            
                                            <td><?= $c['fasilitas'] ?></td>
                                            <td><form action="<?= base_url('home/delete_fasilitas') ?>" method="post">
                                                  <button type="submit" name="id_fasilitas" class="btn btn-danger" value="<?= $c['id_fasilitas']?>"><i class="mdi mdi-trash-can"></i>Hapus</button>
                                            </form>
                                          </td>
                                        </tr>  
                                      <?php 
                                    
                                    }
                                    endforeach; ?>
                                  </tbody>

                              </table>
							</div>
							<div id="fasilitas-mp" style="display: none;">
                              <p class="card-description">Fasilitas Museum Purbakala</p>
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          
                                          <th>Fasilitas</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php 
                                    
                                      foreach($fasili as $c): 
                                      if($c['id_tempat'] == 2){
                                      ?>
                                        <tr>
                                            
                                            <td><?= $c['fasilitas'] ?></td>
                                            <td><form action="<?= base_url('home/delete_fasilitas') ?>" method="post">
                                                  <button type="submit" name="id_fasilitas" class="btn btn-danger" value="<?= $c['id_fasilitas']?>"><i class="mdi mdi-trash-can"></i>Hapus</button>
                                            </form>
                                          </td>
                                        </tr>  
                                      <?php 
                                    
                                    }
                                    endforeach; ?>
                                  </tbody>

                              </table>
							</div>
							<div id="fasilitas-se" style="display: none;">
                              <p class="card-description">Fasilitas Sumur Emas</p>
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          
                                          <th>Fasilitas</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php 
                                    
                                      foreach($fasili as $c): 
                                      if($c['id_tempat'] == 3){
                                      ?>
                                        <tr>
                                            
                                            <td><?= $c['fasilitas'] ?></td>
                                            <td><form action="<?= base_url('home/delete_fasilitas') ?>" method="post">
                                                  <button type="submit" name="id_fasilitas" class="btn btn-danger" value="<?= $c['id_fasilitas']?>"><i class="mdi mdi-trash-can"></i>Hapus</button>
                                            </form>
                                          </td>
                                        </tr>  
                                      <?php 
                                    
                                    }
                                    endforeach; ?>
                                  </tbody>

                              </table>
							</div>
							<div id="fasilitas-sa" style="display: none;">
                              <p class="card-description">Fasilitas Sumur Api</p>
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          
                                          <th>Fasilitas</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php 
                                    
                                      foreach($fasili as $c): 
                                      if($c['id_tempat'] == 4){
                                      ?>
                                        <tr>
                                            
                                            <td><?= $c['fasilitas'] ?></td>
                                            <td><form action="<?= base_url('home/delete_fasilitas') ?>" method="post">
                                                  <button type="submit" name="id_fasilitas" class="btn btn-danger" value="<?= $c['id_fasilitas']?>"><i class="mdi mdi-trash-can"></i>Hapus</button>
                                            </form>
                                          </td>
                                        </tr>  
                                      <?php 
                                    
                                    }
                                    endforeach; ?>
                                  </tbody>

                              </table>
							</div>
						</div>
					</div>  
				</div>
			 </div>
          </div>