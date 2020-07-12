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
                        </tbody>
                    </table>

                    <table class="table table-bordered" width="100%">
                        <thead class="bg-success">
                            <tr>
                                <th>NO</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($transaksi as $transaksi) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $transaksi->kode_produk ?></td>
                                <td><?php echo $transaksi->nama_produk ?></td>
                                <td><?php echo number_format($transaksi->jumlah) ?></td>
                                <td>Rp. <?php echo number_format($transaksi->harga) ?></td>
                                <td><?php echo number_format($transaksi->total_harga) ?></td>
                                
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