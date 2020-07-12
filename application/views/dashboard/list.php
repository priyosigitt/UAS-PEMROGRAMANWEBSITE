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
                
                <div class="alert alert-success">
                    <h1>Selamat Datang 
                        <i><strong><?php echo $this->session->userdata('nama_pelanggan'); ?></strong></i> 
                    </h1>
                </div>

                <?php 
                ///Jika ada transaksi tampilkan tabelnya
                if($kelola_order) {
                ?>
                    <table class="table table-bordered" width="100%">
                        <thead class="bg-success">
                            <tr>
                                <th>NO</th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Jumlah Total</th>
                                <th>Jumlah Item</th>
                                <th>Status Bayar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($kelola_order as $kelola_order) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $kelola_order->kode_transaksi ?></td>
                                <td><?php echo date('d-m-Y',strtotime($kelola_order->tanggal_transaksi)) ?></td>
                                <td>Rp. <?php echo number_format($kelola_order->jumlah_transaksi) ?></td>
                                <td><?php echo $kelola_order->total_item ?></td>
                                <td><?php echo $kelola_order->status_bayar ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo base_url('dashboard/detail/'.$kelola_order->kode_transaksi)?>"
                                            class="btn btn-success btn-sm"><i class="fa fa-eye"> Detail</i></a>
                                        <a href="<?php echo base_url('dashboard/konfirmasi/'.$kelola_order->kode_transaksi)?>"
                                            class="btn btn-info btn-sm"><i class="fa fa-upload"> Konfirmasi Bayar</i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; }?>
                        </tbody>
                    </table>
                <?php 
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