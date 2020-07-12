<?php
///Ambil data Menu dari Produk
$nav_produk = $this->produk_model->nav_produk();

?>

<!-- header -->
<div id="header">
			<div class="container">
				
					<!-- Search -->
					<div class="navbar-form navbar-left">
						<?php echo form_open('produk/search')?>
							<input type="text" name="keyword" class="form-control" placeholder="Search">
							<button type="submit" class="btn btn-info" >Cari</button>
						<?php echo form_close() ?>
					</div>
					<!-- /Search -->
				
				<div class="pull-right">
					<ul class="header-btns">

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->

						
						<!-- Account -->
						
						<li class="header-account dropdown default-dropdown">
							<?php if($this->session->userdata('email')) {?>
								<a href="<?php echo base_url('dashboard') ?>" >
										<div class="header-btns-icon">
											<i class="fa fa-user-o"></i>
											<strong><?php echo $this->session->userdata('nama_pelanggan');?></strong>
										</div>
										
								</a>
								<a href="<?php echo base_url('masuk/logout') ?>">
										<div class="header-btns-icon">
											<i class="fa fa-sign-out"></i> 
											<strong class="text-uppercase">Logout</strong>
										</div>
										
								</a>

							<?php }else{?>
								<a href="<?php echo base_url('registrasi') ?>" >
										<div class="header-btns-icon">
											<i class="fa fa-user-o"></i>
										</div>
								</a>
							<?php } ?>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<?php
										///Check data belanjaan ada atau tidak
										$keranjang = $this->cart->contents();

									?>
									<i class="fa fa-shopping-cart"></i>
									<span class="qty"><?php echo count($keranjang) ?></span>
								</div>
								<strong class="text-uppercase">My Cart <i class="fa fa-caret-down"></i></strong>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">

										<?php
											///Jika tidak ada data belanjaan
											if(empty($keranjang)) {
										?>
										<div class="product product-widget">
											<p class="alert alert-success">Keranjang Kosong</p>
										</div>

										<?php
											///Jika ada belanjaan
											}else{
												///Total belanjaan
												$total_belanja = 'Rp. '.number_format($this->cart->total(),'0',',','.');

												///Tampilkan data belanja
												foreach($keranjang as $keranjang){
													$id_produk = $keranjang['id'];
													///Ambil data produk
													$produk = $this->produk_model->detail($id_produk);

											
										?>
											<div class="product product-widget">
												<div class="product-thumb">
													<img src="<?php echo base_url('assets/upload/image/thumbs/'.$produk->gambar)?>" alt="<?php echo $keranjang['name'] ?>">
												</div>
												<div class="product-body">
													<h3 class="product-price"> Rp. <?php echo number_format($keranjang['price'],'0',',','.') ?> <span class="qty"> x <?php echo $keranjang['qty'] ?></span></h3>
													<h2 class="product-name"><a href="<?php echo base_url('produk/detail/'.$produk->slug_produk) ?>"><?php echo $keranjang['name'] ?></a></h2>
												</div>
												
											</div>
										
										<?php 
												}///tutup foreach keranjang
											}///tutup else
										?>
									
									<br>
									<div class="text-right">
										<h4>Rp. <?php echo number_format($this->cart->total(),'0',',','.') ?></h4>
									</div>

									<div class="shopping-cart-btns">
										<a href="<?php echo base_url('belanja') ?>" class="main-btn">View Cart</a>
										<a href="<?php echo base_url('belanja/checkout') ?>"class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									
								</div>
							</div>
						</li>
						<!-- /Cart -->

						
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
					
						<li><a href="<?php echo base_url()?>">Beranda</a></li>
                        <li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Produk &amp; Belanja <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="<?php echo base_url('produk') ?>">All</a></li>
                                <?php foreach($nav_produk as $nav_produk) { ?>
								<li><a href="<?php echo base_url('produk/kategori/'.$nav_produk->slug_kategori) ?>">
                                    <?php echo $nav_produk->nama_kategori ?>
                                </a></li>
                                <?php } ?>
                            </ul>
						</li>	
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->