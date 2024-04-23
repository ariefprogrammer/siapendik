<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
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
	
<!-- Begin Page Content -->
	<div class="container-fluid">
        <form action="<?= base_url('transaksi/tabungan/'); ?>" method="post">
		<div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Transaksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select name="id_siswa" id="id_siswa" class="form-control select2">
                                <option value="">Pilih Siswa</option>
                                <?php foreach ($siswa as $s) : ?>
                                <option value="<?= $s['id_siswa']; ?>"><?= $s['nama_siswa'] ." ". "||" ." <b>".number_format($s['saldo'])."</b>"; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="id_jenis_transaksi" id="id_jenis_transaksi" class="form-control">
                                <option value="">Jenis Transaksi</option>
                                <?php foreach ($jenist as $j) : ?>
                                <option value="<?= $j['id_jenis_transaksi']; ?>"><?= $j['jenis_transaksi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <input type="number" class="form-control" name="nominal_transaksi" id="nominal_transaksi" placeholder="Nominal Transaksi">
                            </div>
                        </div>
                        <button type="submit" href="#" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                            <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Submit</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3 text-center">
                
            </div>
        </div>
        </form>

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
							<th>Jenis</th>
							<th>Nominal</th>
							<th>Pengguna</th>
							<!-- <th>Action</th> -->
						</tr>
					</thead>
					<tbody class="text-dark">
						<?php foreach($riwayat as $value):?>
							<tr>
                                <td><?= $value['id_riwayat_transaksi']?></td>
								<td><?= $value['tanggal_riwayat_transaksi']?></td>
								<td><?= $value['nama_siswa']?></td>
								<td><?= $value['jenis_transaksi']?></td>
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

