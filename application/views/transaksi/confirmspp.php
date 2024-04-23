<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <style>
  @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #0C4160;

    padding: 30px 10px;
}

.card {
    max-width: 500px;
    margin: auto;
    color: black;
    border-radius: 20 px;
}

p {
    margin: 0px;
}

.container .h8 {
    font-size: 30px;
    font-weight: 800;
    text-align: center;
}

.btn.btn-primary {
    width: 100%;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 15px;
    background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA 51%, #77A1D3 100%);
    border: none;
    transition: 0.5s;
    background-size: 200% auto;

}


.btn.btn.btn-primary:hover {
    background-position: right center;
    color: #fff;
    text-decoration: none;
}



.btn.btn-primary:hover .fas.fa-arrow-right {
    transform: translate(15px);
    transition: transform 0.2s ease-in;
}

.form-control {
    color: white;
    background-color: #223C60;
    border: 2px solid transparent;
    height: 60px;
    padding-left: 20px;
    vertical-align: middle;
}

.form-control:focus {
    color: white;
    background-color: #0C4160;
    border: 2px solid #2d4dda;
    box-shadow: none;
}

.text {
    font-size: 14px;
    font-weight: 600;
}

::placeholder {
    font-size: 14px;
    font-weight: 600;
}
  </style>
</head>
<body>

    
    <?php
    if ($total_bayar['total'] >= $total_tagihan['nominal_spp']) {
        $status_spp = 'Lunas';
    }else{
        $status_spp = 'Belum Lunas';
    }
    ?>
<div class="container p-0">
        <div class="card px-4">
            <p class="h8 py-3">Pembayaran Sukses</p>
            <span class="text-center">ID : <?= $detail_pembayaran['id_spp'] . " ( ".$detail_pembayaran['status_spp']." )"?></span>
            <hr>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Nama Siswa</p>
                        <input class="form-control mb-3" type="text" value="<?= $detail_pembayaran['nama_siswa']?>">
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Sumber Dana</p>
                        <input class="form-control mb-3" type="text" value="<?php if($detail_pembayaran['id_sumber_dana'] == 1){ echo 'Tabungan';}else{ echo 'Tunai';}?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Tanggal Bayar</p>
                        <input class="form-control mb-3" type="text" value="<?= $detail_pembayaran['tanggal_transaksi']?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Bulan Tagihan</p>
                        <input class="form-control mb-3 pt-2 " type="text" value="<?= $detail_pembayaran['bulan_tagihan']?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Terbayar</p>
                        <input class="form-control mb-3" type="text" value="<?= number_format($total_bayar['total'])?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Total Tagihan</p>
                        <input class="form-control mb-3 pt-2 " type="text" value="<?= number_format($total_tagihan['nominal_spp'])?>">
                    </div>
                </div>
                <div class="col-12">
                    <div class="btn btn-primary mb-3">
                        <span class="ps-3">Nominal Transaksi : Rp <?= number_format($detail_pembayaran['nominal_transaksi'])?></span>
                    </div>
                </div>
                <div class="col-12">
                    <a class="btn btn-success mb-3 mt-2" href="<?= base_url('transaksi/spp/')?>">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

