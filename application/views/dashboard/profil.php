<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                
               <?php include('menu.php')?>

            </div>
            <!-- /ASIDE -->

            <!-- MAIN -->
            <div id="main" class="col-md-9">
                
                <h1><?php echo $title?></h1>
                <hr>

                <?php 
                    ///Notifikasi Update prodil
                    if($this->session->flashdata('sukses')){
                        echo '<div class="alert alert-success">';
                        echo $this->session->flashdata('sukses');
                        echo '</div>';
                    }

                    ///Display Error
                    echo validation_errors('<div class="alert alert-warning">', '</div>');
                    ///form open
                    echo form_open(base_url('dashboard/profil'), 'class="clearfix"'); 
                ?>
                    <table>
                        <tbody>
                            <tr>
                                <td class="form-group">
                                    <label>Nama Lengkap</label>
                                    <td class="col-md-10">
                                        <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan Nama Lengkap" 
                                            value="<?php echo $pelanggan->nama_pelanggan ?>" required>
                                    </td>
                                </td>
                            </tr>
                            <tr>
                                <td class="form-group">
                                    <label>Email</label>
                                    <td class="col-md-10">
                                        <input type="email" name="email" class="form-control" placeholder="Email" 
                                            value="<?php echo $pelanggan->email ?>" readonly>
                                    </td>
                                </td>
                            </tr>
                            <tr>
                                <td class="form-group">
                                    <label>Password</label>
                                    <td class="col-md-10">
                                        <input type="password" name="password" class="form-control" placeholder="Password" 
                                            value="<?php echo set_value('password') ?>">
                                        <span class="text-danger"> Ketik minimal 6 karakter untuk mengganti password baru</span>
                                    </td>
                                </td>
                            </tr>
                            <tr>
                                <td class="form-group">
                                    <label>Telepon</label>
                                    <td class="col-md-10">
                                        <input type="text" name="telepon" class="form-control" placeholder="Masukkan Nomor Telepon" 
                                            value="<?php echo $pelanggan->telepon ?>" required>
                                    </td>
                                </td>
                            </tr>
                            <tr>
                                <td class="form-group">
                                    <label>Alamat</label>
                                    <td class="col-md-10">
                                        <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat"><?php echo $pelanggan->alamat ?></textarea>
                                    </td>
                                </td>
                            </tr>
                            <tr>
                                <td class="form-group">
                                    <td class="col-md-10">
                                        <button class="btn btn-success btn-lg" type="submit">
                                            <i class="fa fa-edit"></i>Update Profil
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
            <!-- /MAIN -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->