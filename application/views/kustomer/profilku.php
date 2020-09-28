<div class="container mt-5">
	<?= $this->session->flashdata('pesan'); ?>
	<!-- Data Kustomer -->
	<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-body">
					<h5 class="card-title">Profilku</h5>
					<div class="row">
						<div class="col-12 col-md-3 text-center">
							<img src="<?= base_url('assets/img/api/kustomer/' . $kustomer['image']); ?>" alt="Raised circle image" class="rounded-circle shadow-lg" style="width: 200px; height: 200px; object-fit:cover;">
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
							<a href="<?= base_url('kustomer/ubahprofil') ?>" class="btn btn-primary"><i class="fas fa-fw fa-edit mr-2"></i>Ubah Profil</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>