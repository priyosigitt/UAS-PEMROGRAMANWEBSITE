<?php
///Ambil data Menu dari Produk
$nav_produk_footer = $this->produk_model->nav_produk();

?>

<!-- FOOTER -->
<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Akun Saya</h3>
						<ul class="list-links">
							<li><a href="#">Akun Saya</a></li>
							<li><a href="#">Whishlist</a></li>
							<li><a href="#">Checkout</a></li>
							<li><a href="#">Login</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Kategori Produk</h3>
							<ul class="list-links">
									<li><a href="<?php echo base_url('produk') ?>">All</a></li>
							</ul>
						<?php foreach($nav_produk_footer as $nav_produk_footer) { ?>
							<ul class="list-links">
								<li><a href="<?php echo base_url('produk/kategori/'.$nav_produk_footer->slug_kategori) ?>">
									<?php echo $nav_produk_footer->nama_kategori ?>
								</a></li>
							</ul>
						<?php } ?>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Customer Service</h3>
						<ul class="list-links">
							<li><a href="#">Tentang JOOMStore</a></li>
							<li><a href="#">Pengiriman & Pengembalian</a></li>
							<li><a href="#">FAQ</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Tetap Terhubung</h3>
						<p>Dapatkan berita tentang promo dan diskon menarik dari kami setiap minggunya.</p>
						<form>
							<div class="form-group">
								<input class="input" placeholder="Masukkan Email...">
							</div>
							<button class="primary-btn">Ikuti Berita</button>
						</form>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="<?php echo base_url()?>assets/template/js/jquery.min.js"></script>
	<script src="<?php echo base_url()?>assets/template/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>assets/template/js/slick.min.js"></script>
	<script src="<?php echo base_url()?>assets/template/js/nouislider.min.js"></script>
	<script src="<?php echo base_url()?>assets/template/js/jquery.zoom.min.js"></script>
	<script src="<?php echo base_url()?>assets/template/js/main.js"></script>

</body>

</html>