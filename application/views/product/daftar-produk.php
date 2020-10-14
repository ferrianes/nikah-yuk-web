<section class="section bg-white">
	<div class="container-fluid">
        <div class="card card-product shadow mt--540">
			<div class="p-4">
				<!-- Tampilkan semua produk -->
				<div class="container">
					<?= $this->session->flashdata('pesan'); ?>
					<h2 class="text-center mb-4">Daftar Produk</h2>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<?= $breadcrumb; ?>
						</ol>
					</nav>
					<?php if (isset($produk)) : ?>
						<div class="row">
							<?php foreach ($produk as $p) : ?>
								<div class="col-md-3 mb-3 d-flex">
									<div class="card shadow flex-fill">
										<?php if ($p['gambar'] == NULL) : ?>
										<img src="<?php echo base_url('assets/img/api/produk/noimage_content.jpg')?>" class="card-img-top">
										<?php else : ?>
										<img src="<?php echo base_url('assets/img/api/produk/' . $p['gambar'])?>" class="card-img-top">
										<?php endif; ?>
										<div class="card-body pt-2">
											<h5 class="card-title text-dark mb-0 clamp-2"><?= filter_output($p['nama']); ?></h5>
											<small class="text-muted"><?= $p['kategori'] ?></small>
											<p class="card-text mb-1 text-warning font-weight-bold">
												<?php 
												// Format harga ke IDR
												$crncy = new NumberFormatter( 'id_ID', NumberFormatter::CURRENCY );
												$crncy->setTextAttribute(NumberFormatter::CURRENCY_CODE, 'IDR');
												$crncy->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
												echo $crncy->formatCurrency($p['harga'], "IDR");
												?>
											</p>
											<div class="d-flex flex-row justify-content-start">
												<?php if (filter_output($p['stok']) < 1 ) : ?>
												<i class='btn btn-sm btn-outline-primary fas fw fa-shopping-cart text-nowrap'> Booking
													0</i>
												<?php else : ?>
												<a class='btn btn-sm btn-outline-primary fas fw fa-shopping-cart text-nowrap'
													href='<?= base_url('booking/tambahBooking/' . $p['id']); ?>'> Booking</a>
												<?php endif; ?>
												<a href="<?= base_url('home/detailProduct/'.$p['id']); ?>"
													class="btn btn-sm btn-outline-success fas fw fa-search text-nowrap"> Detail</a>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<?= $pagination; ?>
					<?php else : ?>
						<p class="text-center" style="margin-bottom: 40%;">Produk Kosong</p>
					<?php endif; ?>
				</div>  
			</div>
        </div>
	</div>
</section>