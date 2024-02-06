<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
<div class="tflash-data" data-tflashdata="<?= $this->session->flashdata('tambah'); ?>"></div>

<!-- Page Heading -->
<div class="row">
<div class="col-sm-12 col-md-6">
<h1 class="h3 mb-4 ml-2 text-gray-800"><strong><?= $title; ?></strong></h1>
</div>
          
<div class="col-sm-12 col-md-6">
<!-- <a href="" class="float-right mr-2 btn btn-primary mb-4" data-toggle="modal" data-target="#dataModal">Tambah Data</a> -->
</div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered mydatatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No Transaksi</th>
                        <th>No Pesanan</th>
                        <th>Id Pegawai</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($transaksi as $t) : ?>
                    <tr class="text-center">
                        <td><?= $t['no_transaksi']; ?></td>
                        <td><?= $t['no_pesanan']; ?></td>
                        <td><?= $t['id_pegawai']; ?></td>
                        <td><?= $t['tanggal']; ?></td>
                        <td><?= $t['total']; ?></td>
                        <td><?= $t['metode_pembayaran']; ?></td>
                        <td>
                        <!-- <a href="" class="pr-2" data-toggle="modal" data-target="#editModal<?= $t['no_transaksi']; ?>">Edit</a> -->
                        <a href="<?= base_url(); ?>transaksi/hapus/<?= $t['no_transaksi']; ?>" class="tombol-hapus">Delete</a>
                        </td>
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

<!-- Tambah Modal Component -->
<div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dataModalLabel">Tambah Data Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('transaksi/tambah'); ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
           <label>No Transaksi</label>
            <input type="text" class="form-control" id="no" name="no">
          </div>
           <div class="mb-3 form-group">
           <label>Id Detail</label>
            <input type="text" onchange="ubah()" class="form-control" id="id_detail" name="id_detail">
          </div>
           <div class="mb-3 form-group">
           <label>Id Pegawai</label>
            <input type="text" class="form-control" id="id_pegawai" name="id_pegawai">
          </div>
           <div class="mb-3 form-group">
           <label>Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
          </div>
           <div class="mb-3 form-group">
           <label>Total Harga</label>
            <input type="text" class="form-control" id="harga" name="harga">
          </div>
           <div class="mb-3 form-group">
           <label>Metode Pembayaran</label>
            <input type="text" class="form-control" id="metode" name="metode">
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal Component -->
<?php
foreach ($transaksi as $t) : ?>
<div class="modal fade" id="editModal<?= $t['no_transaksi']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('transaksi/edit'); ?>" method="post">

            <input type="hidden" name="no" value="<?= $t['no_transaksi']; ?>">

            <div class = "text-danger">
            <p>No Transaksi tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>No Transaksi</label>
            <input type="text" class="form-control" id="no" name="no" value="<?= $t['no_transaksi']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>No Pesanan</label>
            <input type="text" class="form-control" id="id_detail" name="id_detail" value="<?= $t['no_pesanan']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Id Pegawai</label>
            <input type="text" class="form-control" id="id_pegawai" name="id_pegawai" value="<?= $t['id_pegawai']; ?>">
          </div>
           <div class="mb-3 form-group">
            <label>Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $t['tanggal']; ?>">
          </div>
           <div class="mb-3 form-group">
            <label>Total Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="<?= $t['total']; ?>">
          </div>
           <div class="mb-3 form-group">
            <label>Metode Pembayaran</label>
            <input type="text" class="form-control" id="metode" name="metode" value="<?= $t['metode_pembayaran']; ?>">
          </div> 
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?php 
 $queryTransaksi = "SELECT
 `t_menu`.`harga_menu`*
 `t_detail_pesanan`.`qty` AS `total`, 
 `t_detail_pesanan`.`id_detail`
 FROM
 `t_menu`,
 `t_detail_pesanan`
 WHERE `t_menu`.`kode_menu` = `t_detail_pesanan`.`kode_menu`";

$trans= $this->db->query($queryTransaksi)->result_array();
?>

<!-- <script>
function ubah() {
  // const x = "<?= $name ?>"
  const v = document.getElementById("id_detail").value;
  const x = <?= print_r($trans[1]['total']); ?>

  document.getElementById("harga").value = x;
}
</script> -->