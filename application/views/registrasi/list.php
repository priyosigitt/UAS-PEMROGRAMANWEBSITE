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

                <p class="alert alert-success">Sudah memiliki akun? Silahkan 
                    <a href="<?php echo base_url('masuk') ?>" class="btn btn-info btn-sm">Login di sini</a>
                </p>

                <div class="col-md-12">
                    <?php 
                        
                        ///Display Error
                        echo validation_errors('<div class="alert alert-warning">', '</div>');
                        ///form open
                        echo form_open(base_url('registrasi'), 'class="clearfix"'); 
                    ?>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="form-group">
                                        <label>Nama Lengkap</label>
                                        <td class="col-md-10">
                                            <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan Nama Lengkap" 
                                                value="<?php echo set_value('nama_pelanggan') ?>" required>
                                        </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-group">
                                        <label>Email</label>
                                        <td class="col-md-10">
                                            <input type="email" name="email" class="form-control" placeholder="Email" 
                                                value="<?php echo set_value('email') ?>" required>
                                        </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-group">
                                        <label>Password</label>
                                        <td class="col-md-10">
                                            <input type="password" name="password" class="form-control" placeholder="Password" 
                                                value="<?php echo set_value('password') ?>" required>
                                        </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-group">
                                        <label>Telepon</label>
                                        <td class="col-md-10">
                                            <input type="text" name="telepon" class="form-control" placeholder="Masukkan Nomor Telepon" 
                                                value="<?php echo set_value('telepon') ?>" required>
                                        </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-group">
                                        <label>Alamat</label>
                                        <td class="col-md-10">
                                            <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat"><?php echo set_value('alamat')?></textarea>
                                        </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-group">
                                        <td class="col-md-10">
                                            <button class="btn btn-success btn-lg" type="submit">
                                                <i class="fa fa-save"></i>Submit
                                            </button>    
                                            <button class="btn btn-default btn-lg" type="reset">
                                                <i class="fa fa-times"></i>Reset
                                            </button>    
                                        </td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php echo form_close(); ?>
                </div>
                
                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
                </div>

            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->