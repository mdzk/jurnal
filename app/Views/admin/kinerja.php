<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Capaian Kinerja</h3>
                <p class="text-subtitle text-muted">Berisi Daftar Kinerja yang Telah Dibuat.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kinerja</li>
                    </ol>
                </nav>
            </div>
        </div>
        <?php if ($errors = session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <?php foreach ($errors as $key => $value) { ?>
                    <li><?= esc($value) ?></li>
                <?php } ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <button class="btn btn-primary btn-color rounded-pill mb-4" data-bs-toggle="modal" data-bs-target="#tambahuser">+ Capaian Baru</button>
                <div class="modal fade text-left modal-borderless" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">

                        <form action="<?= route_to('kinerja-add'); ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Capaian Kinerja</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Capaian Kinerja</label>
                                        <div class="position-relative">
                                            <input type="text" name="capaian" class="form-control" placeholder="Membuat Laporan Pembelajaran" id="name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Realisasi Waktu</label>
                                        <div class="position-relative">
                                            <input type="text" name="realisasi" class="form-control" placeholder="8 Bulan" id="name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Kuantitas Output</label>
                                        <div class="position-relative">
                                            <input type="text" name="kuantitas" class="form-control" placeholder="3 Dokumen" id="name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Point</label>
                                        <div class="position-relative">
                                            <input type="number" name="point" class="form-control" placeholder="20" id="name">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-light-primary">
                                        <span class="d-sm-block">Reset</span>
                                    </button>
                                    <button name="submit" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                        <span class="d-sm-block">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Capaian Kinerja</th>
                                <th>Realisasi Waktu</th>
                                <th>Kuantitas</th>
                                <th>Point</th>
                                <?php if (session('role') == 'admin') : ?>
                                    <th>Nama User</th>
                                <?php endif; ?>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Capaian Kinerja</th>
                                <th>Realisasi Waktu</th>
                                <th>Kuantitas</th>
                                <th>Point</th>
                                <?php if (session('role') == 'admin') : ?>
                                    <th>Nama User</th>
                                <?php endif; ?>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1;
                            foreach ($kinerja as $data) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['capaian']; ?></td>
                                    <td><?= $data['realisasi']; ?></td>
                                    <td><?= $data['kuantitas']; ?></td>
                                    <td><?= $data['point']; ?></td>
                                    <?php if (session('role') == 'admin') : ?>
                                        <td><?= $data['name']; ?></td>
                                    <?php endif; ?>
                                    <td><span class="badge bg-<?= $data['status'] == 'pending' ? 'warning' : 'primary'; ?>"><?= $data['status']; ?></span></td>
                                    <td>
                                        <ul class="list-inline m-0 d-flex">
                                            <?php if ($data['status'] == 'pending') : ?>

                                                <li class="list-inline-item mail-delete">
                                                    <a href="<?= base_url(''); ?>kinerja/edit/<?= $data['id_kinerja']; ?>" class="td-n btn c-deep-purple-500 cH-blue-500 fsz-md p-5">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item mail-unread">
                                                    <button type="button" class="td-n btn c-red-500 cH-red-500 fsz-md p-5" data-bs-toggle="modal" data-bs-target="#hapuskinerja<?= $data['id_kinerja']; ?>">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </li>

                                                <!--Hapus User Modal Content -->
                                                <div class="modal fade text-left modal-borderless" id="hapuskinerja<?= $data['id_kinerja']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Peringatan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="<?= route_to('kinerja-delete'); ?>" method="POST">

                                                                <div class="modal-body">
                                                                    <p>
                                                                        Apakah anda yakin ingin menghapus capaian kinerja ini?
                                                                    </p>
                                                                </div>
                                                                <input type="number" name="id_kinerja" value="<?= $data['id_kinerja']; ?>" hidden>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-primary ml-1" data-bs-dismiss="modal">
                                                                        <span class="d-sm-block">Tidak</span>
                                                                    </button>
                                                                    <button name="submit" type="submit" class="btn btn-primary btn-color" data-bs-dismiss="modal">
                                                                        <span class="d-sm-block">Ya</span>
                                                                    </button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Hapus User Modal Content End-->
                                            <?php endif; ?>
                                            <?php if ($data['status'] == 'pending' && session('role') == 'admin') : ?>
                                                <li class="list-inline-item mail-unread">
                                                    <button type="button" class="td-n btn c-green-500 cH-green-500 fsz-md p-5" data-bs-toggle="modal" data-bs-target="#verifkinerja<?= $data['id_kinerja']; ?>">
                                                        <i class="ti-check"></i>
                                                    </button>
                                                </li>

                                                <!--Verifikasi Kinerja Modal Content -->
                                                <div class="modal fade text-left modal-borderless" id="verifkinerja<?= $data['id_kinerja']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Peringatan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="<?= route_to('kinerja-verif'); ?>" method="POST">

                                                                <div class="modal-body">
                                                                    <p>
                                                                        Apakah anda yakin ingin verifikasi capaian kinerja ini?
                                                                    </p>
                                                                </div>
                                                                <input type="number" name="id_kinerja" value="<?= $data['id_kinerja']; ?>" hidden>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-primary ml-1" data-bs-dismiss="modal">
                                                                        <span class="d-sm-block">Tidak</span>
                                                                    </button>
                                                                    <button name="submit" type="submit" class="btn btn-primary btn-color" data-bs-dismiss="modal">
                                                                        <span class="d-sm-block">Ya</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Verifikasi Kinerja Modal Content End-->
                                            <?php endif; ?>
                                        </ul>
                                    </td>
                                </tr>




                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>