<div class="section features-6">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-12">
            	<div class="info info-horizontal info-hover-primary">
            		<div class="description pl-4">
            			<h5 class="montserrat">Simple dan Mudah untuk Membantu Merencanakan Hari Spesialmu.</h5>
            		</div>
            	</div>
            </div>
            <div class="col-lg-5 col-12 mx-md-auto d-flex justify-content-center">
            	<img class="p-3" src="<?= base_url('assets/img/app/couple-ill.png') ?>" width="100%">
            </div>
        </div>
    </div>
</div>
<div class="section features-1 bg-secondary">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto text-center">
				<span class="badge badge-primary badge-pill mb-3">Insight</span>
				<h3 class="display-3">Apa Fitur di Wedding Organizer Kami?</h3>
				<p class="lead">Lets, Check This Out</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="info">
					<div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle">
						<i class="ni ni-support-16"></i>
					</div>
					<h6 class="info-title text-uppercase text-primary">well-grounded</h6>
					<p class="description opacity-8">Kami sudah berpengalaman lebih dari 3 tahun dalam melayani dan membantu para calon pasangan untuk merencanakan pernikahannya.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="info">
					<div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle">
						<i class="ni ni-mobile-button"></i>
					</div>
					<h6 class="info-title text-uppercase text-success">Booking On Your Phone</h6>
					<p class="description opacity-8">Tidak perlu khawatir tentang hari pernikahanmu. Karena kami menyediakan booking hari pernikahan hanya melalui ponsel pintarmu.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="info">
					<div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle">
						<i class="ni ni-satisfied"></i>
					</div>
					<h6 class="info-title text-uppercase text-warning">commited</h6>
					<p class="description opacity-8">Kami akan selalu berkomitmen melayanimu dengan baik. Karena kepuasan client adalah yang utama bagi kami.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="section">
    <div class="container">
    <?= $this->session->flashdata('pesan'); ?>
        <!-- Tampilkan semua produk -->
        <div class="row">
            <div class="col-lg-5 col-12 mr-md-auto d-flex align-items-center">
                <img class="" src="<?= base_url('assets/img/app/woman-ill.gif') ?>" width="100%">
            </div>
            <div class="col-lg-7">	
                <h2 class="text-center mb-4">Best Products</h2>
                <div class="row">
                    <?php 
                    // Looping produk
                    foreach ($produk as $p) : 
    
                    $thumbnail = $this->Utama_model->getDatas('produk_gambar', ['produk_id' => $p['id'], 'thumbnail' => 1]); 
                    ?>
                    <div class="col-md-6 mb-3 d-flex">
                        <div class="card shadow flex-fill">
                            <?php if (isset($thumbnail['status']) && $thumbnail['status'] == FALSE) : ?>
                                <img src="<?php echo base_url('assets/img/api/produk/noimage_content.jpg')?>" class="card-img-top">
                            <?php else : ?>
                                <img src="<?php echo base_url('assets/img/api/produk/' . $thumbnail[0]['gambar'])?>"
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
                                <div class="d-flex flex-row justify-content-center">
                                    <a href="<?= base_url('home/detailProduct/'.$p['id']); ?>"
                                        class="btn btn-sm btn-outline-success fas fw fa-search text-nowrap"> Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center">
                    <a href="<?= base_url('home/daftarproduk') ?>" class="btn btn-outline-primary">Lihat Semua Produk <i class="fas fa-fw fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>