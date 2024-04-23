<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">

		<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKelasModal">Tambah Event</button>
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
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#hapusEventModal<?= $value['id_jenis_event'] ?>"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title" id="newMenuModalLabel">Tambah Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/data_event/'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_jenis_event" name="nama_jenis_event" placeholder="Nama Event">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Nominal tagihan">
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

<!-- Modal Hapus Kelas -->
<?php foreach ($event as $key => $value) {?>
    <div class="modal fade" id="hapusEventModal<?= $value['id_jenis_event'] ?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel">Hapus <?= $value['nama_jenis_event'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('master/delete_event/'.$value['id_jenis_event']); ?>" method="post">
                    <div class="modal-body">
                    <p>Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus permanen</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
<?php }?>
<!-- End Modal Hapus Kelas -->