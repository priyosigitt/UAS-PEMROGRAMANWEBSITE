<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() ?>">Home</a></li>
            <li><a href="<?php echo base_url('produk') ?>">Produk</a></li>
            <li class="active"><?php echo $title ?></li>
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
            <!--  Product Details -->
            <div class="product product-details clearfix">
                <div class="col-md-6">
                    <div id="product-main-view">
                        <div class="product-view">
                            <img src="<?php echo base_url('assets/upload/image/thumbs/'.$produk->gambar) ?>" alt="<?php echo $produk->nama_produk ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-body">
                    
                        <?php
                            ///Form proses belanja 
                            echo form_open(base_url('belanja/add')); 
                            ///Elemen yg dibawa
                            echo form_hidden('id', $produk->id_produk);
                            ///echo form_hidden('qty', 1);
                            echo form_hidden('price', $produk->harga);
                            echo form_hidden('name', $produk->nama_produk);
                            ///Elemen redirect
                            echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                        ?>

                        <h2 class="product-name"><?php echo $produk->nama_produk ?></h2>
                        <h3 class="product-price">IDR <?php echo number_format($produk->harga,'0',',','.') ?></h3>
                        <br>
                                <?php echo $produk->keterangan_produk?>
                        <div class="product-options">
                            <ul class="size-option">
                                <li><span class="text-uppercase">Size :</span></li>
                                <?php echo $produk->ukuran?>
                            </ul>
                            <ul class="size-option">
                                <li><span class="text-uppercase">Color :</span></li>
                                <?php echo $produk->warna?>
                            </ul>
                            <ul class="size-option">
                                <li><span class="text-uppercase">Stok :</span></li>
                                <?php echo $produk->stok?>
                            </ul>
                        </div>

                        <div class="product-btns">
                            <div class="qty-input">
                                <span class="text-uppercase">QTY: </span>
                                <input class="input" type="number" name="qty" value="1">
                            </div>
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
            <!-- /Product Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h2 class="title">Produk</h2>
                    <div class="pull-right">
                        <div class="product-slick-dots-1 custom-dots"></div>
                    </div>
                </div>
            </div>
            <!-- section title -->

            <!-- Product Single -->
            <div class="col-md-12 col-sm-6 col-xs-6">
                <div class="row">
                    <div id="product-slick-1" class="product-slick">
                    
                        <?php foreach($produk_related as $produk_related) {?>
                        <!-- Product Single -->
                        <div class="product product-single">
                        
                        
                            <?php
                            ///Form proses belanja 
                            echo form_open(base_url('belanja/add')); 
                            ///Elemen yg dibawa
                            echo form_hidden('id', $produk_related->id_produk);
                            echo form_hidden('qty', 1);
                            echo form_hidden('price', $produk_related->harga);
                            echo form_hidden('name', $produk_related->nama_produk);
                            ///Elemen redirect
                            echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                            ?>
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-eye"></i>
                                        <a href="<?php echo base_url('produk/detail/'.$produk_related->slug_produk) ?>">Detail</a>
                                    </button>
                                    <img src="<?php echo base_url('assets/upload/image/'.$produk_related->gambar)?>" alt="<?php echo $produk_related->nama_produk ?>">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">IDR <?php echo number_format($produk_related->harga,'0',',','.') ?></h3>
                                    <h2 class="product-name"><a href="#"><?php echo $produk_related->nama_produk ?></a></h2>
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
            <!-- /Product Single -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->