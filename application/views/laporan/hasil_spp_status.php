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
							<th>Tagihan</th>
							<th>Siswa</th>
							<th>Kelas</th>
							<th>Total bayar</th>
							<th>Status</th>
							<!-- <th>Action</th> -->
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($hasil_transaksi as $value):?>
							<tr>
								<td><?= $value['bulan_tagihan']?></td>
								<td><?= $value['nama_siswa']?></td>
								<td><?= $value['kelas']?></td>
								<td><?= "Rp ".number_format($value['jumlah']);?></td>
								<td <?php if($value['status_spp'] == 'Belum Lunas'){ echo "class='bg-danger text-white'";}?>><?= $value['status_spp']?></td>
						</tr>
						<?php endforeach;?>
						<?php foreach($siswa_kosong as $value):?>
							<tr>
								<td><?= $bulan_tagihan?></td>
								<td><?= $value['nama_siswa']?></td>
								<td><?= $value['kelas']?></td>
								<td><?= "Rp 0";?></td>
								<td class='bg-danger text-white'><?= "Belum lunas"?></td>
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

