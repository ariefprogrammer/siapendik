<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">
        <p>Sebelum anda melakukan transaksi, sebaiknya anda membuat data pembayaran terlebih dahulu agar semua siswa muncul pada bagian laporan. Ini bisa anda lakukan di awal semester secara sekaligus</p>

		<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKelasModal">Buat Data</button>
		<button class="btn btn-success mb-3">Import Excel</button>

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
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><?= $title?></h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Nama Event</th>
                            <th>Nominal</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($event as $value):?>
							<tr>
								<td><?= $value['nama_jenis_event']?></td>
                                <td><?= $value['nominal']?></td>
								<td><?php if($value['is_active'] == '0'){ echo "Tidak Aktif";}else{ echo "Aktif";}?></td>
								<td>
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#editEventModal<?= $value['id_jenis_event'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <a href="<?= base_url('master/delete_event/').$value['id_jenis_event']?>" class="btn btn-sm btn-flat btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
			</div>
		</div>


	</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newKelasModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Buat data SPP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/buatdata/'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Bulan tagihan</label>
                        <input type="month" class="form-control" id="bulan_tagihan" name="bulan_tagihan">
                    </div>
                    <div class="form-group">
                        <label for="">Kelas</label>
                        <div class="form-group">
                            <select name="id_kelas" id="id_kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k['id_kelas']; ?>"><?= $k['kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Buat data</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Modal Edit Kelas -->
<?php foreach ($event as $key => $value) {?>
    <div class="modal fade" id="editEventModal<?= $value['id_jenis_event'] ?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel">Edit <?= $value['nama_jenis_event'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('master/update_data_event/'.$value['id_jenis_event']); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_jenis_event" name="nama_jenis_event" value="<?= $value['nama_jenis_event'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="nominal" name="nominal" value="<?= $value['nominal'] ?>">
                        </div>
                        <div class="form-group">
                            <select id="is_active" name="is_active" class="form-control">
                                <option value="0" <?php if($value['is_active'] == '0'){ echo "selected";}?>>Tidak Aktif</option>
                                <option value="1" <?php if($value['is_active'] == '1'){ echo "selected";}?>>Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
<?php }?>
<!-- End Modal Edit Kelas -->