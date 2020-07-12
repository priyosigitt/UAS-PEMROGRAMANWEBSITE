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

                <p class="alert alert-success">Belum memiliki akun? Silahkan 
                    <a href="<?php echo base_url('registrasi') ?>" class="btn btn-info btn-sm">Registrasi di sini</a>
                </p>

                <div class="col-md-12">
                    <?php 
                        
                        ///Display Error
                        echo validation_errors('<div class="alert alert-warning">', '</div>');

                        ///Display Notifikasi error login
                        if($this->session->flashdata('warning')){
                            echo '<div class="alert alert-warning">';
                            echo $this->session->flashdata('warning');
                            echo '</div>';
                        }


                        ///form open
                        echo form_open(base_url('masuk'), 'class="clearfix"'); 
                    ?>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="form-group">
                                        <label>Email (Username)</label>
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
                                        <td class="col-md-10">
                                            <button class="btn btn-success btn-lg" type="submit">
                                                <i class="fa fa-save"></i>Login
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
                
            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->