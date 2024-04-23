<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Siswa</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $siswa['jumlah'];?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
              <a href="<?= base_url('Master/data_siswa')?>" class="btn btn-primary btn-sm col-12 mt-4">Details</a>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <?php if($spp['jumlah'] == null){ $spp['jumlah'] = 0;}?>
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total SPP</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp ".number_format($spp['jumlah']);?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
              </div>
              <a href="<?= base_url('transaksi/spp')?>" class="btn btn-success btn-sm col-12 mt-4">Details</a>
            </div>
          </div>
        </div>
        
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <?php if($tabungan['jumlah'] == null){ $tabungan['jumlah'] = 0;}?>
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tabungan Masuk</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp ".number_format($tabungan['jumlah']);?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
              </div>
              <a href="<?= base_url('transaksi/tabungan')?>" class="btn btn-warning btn-sm col-12 mt-4">Details</a>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <?php if($event['jumlah'] == null){ $event['jumlah'] = 0;}?>
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Event</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp ".number_format($event['jumlah']);?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
              </div>
              <a href="<?= base_url('transaksi/event')?>" class="btn btn-danger btn-sm col-12 mt-4">Details</a>
            </div>
          </div>
        </div>

      </div>
      <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Transaksi SPP bulan ini</h6>
              <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                  <div class="dropdown-header">Dropdown Header:</div>
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="chart-area"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <canvas id="myAreaChart" width="668" height="320" style="display: block; width: 668px; height: 320px;" class="chartjs-render-monitor"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Metode Pembayaran</h6>
              <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                  <div class="dropdown-header">Dropdown Header:</div>
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <canvas id="myPieChart" width="301" height="245" style="display: block; width: 301px; height: 245px;" class="chartjs-render-monitor"></canvas>
              </div>
              <div class="mt-4 text-center small">
                <span class="mr-2">
                  <i class="fas fa-circle text-primary"></i> Tunai
                </span>
                <span class="mr-2">
                  <i class="fas fa-circle text-success"></i> Tabungan
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- List belum lunas spp -->
        <div class="col-xl-6 col-lg-6">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Belum Lunas SPP bulan ini</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Terbayar</th>
                      <th>Kurang</th>
                    </tr>
                  </thead>
                  <tbody class="text-dark">
                  <?php foreach($spp_nol as $a):?>
                      <tr>
                        <td><?= $a['nama_siswa']?></td>
                        <td><?= $a['kelas']?></td>
                        <td><?= 0?></td>
                        <td><?= '-'.$a['nominal_spp']?></td>
                    </tr>
                    <?php endforeach;?>
                    <?php foreach($list_spp_belum_lunas as $value):?>
                      <tr>
                        <td><?= $value['nama_siswa']?></td>
                        <td><?= $value['kelas']?></td>
                        <td><?= $value['jumlah']?></td>
                        <td><?= $value['jumlah'] - $value['nominal_spp']?></td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- End list belum lunas -->

        <!-- List sudah lunas spp -->
        <div class="col-xl-6 col-lg-6">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Lunas SPP bulan ini</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Terbayar</th>
                    </tr>
                  </thead>
                  <tbody class="text-dark">
                    <?php foreach($list_spp_lunas as $value):?>
                      <tr>
                        <td><?= $value['nama_siswa']?></td>
                        <td><?= $value['kelas']?></td>
                        <td><?= $value['jumlah']?></td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- End list sudah lunas -->
      </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 
<script>
  var tabungan = <?= $jumlahtransaksispptabungan;?>;
  var tunai = <?= $jumlahtransaksispptunai;?>;

  var tanggal = [<?php foreach ($transaksispp as $key => $value) {echo "'"."$value[tanggal_transaksi]"."',";}?>];
  var nominal = [<?php foreach ($transaksispp as $key => $value) {echo "'"."$value[jumlah]"."',";}?>];
</script>

<!-- $str = "2024-03-17";
$hasil = explode("-",$str);
echo $hasil[1]; -->

