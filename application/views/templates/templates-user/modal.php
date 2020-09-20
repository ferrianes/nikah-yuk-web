  <!-- Begin Page Content --> 
<div class="container-fluid">             
            <?php if(validation_errors()){?>                 
                <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
                    <?= validation_errors();?> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                
                </div>             
            <?php }?>  

  	<!-- login modal --> 
	<div class="modal fade" tabindex="-1" id="loginModal" role="dialog">     
		<div class="modal-dialog" role="document">         
			<div class="modal-content">             
				<div class="modal-header">                 
					<h5 class="modal-title">Login Member</h5>                 
					<button type="button" class="close" data-dismiss="modal" arialabel="Close"> 
						<span aria-hidden="true">&times;</span>                 
					</button>             
				</div>  

				<form class="user" method="post" action="<?= base_url('customer'); ?>">                 
					<div class="modal-body">                     
						<div class="form-group row">                         
							<label for="email" class="col-sm-2 col-form-label">Email</label>                         
							<div class="col-sm-10">                             
								<input type="text" class="form-control" id="email" name="email" placeholder="Alamat Email">
							</div>                     
						</div>                     
						<div class="form-group row">                         
							<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>                         
							<div class="col-sm-10">                             
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>                     
						</div>                 
					</div>                 

					<div class="modal-footer">                     
						<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-outline-primary">Log in</button>                 
					</div>             
				</form>        
			</div>     
		</div> 
	</div> 
	<!--/login modal --> 
 
		<!-- daftar modal --> 
		<div class="modal fade" tabindex="-1" id="daftarModal" role="dialog">     
			<div class="modal-dialog" role="document">         
				<div class="modal-content">             
					<div class="modal-header">                 
						<h5 class="modal-title">Daftar Customer</h5>                 
						<button type="button" class="close" data-dismiss="modal" arialabel="Close">
							<span aria-hidden="true">&times;</span>                 
						</button>             
					</div>

					 <form class="user" method="post" action="<?= base_url('customer/daftar'); ?>">                 
					 	<div class="modal-body">    

                            <div class="form-group">                         
					 			<input type="text" class="form-control form-control-label" id="username" name="username" placeholder="Username">                     
					 		</div> 

					 		<div class="form-group">                         
					 			<input type="text" class="form-control form-control-label" id="nm_lengkap" name="nm_lengkap" placeholder="Nama Lengkap">                     
					 		</div>                     

					 		<div class="form-group">                         
					 			<input type="text" class="form-control form-control-label" id="alamat" name="alamat" placeholder="Alamat Lengkap">                     
					 		</div>                     

					 		<div class="form-group">                         
					 			<input type="text" class="form-control form-control-label" id="email" name="email" placeholder="Alamat Email">                     
					 		</div>    

					 		<div class="form-group">                         
					 			<input type="text" class="form-control form-control-label" id="telepon" name="telepon" placeholder="Telepon">                     
					 		</div>                 

					 		<div class="form-group">                         
					 			<input type="password" class="form-control form-control-label" id="password1" name="password1" placeholder="Password">                     
					 		</div>                     

					 		<div class="form-group">                         
					 			<input type="password" class="form-control form-control-label" id="password2" name="password2" placeholder="Ulangi Password">                     
					 		</div>                 
					 	</div> 
		 
		                <div class="modal-footer">                     
		                	<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button> 
		                	<button type="submit" class="btn btn-outline-primary">Simpan</button>                 
		                </div>             
		            </form>        
		        </div>     
		    </div> 
		</div> <!--/end of Modal Daftar --> 

	<!-- modal info--> 
	<div class="modal fade" tabindex="-1" id="modal-info" role="dialog">     
		<div class="modal-dialog" role="document">         
			<div class="modal-content">             
				<div class="modal-header">                 
					<h5 class="modal-title">Informasi</h5>                 
					<button type="button" class="close" data-dismiss="modal" arialabel="Close">                     
						<span aria-hidden="true">&times;</span> 
					</button>             
				</div>          

				<div class="modal-body">                 
					<span class="alert alert-message alert-success">Waktu Pengambilan Buku 1x24 jam dari Booking!!!</span>
				</div>             

				<div class="modal-footer">                 
					<a class="btn btn-outline-info" href="<?= base_url(); ?>">Ok</a>             
				</div>         
			</div>     
		</div> 
	</div> <!--/modal info --> 