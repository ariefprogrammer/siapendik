<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <?php if (validation_errors()) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>
                <?= $this->session->flashdata('message'); ?>
            </h5>
        </div>
    <?php endif; ?>

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
                    <form action="<?= base_url('laporan/hasil_laporan_keuangan/'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tentukan rentang laporan</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="form-group row">
                                            <div class="form-group col-6">
                                                <label for="">Tgl Mulai</label>
                                                <input type="date" class="form-control" name="date_start" id="date_start" placeholder="Tanggal Mulai">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Tgl Selesai</label>
                                                <input type="date" class="form-control" name="date_finish" id="date_finish" placeholder="Tanggal Selesai">
                                            </div>
                                        </div>
                                        <button type="submit" href="#" class="btn btn-primary btn-icon-split btn-lg">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-arrow-right"></i>
                                            </span>
                                            <span class="text">Lihat Laporan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
			    </div>
			</div>
		</div>


	</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

