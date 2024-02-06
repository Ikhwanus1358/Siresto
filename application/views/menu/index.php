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
                        <th>Kode Menu</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Jumlah Ketersediaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($menu as $m) : ?>
                    <tr class="text-center">
                        <td><?= $m['kode_menu']; ?></td>
                        <td><?= $m['nama_menu']; ?></td>
                        <td><?= $m['harga_menu']; ?></td>
                        <td><?= $m['status']; ?></td>
                        <td><?= $m['jumlah_ketersediaan']; ?></td>
                        <td>
                        <a href="" class="pr-2" data-toggle="modal" data-target="#editModal<?= $m['kode_menu']; ?>">Edit</a>
                        <a href="<?= base_url(); ?>menu/hapus/<?= $m['kode_menu']; ?>" class="tombol-hapus">Delete</a>
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
        <h5 class="modal-title" id="dataModalLabel">Tambah Data Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/tambah'); ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
           <label>Kode Menu</label>
            <input type="text" class="form-control" id="kode" name="kode">
          </div>
           <div class="mb-3 form-group">
           <label>Nama Menu</label>
            <input type="text" class="form-control" id="nama" name="nama">
          </div>
           <div class="mb-3 form-group">
           <label>Harga Menu</label>
            <input type="text" class="form-control" id="harga" name="harga">
          </div>
           <div class="mb-3 form-group">
           <label>Status</label>
           <select class="form-control" id="exampleFormControlSelect1" name="status">
            <option>-- Pilih Status --</option>
            <option>Tersedia</option>
            <option>Kosong</option>
            </select>
          </div>
           <div class="mb-3 form-group">
           <label>Jumlah Ketersediaan</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah">
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
foreach ($menu as $m) : ?>
<div class="modal fade" id="editModal<?= $m['kode_menu']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('menu/edit'); ?>" method="post">

            <input type="hidden" name="menu" value="<?= $m['kode_menu']; ?>">

            <div class = "text-danger">
            <p>Kode Menu tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>Kode Menu</label>
            <input type="text" class="form-control" id="kode" name="kode" value="<?= $m['kode_menu']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Nama Menu</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $m['nama_menu']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Harga Menu</label>
            <input type="text" class="form-control" id="harga" name="harga" value="<?= $m['harga_menu']; ?>">
          </div>
           <div class="mb-3 form-group">
            <label>Status</label>
            <select class="form-control" id="exampleFormControlSelect1" name="status" value="<?= $m['status']; ?>">
            <option><?= $m['status']; ?></option>
            <option><?= $m['status'] == 'Tersedia' ? 'Kosong' : 'Tersedia' ?></option>
            </select>
          </div>
           <div class="mb-3 form-group">
           <label>Jumlah Ketersediaan</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $m['jumlah_ketersediaan']; ?>">
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