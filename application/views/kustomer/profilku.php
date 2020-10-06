<section class="section bg-white">
	<div class="container-fluid">
		<div class="card card-product shadow mt--540">
			<div class="p-4">
				<div class="container">
					<?= $this->session->flashdata('pesan'); ?>
					<h2 class="text-center mb-4">Profilku</h2>
					<div class="row">
						<div class="col-12 col-md-3 text-center">
							<img src="<?= base_url('assets/img/api/kustomer/' . $kustomer['image']); ?>"
								alt="Raised circle image" class="rounded-circle shadow-lg"
								style="width: 200px; height: 200px; object-fit:cover;">
						</div>
						<div class="col">
							<h6 class="card-subtitle text-muted">Nama</h6>
							<p class="card-text"><?= $kustomer['nm_lengkap'] ?></p>
							<h6 class="card-subtitle text-muted">Email</h6>
							<p class="card-text"><?= $kustomer['email'] ?></p>
							<h6 class="card-subtitle text-muted">Telepon</h6>
							<p class="card-text"><?= $kustomer['telepon'] ?></p>
							<h6 class="card-subtitle text-muted">Alamat</h6>
							<p class="card-text"><?= $kustomer['alamat'] ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 mt-4 text-center">
							<a href="<?= base_url('kustomer/ubahprofil') ?>" class="btn btn-primary"><i
									class="fas fa-fw fa-edit mr-2"></i>Ubah Profil</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>