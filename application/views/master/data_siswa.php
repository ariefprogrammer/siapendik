<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">

		<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSiswaModal">Tambah Siswa</button>
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
							<th>NISN</th>
							<th>Nama</th>
							<th>Saldo</th>
							<th>JK</th>
							<th>Kelas</th>
							<th>Wali</th>
							<th>Telp Wali</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($siswa as $value):?>
							<tr>
								<td><?= $value['nisn']?></td>
								<td><?= $value['nama_siswa']?></td>
								<td><?= "Rp ".$value['saldo'] ?></td>
								<td><?= $value['jenis_kelamin']?></td>
								<td><?= $value['kelas']?></td>
								<td><?= $value['nama_wali']?></td>
								<td><?= $value['wa_wali']?></td>
								<td>
									<a href="<?= base_url('master/detail_siswa/'.$value['id_siswa'])?>" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-eye"></i></a>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#hapusSiswaModal<?= $value['id_siswa'] ?>"><i class="fas fa-trash"></i></button>
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#editSiswaModal<?= $value['id_siswa'] ?>"><i class="fas fa-pencil-alt"></i></button>
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
<div class="modal fade" id="newSiswaModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/data_siswa/'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa">
                    </div>
					<div class="form-group">
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                    </div>
					<div class="form-group">
                        <select name="id_kelas" id="id_kelas" class="form-control">
                            <option value="">Pilih Kelas</option>
                            <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k['id_kelas']; ?>"><?= $k['kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
					<div class="form-group">
                        <input type="number" class="form-control" name="no_whatsapp" id="no_whatsapp" placeholder="Telp Siswa">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control" name="nama_wali" id="nama_wali" placeholder="Nama Wali">
                    </div>
					<div class="form-group">
                        <input type="number" class="form-control" name="wa_wali" id="wa_wali" placeholder="Telp Wali">
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

<!-- Modal edit -->
<?php foreach ($siswa as $key => $value) { ?>
<div class="modal fade" id="editSiswaModal<?= $value['id_siswa']?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Edit <?= $value['nama_siswa']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/update_data_siswa/'.$value['id_siswa']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $value['nisn']?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $value['nama_siswa']?>">
                    </div>
					<div class="form-group">
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" <?php if($value['jenis_kelamin'] == 'L'){ echo "selected";}?>>L</option>
                            <option value="P" <?php if($value['jenis_kelamin'] == 'P'){ echo "selected";}?>>P</option>
                        </select>
                    </div>
					<div class="form-group">
                        <select name="id_kelas" id="id_kelas" class="form-control">
                            <option value="">Pilih Kelas</option>
                            <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k['id_kelas']; ?>" <?= $k['id_kelas'] == $value['id_kelas'] ? 'selected' : '';?>><?= $k['kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
					<div class="form-group">
                        <input type="number" class="form-control" name="no_whatsapp" id="no_whatsapp" value="<?= $value['no_whatsapp']?>">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control" name="nama_wali" id="nama_wali" value="<?= $value['nama_wali']?>">
                    </div>
					<div class="form-group">
                        <input type="number" class="form-control" name="wa_wali" id="wa_wali" value="<?= $value['wa_wali']?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<?php }?>
<!-- End Modal Edit -->

<!-- Modal hapus -->
<?php foreach ($siswa as $key => $value) { ?>
<div class="modal fade" id="hapusSiswaModal<?= $value['id_siswa']?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Hapus <?= $value['nama_siswa']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/delete_siswa/'.$value['id_siswa']); ?>" method="post">
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<?php }?>
<!-- End Modal Hapus -->