<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">

		<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKelasModal">Tambah Kelas</button>
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
							<th style="width:80px;">ID Kelas</th>
							<th>Kelas</th>
                            <th>Nominal SPP</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($kelas as $value):?>
							<tr>
								<td><?= $value['id_kelas']?></td>
								<td><?= $value['kelas']?></td>
                                <td><?= $value['nominal_spp']." / bulan"?></td>
								<td>
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#editKelasModal<?= $value['id_kelas'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#hapusKelasModal<?= $value['id_kelas'] ?>"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title" id="newMenuModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/data_kelas/'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Nama Kelas">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="nominal_spp" name="nominal_spp" placeholder="Nominal SPP">
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
<?php foreach ($kelas as $key => $value) {?>
    <div class="modal fade" id="editKelasModal<?= $value['id_kelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel">Edit <?= $value['kelas'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('master/update_data_kelas/'.$value['id_kelas']); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $value['kelas'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="nominal_spp" name="nominal_spp" value="<?= $value['nominal_spp'] ?>" placeholder="Nominal Spp">
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
<?php foreach ($kelas as $key => $value) {?>
    <div class="modal fade" id="hapusKelasModal<?= $value['id_kelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel">Hapus <?= $value['kelas'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('master/delete_kelas/'.$value['id_kelas']); ?>" method="post">
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