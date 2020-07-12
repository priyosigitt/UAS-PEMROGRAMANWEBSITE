<!-- BREADCRUMB -->
<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url() ?>">Home</a></li>
				<li class="active">View Cart</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

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
							
                            <br>
                            <br>

                            <?php 
                                ///setelah dicheckout
                                echo form_open(base_url('belanja/checkout')); 
                                ///Membuat random kode transaksi, dg randong_string dari CI
                                $kode_transaksi = date('dmY').strtoupper(random_string('alnum',8))///8 karakter, strtoupper untuk membuat huruf kapital
                            ?>
                                <input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan->id_pelanggan; ?>">
                                <input type="hidden" name="jumlah_transaksi" value="<?php echo $this->cart->total() ?>">
                                <input type="hidden" name="tanggal_transaksi" value="<?php echo date('Y-m-d'); ?>">
                                
                                <table>
                                    <thead>
                                        <tr?>
                                            <th class="form-group">
                                                <label>Kode Transaksi</label>
                                                <th class="col-md-10">
                                                    <input type="text" name="kode_transaksi" class="form-control" value="<?php echo $kode_transaksi ?>" readonly required>
                                                </th>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="form-group">
                                                <label>Nama Penerima</label>
                                                <th class="col-md-10">
                                                    <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan Nama Lengkap" 
                                                        value="<?php echo $pelanggan->nama_pelanggan ?>" required>
                                                </th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="form-group">
                                                <label>Email Penerima</label>
                                                <td class="col-md-10">
                                                    <input type="email" name="email" class="form-control" placeholder="Email" 
                                                        value="<?php echo $pelanggan->email ?>" required>
                                                </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="form-group">
                                                <label>Telepon Penerima</label>
                                                <td class="col-md-10">
                                                    <input type="text" name="telepon" class="form-control" placeholder="Masukkan Nomor Telepon" 
                                                        value="<?php echo $pelanggan->telepon ?>" required>
                                                </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="form-group">
                                                <label>Alamat Penerima</label>
                                                <td class="col-md-10">
                                                    <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat"><?php echo $pelanggan->alamat ?></textarea>
                                                </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="form-group">
                                                <td class="col-md-10">
                                                    <button class="btn btn-success btn-lg" type="submit">
                                                        <i class="fa fa-save"></i>Check Out
                                                    </button>    
                                                    <button class="btn btn-default btn-lg" type="reset">
                                                        <i class="fa fa-times"></i>Reset
                                                    </button>    
                                                </td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            
                            <?php
                                ///Echo form_close
                                echo form_close();										
                            ?>
                                
						</div>

					</div>
				</form>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->