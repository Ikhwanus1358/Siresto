    <div class="container">
        <div class="lflash-data" data-lflashdata="<?= $this->session->flashdata('login'); ?>"></div>

        <!-- Outer Row -->
        <div class="row justify-content-center mx-auto mt-5">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-2">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4 text-gray-900 mb-3"><strong><i class="fas fa-store mr-3"></i> SI Resto</strong></h1>
                                        <h1 class="h4 text-gray-900 mb-4">Login Pegawai</h1>
                                    </div>

                                    <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user rounded-0"
                                                id="username" name="username"
                                                placeholder="Id"
                                                >
                                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user rounded-0"
                                                id="password" name="password" placeholder="Password">
                                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block rounded-0">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

  