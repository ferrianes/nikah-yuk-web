<?php use Carbon\Carbon; ?>
<section class="section bg-white">
	<div class="container-fluid">
	<?= $this->session->flashdata('pesan'); ?>
        <div class="card card-product shadow mt--540">
			<div class="p-4">
				<!-- Tampilkan semua produk -->
				<div class="container">
					<h2 class="text-center mb-4">Daftar Produk di Keranjangmu</h2>
					<form method="post" accept-charset="utf-8" action="<?= base_url('booking/simpankeranjang'); ?>">
						<?php if ( ! empty($booking_temp) ) : ?>
							<div class="row">
								<div class="col-12 col-lg-8">
									<?php 
									$text = "Halo, Saya ingin Booking : \n";
									$text .= "\n";

									foreach ($booking_temp as $key => $bt) : 
									$produk = $this->Utama_model->getDatas('produk', ['id' => $bt['id_produk']])[0];

									$text .= $key+1 . ". Produk  : " . $produk["nama"] . "\n";
									$text .= "    Harga    : " . harga($produk["harga"]) . "\n";
									$text .= "\n";

									?>
									<input type="hidden" name="id[<?= $key; ?>]" value="<?= $bt['id']; ?>">
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
													<small class="text-muted"><?= $produk['kategori'] ?></small>
													<p class="card-text mb-0 text-warning font-weight-bold">
														<?php 
															// Format harga ke IDR
															echo harga($produk['harga']);
															$hargaperproduk = $produk['harga'] * $bt['jumlah'];
														?>
														<a href="#" class="btn btn-sm btn-outline-danger fas fw fa-trash float-right" data-href="<?= base_url('booking/hapusKeranjang/' . $bt['id'] . '/' . $hargaperproduk . '/' . $booking_total_temp['total']) ?>" data-toggle="modal" data-target="#modalKonfirmasiHapusKeranjang"></a>
													</p>
												</div>
											</div>
											<!-- <div class="col col-md col-lg align-self-center">
												<button type="button" class="btn btn-sm btn-outline-danger fas fw fa-trash"></button>
											</div> -->
										</div>
									</div>
									<?php 
									endforeach; 
									$text .= "  Estimasi Total    : " . harga($booking_total_temp['total']);
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-8">	
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text text-body bg-lighter" id="basic-addon1">Estimasi Total : </span>
										</div>
										<input id="harga" type="text" class="form-control text-body" data-value="<?= $booking_total_temp['total']; ?>" value="<?= harga($booking_total_temp['total']); ?>" readonly>
										<input id="ht" type="hidden" name="total" value="<?= $booking_total_temp['total']; ?>">
									</div>
								</div>
							</div>
							<div class="row" id="button-booking">
								<div class="col-lg-4">
									<a href="https://wa.me/6285929346973?text=<?= urlencode($text); ?>" type="button" class="btn btn-success"><i class="fab fa-fw fa-whatsapp mr-2"></i>Minta Persetujuan Via Whatsapp (ANDROID)</a>
								</div>
								<div class="col-lg-4">
									<a href="https://web.whatsapp.com/send?phone=6285929346973&text=<?= urlencode($text); ?>" target="_blank" type="button" class="btn btn-success"><i class="fab fa-fw fa-whatsapp mr-2"></i>Minta Persetujuan Via Whatsapp (PC)</a>
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