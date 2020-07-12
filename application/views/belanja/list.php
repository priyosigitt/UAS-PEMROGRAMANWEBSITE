<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<form id="checkout-form" class="clearfix">
				<h1><?php echo $title ?></h1><hr>
				<div class="clearfix"></div>
				<br><br>

				<?php
					if($this->session->flashdata('sukses')){
						echo '<div class="alert alert-warning">';
						echo $this->session->flashdata('sukses');
						echo '</div>';
					}
				?>

				<div class="col-md-12">
					<div class="order-summary clearfix">
						<div class="section-title">
							<h3 class="title">View Cart</h3>
						</div>
						<table class="shopping-cart-table table">
							<thead>
								<tr>
									<th class="text-left">Gambar</th>
									<th class="text-left">Produk</th>
									<th class="text-center">Harga</th>
									<th class="text-center">Jumlah</th>
									<th class="text-center">Sub Total</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									

									///Looping data keranjang belanja
									foreach($keranjang as $keranjang) { 
										///Ambil data produk
										$id_produk  = $keranjang['id'];
										$produk     = $this->produk_model->detail($id_produk);

										///Form Update keranjang
										echo form_open(base_url('belanja/update_cart/'.$keranjang['rowid']));
										
								?>
								<tr>
									<td class="thumb"><img src="<?php echo base_url('assets/upload/image/thumbs/'.$produk->gambar) ?>" alt="<?php echo $keranjang['name'] ?>"></td>
									<td class="details">
										<a href="#"><?php echo $keranjang['name'] ?></a>
										<ul>
											<li><span>Size: <?php echo $produk->ukuran?></span></li>
										</ul>
									</td>
									<td class="price text-center"><strong> Rp. <?php echo number_format($keranjang['price'],'0',',','.') ?> </strong><br></td>
									<td class="qty text-center"><input class="input" type="number" name="qty" value="<?php echo $keranjang['qty'] ?>"></td>
									<td class="total text-center">
										<strong class="total">
											Rp. <?php $sub_total = $keranjang['price'] * $keranjang['qty'];
												echo number_format($sub_total,'0',',','.');
												?>
										</strong>
									</td>
									<td class="text-center">
										<button type="submit" name="update" class="btn btn-success btn-sm">
											<i class="fa fa-edit"></i>Update
										</button>
										<a href="<?php echo base_url('belanja/hapus/'.$keranjang['rowid']) ?>" class="btn btn-warning btn-sm">
											<i class="fa fa-trash-o"></i>Delete
										</a>
									</td>
								</tr>
								<?php
										///Echo form_close
										echo form_close();

									///End Looping keranjang belanja
									}
									
								?>
								
							</tbody>
							<tbody class="bg-info">
								<tr>
									<th colspan="4" class="text-left"><h3>TOTAL :</h3></th>
									<th colspan="2" class="text-left"><h3>Rp. <?php echo number_format($this->cart->total(),'0',',','.') ?></h3></th>
								</tr>
							</tbody>
						</table>
						<div class="pull-right">
							<a href="<?php echo base_url('belanja/hapus') ?>" class="btn btn-danger btn-lg"><i class="fa fa-trash-o"></i>Bersihkan Keranjang Belanja</a>
						</div>
						<br><br><br>
						<div class="pull-right">
							<a href="<?php echo base_url('belanja/checkout') ?>" class="btn btn-success btn-lg"><i class="fa fa-shopping-cart"></i>Checkout</a>
						</div>
					</div>

				</div>
			</form>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->