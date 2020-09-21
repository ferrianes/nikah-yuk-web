<div class="container mt-5">
	<!-- Tampilkan semua produk -->
	<div class="row">
		<?php 
		// Looping Products
		foreach ($products as $p) : 

		$thumbnail = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $p['id'], 'thumbnail' => 1]); 
		?>
		<div class="col-md-3 mb-3 d-flex">
			<div class="card shadow flex-fill">
				<?php if (isset($thumbnail['status']) AND $thumbnail['status'] == FALSE) : ?>
				<img src="<?php echo base_url('assets/img/api/products/noimage_content.jpg')?>" class="card-img-top">
				<?php else : ?>
				<img src="<?php echo base_url('assets/img/api/products/' . $thumbnail[0]['gambar'])?>"
					class="card-img-top">
				<?php endif; ?>
				<div class="card-body pt-2">
					<h5 class="card-title text-dark mb-0 clamp-2"><?= filter_output($p['nama']); ?></h5>
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
						<i class='btn btn-sm btn-outline-primary fas fw fa-shopping-cart'> Booking 0</i>
						<?php else : ?>
						<!-- <div class="col-6 pr-1 text-nowrap"> -->
						<a class='btn btn-sm btn-outline-primary fas fw fa-shopping-cart text-nowrap'
							href='<?= base_url('booking/tambahBooking/' . $p['id']); ?>'> Booking</a>
						<!-- </div> -->
						<?php endif; ?>
						<!-- <div class="col-6 pl-1 text-nowrap"> -->
						<a href="<?= base_url('home/detailProduct/'.$p['id']); ?>"
							class="btn btn-sm btn-outline-success fas fw fa-search text-nowrap"> Detail</a>
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>