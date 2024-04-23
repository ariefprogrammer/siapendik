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
							<th>Kelas</th>
							<th>Saldo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($siswa as $value):?>
							<tr>
								<td><?= $value['nisn']?></td>
								<td><?= $value['nama_siswa']?></td>
								<td><?= $value['kelas']?></td>
								<td><b><?= "Rp ".$value['saldo'] ?></b></td>
								<td>
									<a href="<?= base_url('laporan/detail_siswa/'.$value['id_siswa'])?>" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-eye"></i></a>
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