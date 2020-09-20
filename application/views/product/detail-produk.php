 <div class="x_panel" align="center"> 
    <div class="x_content">       
    	<div class="row">        
    		<div class="col-md-4">           
    			<div class="thumbnail" style="height: auto; position: relative; left: 50%; width: 200%;">             	
                    <img src="<?= base_url('assets/img/api/products/' . $thumbnail['gambar']) ?>" style="max-width:100%; max-height: 100%; height: 150px; width: 120px"> 

            <div class="caption">               
            	<h5 style="min-height:40px;" align="center"><?= $produk['nama'] ?></h5>               
            	<center>                 
            		<table class="table table-stripped">                   
            			<tr>                     
            				<th nowrap>Nama : </th>                     
	            				<td nowrap><?= $produk['nama'] ?></td>                     
	            				<td>&nbsp;</td>

                                <th nowrap>Deskripsi : </th>                     
                                <td nowrap><?= $produk['deskripsi'] ?></td>                                                                            
            			</tr>

            			<tr>      
                            <th nowrap>Harga : </th>                     
                                <td nowrap><?= $produk['harga'] ?></td>   
                                <td>&nbsp;</td>               
            				<th nowrap>Stok: </th>                     
            				    <td><?= $produk['stok'] ?></td>                     
            				                     
            				                  
            			</tr>                   
            			<tr> 
                            <th>Diorder: </th>                     
                                <td><?= $produk['diorder'] ?></td>   
                                <td>&nbsp;</td>                  
            				<th nowrap>Diskon: </th>                     
            				<td><?= $produk['diskon'] ?></td>                     
            				                
            			</tr>                                    
            		</table>               
            	</center>               
            	<p>                              

                    <a class='btn btn-outline-primary fas fw fa-shopping-cart' href="<?= base_url('booking/tambahBooking/' . $produk['id']); ?>"> Booking</a>
            		<span class="btn btn-outline-secondary fas fw fa-reply" onclick="window.history.go(-1)"> Kembali</span>               
            	</p>             
            </div>          
        </div>         
    </div>       
</div>     
</div> 
</div>