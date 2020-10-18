<?php use Carbon\Carbon; ?>
<section class="section bg-white">
	<div class="container-fluid">
        <div class="card card-product shadow mt--540">
			<div class="p-4">
				<!-- Tampilkan semua produk -->
				<div class="container">
					<?= $this->session->flashdata('pesan'); ?>
					<h2 class="text-center mb-4">Daftar Produk di Keranjangmu</h2>
					<form method="post" accept-charset="utf-8" action="<?= base_url('booking/simpankeranjang'); ?>">
						<?php if ( ! empty($booking_temp) ) : ?>
							<div class="row">
								<div class="col-12 col-lg-8">
									<?php 
									$total = 0;
									foreach ($booking_temp as $key => $bt) : 
									$produk = $this->Utama_model->getDatas('produk', ['id' => $bt['id_produk']])[0];
									?>
									<div class="card mb-3">
										<div class="row no-gutters">
											<div class="col-3 col-md-2 col-lg-2">
												<?php if ($produk['gambar'] == NULL) : ?>
													<img src="<?= base_url('assets/img/api/produk/noimage_content.jpg')?>" alt="Raised image" class="img-fluid rounded card-img" style="width: 100px;">
												<?php else : ?>
													<img src="<?= base_url('assets/img/api/produk/' . $produk['gambar'])?>" alt="Raised image" class="img-fluid rounded card-img" style="width: 100px;">
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
															$total += $produk['harga'];
															echo $crncy->formatCurrency($produk['harga'], "IDR");
														?>
														<button type="button" class="btn btn-sm btn-outline-danger fas fw fa-trash float-right"></button>
														<button type="button" class="btn btn-sm btn-outline-warning fas fw fa-edit float-right mr-1"></button>
													</p>
													<div class="row ml-0">
														<div class="col-sm-4 pl-0">
															<div class="input-group input-group-sm">
																<span class="input-group-prepend">
																	<button type="button" class="btn btn-outline-default btn-number fa fa-minus" <?= $bt['jumlah'] == 1 ? 'disabled="disabled"' : ''; ?> data-type="minus" data-field="quant[<?= $key; ?>]" data-harga="<?= $produk['harga'] ?>" data-oldval="<?= $bt['jumlah'] ?>">
																	</button>
																</span>
																<input type="text" name="quant[<?= $key; ?>]" class="form-control input-number text-center bg-white" value="<?= $bt['jumlah'] ?>" min="1" max="<?= $produk['stok']; ?>" data-oldval="<?= $bt['jumlah'] ?>" data-key="<?= $key; ?>" readonly>
																<span class="input-group-append">
																	<button type="button" class="btn btn-outline-primary btn-number fa fa-plus" data-type="plus" data-field="quant[<?= $key; ?>]" data-harga="<?= $produk['harga'] ?>" data-oldval="<?= $bt['jumlah'] ?>">
																	</button>
																</span>
															</div>
														</div>
													</div>
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
								<div class="col-lg-8">	
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text text-body bg-lighter" id="basic-addon1">Jumlah : </span>
										</div>
										<input id="harga" type="text" class="form-control text-body" value="<?= $booking_total_temp['total']; ?>" readonly>
									</div>
								</div>
							</div>
							<div class="row" id="button-booking">
								<div class="col-lg-4">
									<a href="#" type="submit" class="btn btn-success"><i class="fab fa-fw fa-whatsapp mr-2"></i>Minta Persetujuan Via Whatsapp (ANDROID)</a>
								</div>
								<div class="col-lg-4">
									<a href="#" type="submit" class="btn btn-success"><i class="fab fa-fw fa-whatsapp mr-2"></i>Minta Persetujuan Via Whatsapp (PC)</a>
								</div>
							</div>
						<?php else : ?>
							<p class="text-center" style="margin-bottom: 40%;">Keranjang Kamu Kosong</p>
						<?php endif; ?>
					</form>
				</div>  
			</div>
        </div>
	</div>
</section>