

  <!-- login modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
  		<div class="modal-content">
  			<div class="modal-body p-0">
  				<div class="card bg-secondary shadow border-0 mb-0">
  					<div class="card-body px-lg-5 py-lg-5">
  						<div class="text-center text-muted mb-2">
  							<small>Hi, Silahkan Login</small>
  						</div>
  						<div class="text-center mb-3">
  							<img width="64" height="64" src="<?= base_url('assets/img/app/login.svg') ?>">
  						</div>
  						<form role="form" method="post" action="<?= base_url('kustomer'); ?>">
  							<div class="form-group mb-3">
  								<div class="input-group input-group-alternative">
  									<div class="input-group-prepend">
  										<span class="input-group-text"><i class="ni ni-email-83"></i></span>
  									</div>
  									<input class="form-control" placeholder="Email" name="email" type="email">
  								</div>
  							</div>
  							<div class="form-group">
  								<div class="input-group input-group-alternative">
  									<div class="input-group-prepend">
  										<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
  									</div>
  									<input class="form-control" placeholder="Password" name="password"
  										type="password">
  								</div>
  							</div>
  							<!-- <div class="custom-control custom-control-alternative custom-checkbox">
                          <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                          <label class="custom-control-label" for=" customCheckLogin">
                            <span>Remember me</span>
                          </label>
                        </div> -->
  							<div class="text-center">
  								<button type="submit" class="btn btn-primary my-4">Login</button>
  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>
  <!--/login modal -->

  <!-- daftar modal -->
  <div class="modal fade" id="daftarModal" tabindex="-1" role="dialog" aria-labelledby="daftarModal" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
  		<div class="modal-content">
  			<div class="modal-body p-0">
  				<div class="card bg-secondary shadow border-0 mb-0">
  					<div class="card-body px-lg-5 py-lg-5">
  						<div class="text-center text-muted mb-2">
  							<small>Hi, Silahkan Register</small>
  						</div>
  						<div class="text-center mb-3">
							<img width="64" height="64" src="<?= base_url('assets/img/app/escalator-up.svg') ?>">
  						</div>
  						<form role="form" method="post" action="<?= base_url('kustomer/register'); ?>">
  							<div class="form-group mb-3 <?= form_error('email') ? 'has-danger' : '' ?>">
  								<div class="input-group input-group-alternative">
  									<div class="input-group-prepend">
  										<span class="input-group-text <?= form_error('email') ? 'text-warning' : '' ?>"><i class="ni ni-email-83"></i></span>
  									</div>
  									<input class="form-control" placeholder="Email" name="email" type="email">
  								</div>
								<?= form_error('email', '<small class="form-text text-warning">', '</small>'); ?>
  							</div>
							<div class="form-group mb-3 <?= form_error('nama') ? 'has-danger' : '' ?>">
  								<div class="input-group input-group-alternative">
  									<div class="input-group-prepend">
  										<span class="input-group-text <?= form_error('nama') ? 'text-warning' : '' ?>""><i class="ni ni-circle-08"></i></span>
  									</div>
  									<input class="form-control" placeholder="Nama Lengkap" name="nama" type="text">
  								</div>
								<?= form_error('nama', '<small class="form-text text-warning">', '</small>'); ?>
  							</div>
							<div class="form-group mb-3 <?= form_error('alamat') ? 'has-danger' : '' ?>">
  								<div class="input-group input-group-alternative">
  									<div class="input-group-prepend">
  										<span class="input-group-text <?= form_error('alamat') ? 'text-warning' : '' ?>"><i class="fa fa-map-marker-alt"></i></span>
  									</div>
  									<textarea class="form-control" name="alamat" placeholder="Alamat"></textarea>
  								</div>
								<?= form_error('alamat', '<small class="form-text text-warning">', '</small>'); ?>
  							</div>
							<div class="form-group mb-3 <?= form_error('telepon') ? 'has-danger' : '' ?>">
  								<div class="input-group input-group-alternative">
  									<div class="input-group-prepend">
  										<span class="input-group-text <?= form_error('telepon') ? 'text-warning' : '' ?>"><i class="fa fa-tty"></i></span>
  									</div>
  									<input class="form-control" placeholder="No. Telepon" name="telepon" type="text">
  								</div>
								<?= form_error('telepon', '<small class="form-text text-warning">', '</small>'); ?>
  							</div>
  							<div class="form-group <?= form_error('password1') ? 'has-danger' : '' ?>">
  								<div class="input-group input-group-alternative">
  									<div class="input-group-prepend">
  										<span class="input-group-text <?= form_error('password1') ? 'text-warning' : '' ?>"><i class="ni ni-lock-circle-open"></i></span>
  									</div>
  									<input class="form-control" placeholder="Password" name="password1"
  										type="password">
  								</div>
								<?= form_error('password1', '<small class="form-text text-warning">', '</small>'); ?>
  							</div>
							<div class="form-group <?= form_error('password2') ? 'has-danger' : '' ?>">
  								<div class="input-group input-group-alternative">
  									<div class="input-group-prepend">
  										<span class="input-group-text <?= form_error('password2') ? 'text-warning' : '' ?>"><i class="ni ni-lock-circle-open"></i></span>
  									</div>
  									<input class="form-control" placeholder="Ulangi Password" name="password2"
  										type="password">
  								</div>
								<?= form_error('password2', '<small class="form-text text-warning">', '</small>'); ?>
  							</div>
  							<!-- <div class="custom-control custom-control-alternative custom-checkbox">
                          <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                          <label class="custom-control-label" for=" customCheckLogin">
                            <span>Remember me</span>
                          </label>
                        </div> -->
  							<div class="text-center">
								<button type="button" class="btn btn-link text-dark" data-dismiss="modal">Close</button>
  								<button type="submit" class="btn btn-primary my-4">Login</button>
  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>
  <!--/end of Modal Daftar -->

  <!-- Logout Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
  	<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
  		<div class="modal-content bg-gradient-danger">
  			<div class="modal-header">
  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  					<span aria-hidden="true">×</span>
  				</button>
  			</div>
  			<div class="modal-body">
  				<div class="py-3 text-center">
  					<i class="ni ni-bell-55 ni-3x"></i>
  					<h4 class="heading mt-4">Kamu yakin untuk logout?</h4>
  				</div>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-link text-white" data-dismiss="modal">Close</button>
  				<a class="btn btn-white ml-auto" href="<?= base_url('kustomer/logout') ?>">Logout</a>
  			</div>
  		</div>
  	</div>
  </div>
  <!-- /end logout modal -->

  <!-- modal info-->
  <div class="modal fade" tabindex="-1" id="modal-info" role="dialog">
  	<div class="modal-dialog" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title">Informasi</h5>
  				<button type="button" class="close" data-dismiss="modal" arialabel="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
  			</div>

  			<div class="modal-body">
  				<span class="alert alert-message alert-success">Waktu Pengambilan Buku 1x24 jam dari
  					Booking!!!</span>
  			</div>

  			<div class="modal-footer">
  				<a class="btn btn-outline-info" href="<?= base_url(); ?>">Ok</a>
  			</div>
  		</div>
  	</div>
  </div>
  <!--/modal info -->