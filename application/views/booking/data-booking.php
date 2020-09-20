<div class="container">
	<center>
		<table>
			<tr>
				<td>
					<div class="table-responsive full-width">
						<table class="table table-bordered table-striped table-hover" id="table-datatabel">
							<tr>
								<th>Produk</th>
								<th>Deskripsi</th>
								<th>Harga</th>
							</tr>
							
							<!--<?php 
							foreach ($temp as $t) {
							?>-->
								<tr>
									<td>
										<img src="<?= base_url('assets/img/upload/' . $t['gambar']); ?>" class="rounded" alt="No Picture" width="10%">
									</td>

									<td nowrap><?= $t['nama']; ?></td>
									<td nowrap><?= $t['deskripsi']; ?></td>
									<td nowrap><?= $t['harga']; ?></td>
		
									<td nowrap>
										<a href="<?= base_url('booking/hapusbooking/' . $t['id_buku']); ?>" onclick="return confirm('Yakin Tidak jadi Booking')"><i class="btn btn-sm btn-outline-danger fas fw fa-trash"></i></a>


									</td>
								</tr>
							<!--	<?php $no++;
							}?>-->
						</table>
					</div>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<hr>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<a class="btn btn-sm btn-outline-primary" href="<?php echo base_url('home'); ?>">
						<span class="fas fw fa-play"></span> Lanjutkan Booking Buku</a>
					<a class="btn btn-outline-success" href="<?php echo base_url() . 'booking/bookingSelesai/' . $this->session->userdata('id_user'); ?>">
						<span class="fas fw fa-stop"></span> Selesaikan Booking</a>
				</td>
			</tr>
		</table>
	</center>
</div>