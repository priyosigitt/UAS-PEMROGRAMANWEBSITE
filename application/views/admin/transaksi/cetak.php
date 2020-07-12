<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <style type="text/css" media="print">
        body{
            font-family: Arial;
            font-size: 12px
        }
        .cetak{
            width: 19cm;
            height: 27cm;
            padding: 1cm;
        }
        table{
            border: solid thin #000;
            border-collapse: collapse;
        }
        td, th{
            padding: 3mm 6mm;
            text-align: left;
            vertical-align: top;
        }
        th{
            background-color: #F5F5F5;
            font-weight: bold;
        }
        h1{
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
        }
    </style>
    <style type="text/css" media="screen">
        body{
            font-family: Arial;
            font-size: 12px
        }
        .cetak{
            width: 19cm;
            height: 27cm;
            padding: 1cm;
        }
        table{
            border: solid thin #000;
            border-collapse: collapse;
        }
        td, th{
            padding: 3mm 6mm;
            text-align: left;
            vertical-align: top;
        }
        th{
            background-color: #F5F5F5;
            font-weight: bold;
        }
        h1{
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
        }
    </style>
</head>
<body onload="print()">
    <div class="cetak">
        <h1>Detail Transaksi GhiNaj SHOP</h1>
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
    </div>
</body>
</html>