<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-sm-12 col-md-6">
<h1 class="h3 mb-4 ml-2 text-gray-800"><strong><?= $title; ?></strong></h1>
</div>
          
<div class="col-sm-12 col-md-6">
<a href="<?= base_url('pendapatan/excel'); ?>" role="button" class="float-right mr-2 btn btn-primary mb-4">Export To Excel</a>
</div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered mydatatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach($pendapatan as $p) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $p['tanggal']; ?></td>
                        <td><?= $p['pendapatan']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->