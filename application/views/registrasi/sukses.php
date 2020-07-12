<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <form id="checkout-form" class="clearfix" method="post">
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

                <p class="alert alert-success">Registrasi telah dilakukan. 
                    <a href="<?php echo base_url('masuk') ?>" class="btn btn-info btn-sm">Login di sini</a>
                    <br><br>
                    Anda juga bisa lakukan checkout
                    <a href="<?php echo base_url('belanja/checkout') ?>" class="btn btn-warning btn-sm"><i class="fa fa-shopping-cart"></i> Check Out</a>
                </p>

                
                
            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->