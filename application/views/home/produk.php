<!-- section -->
<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section-title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Produk</h2>
						<div class="pull-right">
							<div class="product-slick-dots-1 custom-dots"></div>
						</div>
					</div>
				</div>
				<!-- /section-title -->

				<!-- Product Slick -->
				<div class="col-md-12 col-sm-6 col-xs-6">
					<div class="row">
						<div id="product-slick-1" class="product-slick">
						
							<?php foreach($produk as $produk) {?>
                            <!-- Product Single -->
							<div class="product product-single">
								<?php
									///Form proses belanja 
									echo form_open(base_url('belanja/add')); 
									///Elemen yg dibawa
									echo form_hidden('id', $produk->id_produk);
									echo form_hidden('qty', 1);
									echo form_hidden('price', $produk->harga);
									echo form_hidden('name', $produk->nama_produk);
									///Elemen redirect
									echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
								?>
								<div class="product-thumb">
									<button class="main-btn quick-view"><i class="fa fa-eye"></i>
										<a href="<?php echo base_url('produk/detail/'.$produk->slug_produk) ?>">Detail</a>
									</button>
									<img src="<?php echo base_url('assets/upload/image/'.$produk->gambar)?>" alt="<?php echo $produk->nama_produk ?>">
								</div>
								<div class="product-body">
									<h3 class="product-price">IDR <?php echo number_format($produk->harga,'0',',','.') ?></h3>
									<h2 class="product-name"><a href="#"><?php echo $produk->nama_produk ?></a></h2>
									<div class="product-btns">
										<button type="submit" value="submit" class="primary-btn add-to-cart">
											<i class="fa fa-shopping-cart"></i> 
											Add to Cart
										</button>
									</div>
								</div>
								<?php 
									///Close form
									echo form_close();
								?>
							</div>
							<!-- /Product Single -->
							<?php } ?>
						</div>
					</div>
				</div>
				<!-- /Product Slick -->

				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->