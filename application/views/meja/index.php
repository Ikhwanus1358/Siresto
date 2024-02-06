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
<a href="" class="float-right mr-2 btn btn-primary mb-4" data-toggle="modal" data-target="#dataModal">Tambah Data</a>
</div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered mydatatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No Meja</th>
                        <th>Jumlah Kursi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($meja as $m) : ?>
                    <tr class="text-center">
                        <td><?= $m['no_meja']; ?></td>
                        <td><?= $m['jumlah_kursi']; ?></td>
                        <td><?= $m['status']; ?></td>
                        <td>
                        <a href="" class="pr-2" data-toggle="modal" data-target="#editModal<?= $m['no_meja']; ?>">Edit</a>
                        <a href="<?= base_url(); ?>meja/hapus/<?= $m['no_meja']; ?>" class="tombol-hapus">Delete</a>
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
        <h5 class="modal-title" id="dataModalLabel">Tambah Data Meja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('meja/tambah'); ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
           <label>No Meja</label>
            <input type="text" class="form-control" id="no" name="no">
          </div>
           <div class="mb-3 form-group">
           <label>Jumlah Kursi</label>
            <input type="text" class="form-control" id="kursi" name="kursi">
          </div>
           <div class="mb-3 form-group">
           <label>Status</label>
           <select class="form-control" id="exampleFormControlSelect1" name="status">
            <option>-- Pilih Status --</option>
            <option>Kosong</option>
            <option>Isi</option>
            </select>
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
foreach ($meja as $m) : ?>
<div class="modal fade" id="editModal<?= $m['no_meja']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('meja/edit'); ?>" method="post">

            <input type="hidden" name="no" value="<?= $m['no_meja']; ?>">

            <div class = "text-danger">
            <p>No meja tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>No Meja</label>
            <input type="text" class="form-control" id="no" name="no" value="<?= $m['no_meja']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Jumlah Kursi</label>
            <input type="text" class="form-control" id="kursi" name="kursi" value="<?= $m['jumlah_kursi']; ?>">
          </div>
           <div class="mb-3 form-group">
            <label>Status</label>
            <select class="form-control" id="exampleFormControlSelect1" name="status" value="<?= $m['status']; ?>">
            <option><?= $m['status']; ?></option>
            <option><?= $m['status'] == 'Isi' ? 'Kosong' : 'Isi' ?></option>
            </select>
            <!-- <input type="text" class="form-control" id="status" name="status" value="<?= $m['status']; ?>"> -->
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