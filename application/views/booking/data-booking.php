<?php use Carbon\Carbon; ?>
<section class="section bg-white">
	<div class="container-fluid">
        <div class="card card-product shadow mt--540">
          <div class="p-4">
			<!-- Tampilkan semua produk -->
			<div class="container">
			<?= $this->session->flashdata('pesan'); ?>
			<h2 class="text-center mb-4">Daftar Produk di Keranjangmu</h2>
					<div class="row">
						<div class="col-12 col-lg-7">
							<?php 
							
							foreach ($booking_temp as $bt) : 
								$thumbnail = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $bt['id_produk'], 'thumbnail' => 1]); 
								$produk = $this->Utama_model->getDatas('produks', ['id' => $bt['id_produk']])[0];
							?>
							<div class="card mb-3">
								<div class="row no-gutters">
									<div class="col-3 col-md-2 col-lg-2">
										<?php if (isset($thumbnail['status']) AND $thumbnail['status'] == FALSE) : ?>
										<img src="<?= base_url('assets/img/api/products/noimage_content.jpg')?>"
											alt="Raised image" class="img-fluid rounded card-img" style="width: 100px;">
										<?php else : ?>
										<img src="<?= base_url('assets/img/api/products/' . $thumbnail[0]['gambar'])?>"
											alt="Raised image" class="img-fluid rounded card-img" style="width: 100px;">
										<?php endif; ?>
									</div>
									<div class="col col-md col-lg">
										<div class="card-body pl-3 py-1 pr-2 pr-md-3">
											<p class="card-text mb-0 font-weight-bold"><?= $produk['nama'] ?></p>
											<p class="card-text mb-0 text-warning font-weight-bold">
												<?php 
													// Format harga ke IDR
													$crncy = new NumberFormatter( 'id_ID', NumberFormatter::CURRENCY );
													$crncy->setTextAttribute(NumberFormatter::CURRENCY_CODE, 'IDR');
													$crncy->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
													echo $crncy->formatCurrency($produk['harga'], "IDR");
												?>
												<button type="button" class="btn btn-sm btn-outline-danger fas fw fa-trash float-right"></button>
												<button type="button" class="btn btn-sm btn-outline-warning fas fw fa-edit float-right mr-1"></button>
											</p>
											<p class="card-text font-weight-bold">
												<?= Carbon::parse($bt['tgl_acara'])->locale('id_ID')->isoFormat('dddd, D MMMM Y'); ?>
											</p>
										</div>
									</div>
									<!-- <div class="col col-md col-lg align-self-center">
										<button type="button" class="btn btn-sm btn-outline-danger fas fw fa-trash"></button>
									</div> -->
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<a href="#" type="submit" class="btn btn-success"><i
								class="fab fa-fw fa-whatsapp mr-2"></i>Minta Persetujuan Via Whatsapp (ANDROID)</a>
						</div>
						<div class="col-lg-3">
							<a href="#" type="submit" class="btn btn-success"><i
								class="fab fa-fw fa-whatsapp mr-2"></i>Minta Persetujuan Via Whatsapp (PC)</a>
						</div>
					</div>
			</div>  
          </div>
        </div>
	</div>
</section>