<div class="container mt-5">
	<?= $this->session->flashdata('pesan'); ?>
	<!-- Data Kustomer -->
	<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-body">
					<h5 class="card-title">Daftar Produk di Keranjangmu</h5>
					<div class="row">
						<div class="col-12 col-md-6">
							<?php 
							
							foreach ($booking_temp as $bt) : 
								$thumbnail = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $bt['id_produk'], 'thumbnail' => 1]); 
								$produk = $this->Utama_model->getDatas('produks', ['id' => $bt['id_produk']])[0];
							?>
							<div class="card mb-3" style="max-width: 540px;">
								<div class="row no-gutters">
									<div class="col-3 col-md-4 col-lg-3">
										<?php if (isset($thumbnail['status']) AND $thumbnail['status'] == FALSE) : ?>
										<img src="<?= base_url('assets/img/api/products/noimage_content.jpg')?>"
											alt="Raised image" class="img-fluid rounded card-img" style="width: 100px;">
										<?php else : ?>
										<img src="<?= base_url('assets/img/api/products/' . $thumbnail[0]['gambar'])?>"
											alt="Raised image" class="img-fluid rounded card-img" style="width: 100px;">
										<?php endif; ?>
									</div>
									<div class="col-9 col-md-8">
										<div class="card-body p-1">
											<p class="card-text mb-0 font-weight-bold"><?= $produk['nama'] ?></p>
											<p class="card-text mb-0 text-warning font-weight-bold">
												<?php 
														// Format harga ke IDR
														$crncy = new NumberFormatter( 'id_ID', NumberFormatter::CURRENCY );
														$crncy->setTextAttribute(NumberFormatter::CURRENCY_CODE, 'IDR');
														$crncy->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
														echo $crncy->formatCurrency($produk['harga'], "IDR");
													?>
											</p>
											<?php $tgl_acara = new DateTime($bt['tgl_acara']); ?>
											<p class="card-text font-weight-bold">Tanggal acara : <?= $tgl_acara->format('F d, Y') ?></p>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<form action="<?= base_url('booking/tambahBooking/' . $produk['id']); ?>" method="post">
						<?php if (form_error('tgl_acara')) : ?>
						<div class="form-group tgl-acara has-danger">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text border border-warning rounded-left border-right-0"><i
											class="ni ni-calendar-grid-58 text-warning"></i></span>
								</div>
								<input class="flatpickr flatpickr-input form-control is-invalid" name="tgl_acara"
									type="text" placeholder="<?= form_error('tgl_acara', NULL, NULL) ?>">
							</div>
						</div>
						<?php else : ?>
						<div class="form-group tgl-acara">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
								</div>
								<input class="flatpickr flatpickr-input form-control" name="tgl_acara" type="text"
									placeholder="Pilih tanggal..">
							</div>
						</div>
						<?php endif; ?>
						<div class="row">
							<div class="col">
								<button type="submit" class="btn btn-primary"><i
										class="fas fa-fw fa-cart-plus mr-2"></i>Tambah ke Keranjang</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>