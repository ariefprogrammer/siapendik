<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
	
<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- content here -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><?= $title." : ".$date_start. " sampai ".$date_finish?></h6>
			</div>
			<div class="card-body row">
				<!-- start card 1 -->
				<div class="col-xl-4 col-md-6 mb-4">
					<div class="card border-left-warning shadow h-100 py-2">
						<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Setor</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp ".$rekap_keuangan_masuk['nominal_masuk']; ?></div>
							</div>
							<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
							</div>
						</div>
						</div>
					</div>
				</div>
				<!-- end card 1 -->
				<!-- start card 2 -->
				<div class="col-xl-4 col-md-6 mb-4">
					<div class="card border-left-warning shadow h-100 py-2">
						<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Penarikan</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp ".$rekap_keuangan_keluar['nominal_keluar']; ?></div>
							</div>
							<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
							</div>
						</div>
						</div>
					</div>
				</div>
				<!-- end card 2 -->
				<!-- start card 3 -->
				<div class="col-xl-4 col-md-6 mb-4">
					<div class="card border-left-success shadow h-100 py-2">
						<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sisa Saldo</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp ".$sisa_saldo; ?></div>
							</div>
							<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
							</div>
						</div>
						</div>
					</div>
				</div>
				<!-- end card 3 -->
				<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Jenis Transaksi</th>
							<th>Total Transaksi</th>
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($rekap_all as $value):?>
							<tr>
								<td><?= $value['tanggal_riwayat_transaksi']?></td>
								<td><?= $value['jenis_transaksi']?></td>
								<td><?= "Rp ".$value['nominal']?></td>
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

