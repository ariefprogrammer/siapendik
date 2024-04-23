<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">

		<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPenggunaModal">Tambah Pengguna</button>
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
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($pengguna as $value):?>
							<tr>
								<td><?= $value['name']?></td>
								<td><?= $value['role']?></td>
								<td><?= $value['email']?></td>
								<td>
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#editPenggunaModal<?= $value['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#hapusPenggunaModal<?= $value['id'] ?>"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="newPenggunaModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPenggunaModalLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" method="post" action="<?= base_url('master/data_pengguna/'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">Pilih Tipe</option>
                            <?php foreach ($role as $r) : ?>
                            <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Modal Edit -->
<?php foreach ($pengguna as $key => $value) { ?>
<div class="modal fade" id="editPenggunaModal<?= $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPenggunaModalLabel">Edit <?= $value['name']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" method="post" action="<?= base_url('master/update_data_pengguna/'.$value['id']); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $value['name']?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $value['email']; ?>">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">Pilih Tipe</option>
                            <?php foreach ($role as $r) : ?>
                            <option value="<?= $r['id']; ?>" <?= $r['role'] == $value['role'] ? 'selected' : '';?>><?= $r['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 
<?php }?>
<!-- End Modal Edit -->

<!-- Modal Hapus -->
<?php foreach ($pengguna as $key => $value) { ?>
<div class="modal fade" id="hapusPenggunaModal<?= $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPenggunaModalLabel">Hapus <?= $value['name']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" method="post" action="<?= base_url('master/delete_pengguna/'.$value['id']); ?>">
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data ini?</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 
<?php }?>
<!-- End Modal Hapus -->

