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
                        <th>No Pesanan</th>
                        <th>No Meja</th>
                        <th>Nama Pemesan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($pesanan as $p) : ?>
                    <tr class="text-center">
                        <td><?= $p['no_pesanan']; ?></td>
                        <td><?= $p['no_meja']; ?></td>
                        <td><?= $p['nama_pemesan']; ?></td>
                        <td><?= $p['status']; ?></td>
                        <td>
                        <a href="" class="pr-2" data-toggle="modal" data-target="#editModal<?= $p['no_pesanan']; ?>">Edit</a>
                        <a href="<?= base_url('pesanan/detail/') . $p['no_pesanan'];?>" class="pr-2" name="detail">Detail</a>
                        <a href="<?= base_url(); ?>pesanan/hapus/<?= $p['no_pesanan']; ?>" class="tombol-hapus">Delete</a>
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
      <form action="<?= base_url('pesanan/tambah'); ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
           <label>No Pesanan</label>
            <input type="text" class="form-control" id="no" name="no">
          </div>
           <div class="mb-3 form-group">
           <label>No Meja</label>
            <!-- <input type="text" class="form-control" id="no_meja" name="no_meja"> -->

            <select class="form-control" id="exampleFormControlSelect1" name="no_meja">
            <option>-- Pilih No Meja --</option>
            <?php foreach($noMeja as $n) : ?>
            <option><?= $n['no_meja']; ?></option>
            <?php endforeach; ?>
            </select>

          </div>
           <div class="mb-3 form-group">
           <label>Nama Pemesan</label>
            <input type="text" class="form-control" id="nama" name="nama">
          </div>
           <div class="mb-3 form-group">
           <label>Status</label>
           <select class="form-control" id="exampleFormControlSelect1" name="status">
            <option>-- Pilih Status --</option>
            <option>Menunggu</option>
            <option>Diproses</option>
            <option>Siap Diantar</option>
            <option>Selesai</option>
            </select>
            <!-- <input type="text" class="form-control" id="status" name="status"> -->
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
foreach ($pesanan as $p) : ?>
<div class="modal fade" id="editModal<?= $p['no_pesanan']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('pesanan/edit'); ?>" method="post">

            <input type="hidden" name="no" value="<?= $p['no_pesanan']; ?>">

            <div class = "text-danger">
            <p>No Pesanan tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>No Pesanan</label>
            <input type="text" class="form-control" id="no" name="no" value="<?= $p['no_pesanan']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>No Meja</label>
            <input type="text" class="form-control" id="no_meja" name="no_meja" value="<?= $p['no_meja']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Nama Pemesan</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $p['nama_pemesan']; ?>">
          </div>
           <div class="mb-3 form-group">
            <label>Status</label>
            <select class="form-control" id="exampleFormControlSelect1" name="status" value="<?= $p['status']; ?>">
            <option><?= $p['status']; ?></option>

            <?php if($p['status'] == 'Menunggu') : ?>
            <option>Diproses</option>
            <option>Siap Diantar</option>
            <option>Selesai</option>
            <?php endif; ?>

            <?php if($p['status'] == 'Diproses') : ?>
            <option>Menunggu</option>
            <option>Siap Diantar</option>
            <option>Selesai</option>
            <?php endif; ?>
            
            <?php if($p['status'] == 'Siap Diantar') : ?>
            <option>Menunggu</option>
            <option>Diproses</option>
            <option>Selesai</option>
            <?php endif; ?>

            <?php if($p['status'] == 'Selesai') : ?>
            <option>Menunggu</option>
            <option>Diproses</option>
            <option>Siap Diantar</option>
            <?php endif; ?>

            <!-- <option><?php if($p['status'] == 'Menunggu'){
              echo 'Diproses';
            }else if($p['status'] == 'Diproses'){
              echo 'Siap Diantar';
            }else if($p['status'] == 'Siap Diantar'){
              echo 'Selesai';
            }else {
              echo 'Menunggu';
            }; ?>
            </option> -->
            </select>
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

<!-- Detail Modal Component -->
<?php
foreach ($pesanan as $p) : ?>
<div class="modal fade" id="detailModal<?= $p['no_pesanan']; ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('pesanan/detail'); ?>" method="post">
        <div class="modal-body">
        <div class="mb-3 form-group">


        <!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>Id Detail</th>
                        <th>Kode Menu</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($detail as $d) : ?>
                  <tr class="text-center">
                        <td><?= $d['kode_menu']; ?></td>
                        <td><?= $d['qty']; ?></td>
                        <td>
                        <a href="" class="pr-2">Edit</a>
                        <a href="" name="hapus">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



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
<?php endforeach; ?>