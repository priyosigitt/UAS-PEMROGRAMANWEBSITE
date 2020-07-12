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

                <p><h4>Berikut adalah riwayat belanja Anda</h4></p>
                <br>
                
                <?php 
                ///Jika ada transaksi tampilkan tabelnya
                if($kelola_order) {
                ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="20%">Kode Transaksi</th>
                                <th>: <?php echo $kelola_order->kode_transaksi ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tanggal</td>
                                <td>: <?php echo date('d-m-Y',strtotime($kelola_order->tanggal_transaksi)) ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Total</td>
                                <td>: Rp. <?php echo number_format($kelola_order->jumlah_transaksi) ?></td>
                            </tr>
                            <tr>
                                <td>Status Bayar</td>
                                <td>: <?php echo $kelola_order->status_bayar ?></td>
                            </tr>
                            <tr>
                                <td>Bukti Bayar</td>
                                <td>:   <?php if($kelola_order->bukti_bayar!="") { ?>
                                                <img src="<?php echo base_url('assets/upload/image/'.$kelola_order->bukti_bayar)?>" 
                                                class="img img-thumbnail" width="200">
                                        <?php }else{
                                            echo 'Belum ada Bukti bayar';
                                        }?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                
                <?php
                    ///Error Upload
                    if(isset($error)){
                        echo '<p class="alert alert-warning">'.$error.'</p>';
                    }

                    ///Notifikasi error
                    echo validation_errors('<p class="alert alert-warning">','</p>');

                    //Form Open
                    echo form_open_multipart(base_url('dashboard/konfirmasi/'.$kelola_order->kode_transaksi));
                ?>

                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">Konfirmasi Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tanggal Bayar</td>
                                <td>
                                    <input type="text" name="tanggal_bayar" class="form_control-lg"
                                    placeholder="dd-mm-yyyy" 
                                    value=" <?php if(isset($_POST['tanggal_bayar'])){ 
                                                    echo set_value('tanggal_bayar'); 
                                                }elseif($kelola_order->tanggal_bayar!=""){
                                                    echo $kelola_order->tanggal_bayar;
                                                }else{
                                                    echo date('d-m-Y');   
                                                }
                                            ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah Pembayaran</td>
                                <td>
                                    <input type="text" name="jumlah_bayar" class="form_control-lg"
                                    placeholder="Jumlah Pembayaran" 
                                    value="Rp. <?php if(isset($_POST['jumlah_bayar'])) { 
                                                    echo set_value('jumlah_bayar'); 
                                                }elseif($kelola_order->jumlah_bayar!=""){
                                                    echo number_format($kelola_order->jumlah_bayar);
                                                }else{
                                                    echo number_format($kelola_order->jumlah_transaksi);   
                                                }?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Upload Bukti Pembayaran</td>
                                <td>
                                    <input type="file" name="bukti_bayar" class="form-control"
                                    placeholder="Upload Bukti Pembayaran">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="btn group">
                                        <button class="btn btn-success btn-lg" type="submit" name="submit">
                                        <i class="fa fa-upload"></i>Submit</button>
                                        <button class="btn btn-info btn-lg" type="reset" name="reset">
                                        <i class="fa fa-times"></i>Reset</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                <?php 
                ///Form close
                echo form_close();


                ///Jika belum ada transaksi tampilakan notifikasi
                } else{ ?>
                    <p class="alert alert-succes">
                        <i class="fa fa-warning"></i> Belum ada data transaksi
                    </p>
                <?php } ?>
                
            </div>
            <!-- /MAIN -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->