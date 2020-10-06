<section class="section bg-white">
	<div class="container-fluid">
		<div class="card card-product shadow mt--540">
			<div class="p-4">
				<div class="container">
					<?= $this->session->flashdata('pesan'); ?>
					<h2 class="text-center mb-4">Edit Profil</h2>
					<form action="<?= base_url('kustomer/ubahprofil') ?>" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-12 col-md-4 col-lg-3 text-center">
								<label for="ubah-gambar">
									<div class="img_wrap">
										<img src="<?= base_url('assets/img/api/kustomer/' . $kustomer['image']); ?>"
											alt="Raised circle image" class="rounded-circle shadow-lg"
											style="width: 200px; height: 200px; object-fit:cover;" id="ubah-target">
										<p
											class="img_description d-flex align-items-center justify-content-center cursor-pointer">
											Ubah Foto</p>
									</div>
								</label>
								<input id="ubah-gambar" type="file"
									accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" class="d-none"
									name="foto-profil">
							</div>
							<div class="col">
								<div class="form-group mb-3 <?= form_error('nama') ? 'has-danger' : '' ?>">
									<div class="input-group input-group-alternative">
										<div class="input-group-prepend">
											<span
												class="input-group-text <?= form_error('nama') ? 'text-warning' : '' ?>""><i class="
												ni ni-circle-08"></i></span>
										</div>
										<input class="form-control" value="<?= $kustomer['nm_lengkap'] ?>" name="nama"
											type="text">
									</div>
									<?= form_error('nama', '<small class="form-text text-warning">', '</small>'); ?>
								</div>
								<div class="form-group mb-3 <?= form_error('email') ? 'has-danger' : '' ?>">
									<div class="input-group input-group-alternative">
										<div class="input-group-prepend">
											<span
												class="input-group-text disabled <?= form_error('email') ? 'text-warning' : '' ?>"><i
													class="ni ni-email-83"></i></span>
										</div>
										<input class="form-control" value="<?= $kustomer['email'] ?>" name="email"
											type="email" readonly>
									</div>
									<?= form_error('email', '<small class="form-text text-warning">', '</small>'); ?>
								</div>
								<div class="form-group mb-3 <?= form_error('telepon') ? 'has-danger' : '' ?>">
									<div class="input-group input-group-alternative">
										<div class="input-group-prepend">
											<span
												class="input-group-text <?= form_error('telepon') ? 'text-warning' : '' ?>"><i
													class="fa fa-tty"></i></span>
										</div>
										<input class="form-control" value="<?= $kustomer['telepon']; ?>" name="telepon"
											type="text">
									</div>
									<?= form_error('telepon', '<small class="form-text text-warning">', '</small>'); ?>
								</div>
								<div class="form-group mb-3 <?= form_error('alamat') ? 'has-danger' : '' ?>">
									<div class="input-group input-group-alternative">
										<div class="input-group-prepend">
											<span
												class="input-group-text <?= form_error('alamat') ? 'text-warning' : '' ?>"><i
													class="fa fa-map-marker-alt"></i></span>
										</div>
										<textarea class="form-control" name="alamat"
											placeholder="Alamat"><?= $kustomer['alamat'] ?></textarea>
									</div>
									<?= form_error('alamat', '<small class="form-text text-warning">', '</small>'); ?>
								</div>
								<div class="form-group <?= form_error('password') ? 'has-danger' : '' ?>">
									<div class="input-group input-group-alternative">
										<div class="input-group-prepend">
											<span
												class="input-group-text <?= form_error('password') ? 'text-warning' : '' ?>"><i
													class="ni ni-lock-circle-open"></i></span>
										</div>
										<input class="form-control" placeholder="Masukan Password Untuk Mengubah Profil"
											name="password" type="password">
									</div>
									<?= form_error('password', '<small class="form-text text-warning">', '</small>'); ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-lg-3 mt-4 text-center">
								<button class="btn btn-primary" type="submit"><i
										class="fas fa-fw fa-save mr-2"></i>Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>