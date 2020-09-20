<div>
	<div class="x_panel">
		<!-- Tampilkan semua produk -->
		<div class="row">
			<?php 
                            // Looping Products
                            foreach ($products as $p) : 

                            $thumbnail = $this->Utama_model->getDatas('produks_gambar', ['produk_id' => $p['id'], 'thumbnail' => 1])[0]; 
                        ?>
			<div class="col-md-3">
				<div class="card">
                    <img src="<?php echo base_url('assets/img/api/products/' . $thumbnail['gambar'])?>" class="img-fluid">
					<div class="card-body">
						<h5 class="card-title text-dark"><?= filter_output($p['nama']); ?></h5>
						<p class="card-text">
                            <?php 
                            $crncy = new NumberFormatter( 'id_ID', NumberFormatter::CURRENCY );
                            echo $crncy->formatCurrency($p['harga'], "IDR"); 
                            ?>
                        </p>
						<?php 
                                        if (filter_output($p['stok']) < 1 ) {                                                 
                                            echo "<i class='btn btn-outline-primary fas fw fa-shopping-cart'> Booking&nbsp;&nbsp 0</i>";                                             
                                        } else {                                                 
                                            echo "<a class='btn btn-outline-primary fas fw fa-shopping-cart' href='" . base_url('booking/tambahBooking/' . $p['id']) . "'>Booking</a>";                                           
                                        }                                             
                                        ?>

						<a href="<?= base_url('home/detailProduct/'.$p['id']); ?>"
							class="btn btn-outline-warning fas fw fa-search"> Detail</a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

	</div>
</div>
</div>