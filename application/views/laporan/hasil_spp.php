<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- content here -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><?= $title . " : ".$bulan_tagihan ?></h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tgl Transaksi</th>
							<th>Tagihan</th>
							<th>Siswa</th>
							<th>Dana</th>
							<th>Nominal</th>
							<th>Pengguna</th>
							<!-- <th>Action</th> -->
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($hasil_transaksi as $value):?>
							<tr>
								<td><?= $value['id_spp']?></td>
								<td><?= $value['tanggal_transaksi']?></td>
								<td><?= $value['bulan_tagihan']?></td>
								<td><?= $value['nama_siswa']?></td>
								<td><?php if($value['id_sumber_dana'] == 1){ echo "Tabungan";}else{ echo "Tunai";}?></td>
								<td><?= "Rp ".number_format($value['nominal_transaksi']);?></td>
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

