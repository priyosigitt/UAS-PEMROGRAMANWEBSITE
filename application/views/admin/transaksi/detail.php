<p class="pull-right">
    <div class="btn-group pull-right">
        <a href="<?php echo base_url('admin/transaksi/cetak/'.$kelola_order->kode_transaksi) ?>"
            terget="_blank" title="Cetak" class="btn btn-info btn-sm">
            <i class="fa fa-print"></i> Cetak
        </a>
        <a href="<?php echo base_url('admin/transaksi') ?>"
            title="Kembali" class="btn btn-warning btn-sm">
            <i class="fa fa-backward"></i> Kembali
        </a>
    </div>
</p>
<div class="clearfix"></div><hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">Nama Pelanggan</th>
            <th>: <?php echo $kelola_order->nama_pelanggan ?></th>
        </tr>
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
        <tr>
            <td>Tanggal Bayar</td>
            <td>: <?php echo date('d-m-Y',strtotime($kelola_order->tanggal_bayar)) ?></td>
        </tr>
        <tr>
            <td>Jumlah Bayar</td>
            <td>: Rp. <?php echo number_format($kelola_order->jumlah_transaksi,'0',',','.') ?></td>
        </tr>
    </tbody>
</table>
<hr>
<table class="table table-bordered" width="100%">
    <thead class="bg-success">
        <tr>
            <th>No</th>
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