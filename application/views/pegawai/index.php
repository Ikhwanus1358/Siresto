<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
<div class="tflash-data" data-tflashdata="<?= $this->session->flashdata('tambah'); ?>"></div>

<style>
.hidetext { -webkit-text-security: disc; /* Default */ }
</style>

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
                        <th>Id Pegawai</th>
                        <th>Nama Pegawai</th>
                        <th>Bagian</th>
                        <th>Password</th>
                        <th>Role Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($pegawai as $p) : ?>
                    <tr class="text-center">
                        <td><?= $p['id_pegawai']; ?></td>
                        <td><?= $p['nama_pegawai']; ?></td>
                        <td><?= $p['bagian']; ?></td>
                        <td class="hidetext"><?= $p['password']; ?></td>
                        <td><?= $p['role_id']; ?></td>
                        <td>
                        <a href="" class="pr-2" data-toggle="modal" data-target="#editModal<?= $p['id_pegawai']; ?>">Edit</a>
                        <a href="<?= base_url(); ?>pegawai/hapus/<?= $p['id_pegawai']; ?>" class="tombol-hapus">Delete</a>
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
        <h5 class="modal-title" id="dataModalLabel">Tambah Data Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('pegawai/tambah'); ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
           <label>Id Pegawai</label>
            <input type="text" class="form-control" id="id" name="id">
          </div>
           <div class="mb-3 form-group">
           <label>Nama Pegawai</label>
            <input type="text" class="form-control" id="nama" name="nama">
          </div>
           <div class="mb-3 form-group">
           <label>Bagian</label>
            <input type="text" class="form-control" id="bagian" name="bagian">
          </div>
           <div class="mb-3 form-group">
           <label>Password</label>
            <input type="text" class="form-control" id="password" name="password">
          </div>
           <div class="mb-3 form-group">
           <label>Role Id</label>
            <input type="text" class="form-control" id="role" name="role">
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
foreach ($pegawai as $p) : ?>
<div class="modal fade" id="editModal<?= $p['id_pegawai']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('pegawai/edit'); ?>" method="post">

            <input type="hidden" name="no" value="<?= $p['id_pegawai']; ?>">

            <div class = "text-danger">
            <p>Id pegawai tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>Id Pegawai</label>
            <input type="text" class="form-control" id="id" name="id" value="<?= $p['id_pegawai']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Nama Pegawai</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $p['nama_pegawai']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Bagian</label>
            <input type="text" class="form-control" id="bagian" name="bagian" value="<?= $p['bagian']; ?>">
          </div>
           <div class="mb-3 form-group">
            <label>Password</label>
            <input type="text" class="form-control" id="password" name="password" value="<?= $p['password']; ?>">
          </div>
           <div class="mb-3 form-group">
            <label>Role Id</label>
            <input type="text" class="form-control" id="role" name="role" value="<?= $p['role_id']; ?>">
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