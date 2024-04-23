<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">

        <?php if (validation_errors()) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('message') != null){ ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('message'); ?>
            </div>
        <?php } ?>

		<!-- content here -->
		<div class="modal-body">
            <div class="form-group text-center mb-3">
                <a href="#" class="btn btn-dark btn-circle btn-lg">
                    <i class="fas fa-user"></i>
                </a>
            </div>
            <div class="form-group text-center">
                <h3><?= $siswa['nama_siswa']?></h3>
            </div>
            <div class="form-group mb-4">
                <div class="form-group mt-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp ".$siswa['saldo']?></div>
                                </div>
                                <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabku">
                <button class="tablinks active" onclick="openCity(event, 'Biodata')">Biodata</button>
                <button class="tablinks" onclick="openCity(event, 'Tabungan')">Tabungan</button>
                <button class="tablinks" onclick="openCity(event, 'SPP')">SPP</button>
                <button class="tablinks" onclick="openCity(event, 'Event')">Event</button>
            </div>

            <div id="Biodata" class="tabcontentku" style="display : block;">
                <div class="form-group mt-3">
                    <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $siswa['nisn']?>" readonly>
                </div>
                <div class="form-group">
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" readonly>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" <?php if($siswa['jenis_kelamin'] == 'L'){ echo "selected";}?>>L</option>
                        <option value="P" <?php if($siswa['jenis_kelamin'] == 'P'){ echo "selected";}?>>P</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="id_kelas" id="id_kelas" class="form-control" readonly>
                        <option value="">Pilih Kelas</option>
                        <?php foreach ($kelas as $k) : ?>
                        <option value="<?= $k['id_kelas']; ?>" <?= $k['id_kelas'] == $siswa['id_kelas'] ? 'selected' : '';?>><?= $k['kelas']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="no_whatsapp" id="no_whatsapp" value="<?= $siswa['no_whatsapp']?>" readonly>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="nama_wali" id="nama_wali" value="<?= $siswa['nama_wali']?>" readonly>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="wa_wali" id="wa_wali" value="<?= $siswa['wa_wali']?>" readonly>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" href="<?= "https://wa.me/62".$siswa['wa_wali']?>">Whatsapp Wali Murid</a>
                </div>
                
            </div>

            <div id="Tabungan" class="tabcontentku">
                <?php foreach ($tabungan as $key => $value) { ?>
                    <?php if ($value['id_jenis_transaksi'] == 1) {?>
                        <div class="form-group">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $value['tanggal_riwayat_transaksi']." (".$value['name'].")"?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp + ".$value['nominal_transaksi']?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{?>
                        <div class="form-group">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $value['tanggal_riwayat_transaksi']." (".$value['name'].")"?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp - ".$value['nominal_transaksi']?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    
                <?php } ?>
                
            </div>

            <div id="SPP" class="tabcontentku">
                <p>Siswa yang belum memiliki riwayat pembayaran (sama sekali) dibulan tersebut, tidak akan muncul di tabel "Kekurangan bayar"</p>
                <div class="col-12 mt-3 mb-3">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Tagihan</th>
                                <th>Terbayar</th>
                                <th>Kurang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            <?php foreach($rincianspp as $value):?>
                                <tr>
                                    <td><?= $value['bulan_tagihan']?></td>	
                                    <td><?= number_format($value['nominal_spp'])?></td>
                                    <td><?= number_format($value['terbayar'])?></td>
                                    <td><?= number_format($value['terbayar']-$value['nominal_spp'])?></td>
                                    <td><?= $value['status_spp']?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                
                <?php foreach ($spp as $key => $value) { ?>
                    <?php if ($value['id_sumber_dana'] == 1) {?>
                        <div class="form-group">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $value['tanggal_transaksi']?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $value['nominal_transaksi']?></div>
                                            <div class="text-xs font-weight-bold  mb-1">Sumber Dana : Tabungan</div>
                                            <div class="text-xs font-weight-bold  mb-1">Tagihan : <?= $value['bulan_tagihan']." (".$value['status_spp']." )" ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{?>
                        <div class="form-group">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $value['tanggal_transaksi']?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $value['nominal_transaksi']?></div>
                                        <div class="text-xs font-weight-bold mb-1">Sumber Dana : Tunai</div>
                                        <div class="text-xs font-weight-bold  mb-1">Tagihan : <?= $value['bulan_tagihan']." (".$value['status_spp']." )" ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    
                <?php } ?>
                
            </div>

            <div id="Event" class="tabcontentku">
            <p>Siswa yang belum memiliki riwayat pembayaran (sama sekali) di event tersebut, tidak akan muncul di tabel "Kekurangan bayar"</p>
            <div class="col-12 mt-3 mb-3">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Event</th>
                                <th>Tagihan</th>
                                <th>Terbayar</th>
                                <th>Kurang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            <?php foreach($rincianevent as $value):?>
                                <tr>
                                    <?php $kurang = $value['jumlah'] - $value['nominal'];?>
                                    <td><?= $value['nama_jenis_event']?></td>	
                                    <td><?= number_format($value['nominal'])?></td>
                                    <td><?= number_format($value['jumlah'])?></td>
                                    <td><?= number_format($kurang)?></td>
                                    <td><?php if($kurang >= 0){ echo "Lunas";}else{echo "Belum Lunas";}?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php foreach ($event as $key => $value) { ?>
                    <?php if ($value['id_sumber_dana'] == 1) {?>
                        <div class="form-group">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $value['tgl_transaksi']." (".$value['nama_jenis_event'].")"?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $value['nominal_transaksi']?></div>
                                            <div class="text-xs font-weight-bold  mb-1">Sumber Dana : Tabungan</div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{?>
                        <div class="form-group">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $value['tgl_transaksi']." (".$value['nama_jenis_event'].")"?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $value['nominal_transaksi']?></div>
                                        <div class="text-xs font-weight-bold mb-1">Sumber Dana : Tunai</div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    
                <?php } ?>
                
            </div>
            
        </div>


	</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontentku");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>