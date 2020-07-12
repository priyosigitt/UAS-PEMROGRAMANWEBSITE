<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() ?>">Home</a></li>
            <li class="active">Produk &amp; Belanja</li>
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
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                
                <!-- aside widget -->
                <div class="aside">
                    <h3 class="aside-title">Kategori</h3>
                    <ul class="list-links">
                        <li><a href="<?php echo base_url('produk') ?>">All</a></li>
                        <?php foreach($listing_kategori as $listing_kategori) { ?>
                        <li>
                            <a href="<?php echo base_url('produk/kategori/'.$listing_kategori->slug_kategori) ?>">
                                <?php echo $listing_kategori->nama_kategori; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /aside widget -->

            </div>
            <!-- /ASIDE -->

            <!-- MAIN -->
            <div id="main" class="col-md-9">
                

                <!-- STORE -->
                <div id="store">
                    <!-- row -->
                    <div class="row">
                        
                        <?php foreach($produk as $produk) { ?>
                        <!-- Product Single -->
                        <div class="col-md-4 col-sm-6 col-xs-6">

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

                            <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-eye"></i> 
                                        <a href="<?php echo base_url('produk/detail/'.$produk->slug_produk) ?>">Detail</a>
                                    </button>
                                    <img src="<?php echo base_url('assets/upload/image/thumbs/'.$produk->gambar) ?>" alt="<?php echo $produk->nama_produk ?>">
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
                            </div>
                            
                            <?php 
								///Close form
								echo form_close();
							?>

                        </div>
                        <!-- /Product Single -->
                        <?php } ?>
                        
                    </div>
                    <!-- /row -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /MAIN -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->