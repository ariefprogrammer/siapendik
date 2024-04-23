<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">
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
                            <th>ID</th>
							<th>Tanggal</th>
							<th>Siswa</th>
							<th>Nominal</th>
							<th>Saldo Awal</th>
							<th>Saldo Akhir</th>
							<th>Pengguna</th>
							<!-- <th>Action</th> -->
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($hasil_setor as $value):?>
							<tr>
								<td><?= $value['id_riwayat_tabungan']?></td>
								<td><?= $value['tanggal_riwayat_tabungan']?></td>
								<td><?= $value['nama_siswa']?></td>
								<td><?= "Rp ".$value['nominal_transaksi']?></td>
								<td><?= "Rp ".$value['saldo_awal']?></td>
								<td><b><?= "Rp ".$value['saldo_akhir']?></b></td>
								<td><?= $value['name']?></td>
								<!-- <td>
									<a href="#" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('master/delete_siswa/').$value['id_siswa']?>" class="btn btn-danger btn-sm btn-flat"><i class="fas fa-trash"></i></a>
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#editSiswaModal<?= $value['id_siswa'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                </td> -->
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

