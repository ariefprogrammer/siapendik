<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">

		<?php if (validation_errors()) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>
                    <?= $this->session->flashdata('message'); ?>
                </h5>
            </div>
        <?php endif; ?>
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
								<td><b><?= "Rp ".$value['saldo'] ?></b></td>
								<td><?= $value['jenis_kelamin']?></td>
								<td><?= $value['id_kelas']?></td>
								<td><?= $value['nama_wali']?></td>
								<td><?= $value['wa_wali']?></td>
								<td>
									<a href="#" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('master/delete_siswa/').$value['id_siswa']?>" class="btn btn-danger btn-sm btn-flat"><i class="fas fa-trash"></i></a>
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