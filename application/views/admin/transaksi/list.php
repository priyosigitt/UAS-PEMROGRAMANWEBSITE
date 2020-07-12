<table class="table table-bordered" width="100%">
    <thead class="bg-success">
        <tr>
            <th>NO</th>
            <th>Pelanggan</th>
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
            <td><?php echo $kelola_order->nama_pelanggan ?>
                <br>
                <small>
                    Telepon : <?php echo $kelola_order->telepon ?>
                    <br>
                    Email : <?php echo $kelola_order->email ?>
                    <br>
                    Alamat Pengiriman : <br> <?php echo nl2br($kelola_order->alamat) ?>
                </small>
            </td>
            <td><?php echo $kelola_order->kode_transaksi ?></td>
            <td><?php echo date('d-m-Y',strtotime($kelola_order->tanggal_transaksi)) ?></td>
            <td>Rp. <?php echo number_format($kelola_order->jumlah_transaksi) ?></td>
            <td><?php echo $kelola_order->total_item ?></td>
            <td><?php echo $kelola_order->status_bayar ?></td>
            <td>
                <div class="btn-group">
                    <a href="<?php echo base_url('admin/transaksi/detail/'.$kelola_order->kode_transaksi)?>"
                        class="btn btn-success btn-sm"><i class="fa fa-eye"> Detail</i></a>
                    <a href="<?php echo base_url('admin/transaksi/cetak/'.$kelola_order->kode_transaksi)?>"
                        terget="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"> Cetak</i></a>
                    <a href="<?php echo base_url('admin/transaksi/status/'.$kelola_order->kode_transaksi)?>"
                        class="btn btn-warning btn-sm"><i class="fa fa-check"> Update Status</i></a>
                </div>
                
                <br>
                <br>
                
                <div class="btn-group">
                    <a href="<?php echo base_url('admin/transaksi/pdf/'.$kelola_order->kode_transaksi)?>"
                        terget="_blank" class="btn btn-info btn-sm"><i class="fa fa-file-pdf-o"> Unduh PDF</i></a>
                </div>
            </td>
        </tr>
        <?php $i++; }?>
    </tbody>
</table>