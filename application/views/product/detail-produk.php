<section class="section bg-white">
	<div class="container-fluid">
		<div class="card card-product shadow mt--540">
			<div class="p-4">
				<!-- Tampilkan semua produk -->
				<div class="container">
					<?= $this->session->flashdata('pesan'); ?>
					<h2 class="text-center mb-4">Detail Produk</h2>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url('produk') ?>">Produk</a></li>
							<li class="breadcrumb-item"><a href="#">Kategori</a></li>
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>produk/kategori/<?= seo_title($produk['kategori']); ?>"><?= $produk['kategori']; ?></a></li>
							<li class="breadcrumb-item active" aria-current="page"><?= $produk['nama']; ?></li>
						</ol>
					</nav>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<?php if ($produk['gambar'] === NULL) : ?>
								<?php if (isset($produks_gambar['status']) && $produks_gambar['status'] == FALSE) : ?>
									<img src="<?= base_url('assets/img/api/produk/noimage_content.jpg') ?>" class="img-thumbnail" alt="">
								<?php else : ?>
									<!-- Carousel -->
									<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
										<ol class="carousel-indicators">
											<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
											<?php 
											$i = 1; 
											foreach ($produks_gambar as $produk_gambar) : 
											?>
												<li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"></li>
											<?php 
											$i++; 
											endforeach; 
											?>
										</ol>
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100 thumb" src="<?= base_url('assets/img/api/produk/noimage_content.jpg') ?>" alt="slide ke-1">
											</div>
											<?php 
											$i = 2; 
											foreach ($produks_gambar as $produk_gambar) : 
											?>
											<div class="carousel-item">
												<?php 
												$file_parts = pathinfo($produk_gambar['gambar']);
												
												if ($file_parts['extension'] == 'mp4' OR $file_parts['extension'] == 'ogg' OR $file_parts['extension'] == 'webm') : 
												?>
													<video autoplay loop muted class="w-100 thumb-video">
														<source src="<?= base_url('assets/img/api/produk/') . $produk_gambar['gambar'] ?>" type="video/<?= $file_parts['extension'] ?>">
														Your browser does not support HTML video.
													</video>
												<?php else : ?>
													<img class="d-block w-100 thumb"
														src="<?= base_url('assets/img/api/produk/') . $produk_gambar['gambar'] ?>" alt="slide ke-<?= $i; ?>">
												<?php endif; ?>
											</div>
											<?php 
											$i++; 
											endforeach; 
											?>
										</div>
										<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
											data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
											data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
									<!-- End Carousel -->
								<?php endif;?>
							<?php else : ?>
								<?php if (isset($produks_gambar['status']) && $produks_gambar['status'] == FALSE) : ?>
									<div class="text-center mb-2">
										<img class="img-thumbnail thumb" src="<?= base_url('assets/img/api/produk/' . $produk['gambar']) ?>" alt="slide ke-1">
									</div>
								<?php else : ?>
									<!-- Carousel -->
									<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
										<ol class="carousel-indicators">
											<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
											<?php 
											$i = 1; 
											foreach ($produks_gambar as $produk_gambar) : 
											?>
												<li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"></li>
											<?php 
											$i++; 
											endforeach; 
											?>
										</ol>
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100 thumb" src="<?= base_url('assets/img/api/produk/' . $produk['gambar']) ?>" alt="slide ke-1">
											</div>
											<?php 
											$i = 2; 
											foreach ($produks_gambar as $produk_gambar) : 
											?>
											<div class="carousel-item">
												<?php 
												$file_parts = pathinfo($produk_gambar['gambar']);
												
												if ($file_parts['extension'] == 'mp4' OR $file_parts['extension'] == 'ogg' OR $file_parts['extension'] == 'webm') : 
												?>
													<video autoplay loop muted class="w-100 thumb-video">
														<source src="<?= base_url('assets/img/api/produk/') . $produk_gambar['gambar'] ?>" type="video/<?= $file_parts['extension'] ?>">
														Your browser does not support HTML video.
													</video>
												<?php else : ?>
													<img class="d-block w-100 thumb"
														src="<?= base_url('assets/img/api/produk/') . $produk_gambar['gambar'] ?>" alt="slide ke-<?= $i; ?>">
												<?php endif; ?>
											</div>
											<?php 
											$i++; 
											endforeach; 
											?>
										</div>
										<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
											data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
											data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
									<!-- End Carousel -->
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<div class="col-md-6 col-sm-12">
							<ul class="list-group">
								<li class="list-group-item">
									<h5 class="text-dark">Nama Produk</h5>
									<?= $produk['nama'] ?>
								</li>
								<li class="list-group-item">
									<h5 class="text-dark">Kategori</h5>
									<?= $produk['kategori'] ?>
								</li>
								<li class="list-group-item">
									<h5 class="text-dark">Deskripsi</h5>
									<?= $produk['deskripsi'] ?>
								</li>
								<li class="list-group-item">
									<h5 class="text-dark">Harga</h5>
									<?php 
									$crncy = new NumberFormatter( 'id_ID', NumberFormatter::CURRENCY );
									$crncy->setTextAttribute(NumberFormatter::CURRENCY_CODE, 'IDR');
									$crncy->setAttribute(NumberFormatter::FRACTION_DIGITS, 0); 
									echo $crncy->formatCurrency($produk['harga'], "IDR"); 
									?>
								</li>
								<li class="list-group-item">
									<h5 class="text-dark">Stok</h5>
									<?= $produk['stok'] ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="cart-sm d-flex align-items-center">
				<div class="container">
					<div class="d-flex flex-row justify-content-end">
						<?php if (filter_output($produk['stok']) < 1 ) : ?>
						<i class='btn btn-outline-primary fas fw fa-shopping-cart'> Booking 0</i>
						<?php else : ?>
						<!-- <div class="col-6 pr-1 text-nowrap"> -->
						<a class='btn btn-primary fas fw fa-shopping-cart text-nowrap'
							href='<?= base_url('booking/tambahBooking/' . $produk['id']); ?>'> Booking</a>
						<!-- </div> -->
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>