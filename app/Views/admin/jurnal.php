<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Jurnal Harian</h3>
                <p class="text-subtitle text-muted">Berisi Daftar Jurnal Harian yang Telah Dibuat.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jurnal Harian</li>
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
                <a href="<?= base_url(); ?>jurnal/add" class="btn btn-primary btn-color rounded-pill mb-4">+ Jurnal Harian</a>
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Tempat</th>
                                <th>Penyelenggara</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Tempat</th>
                                <th>Penyelenggara</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1;
                            foreach ($jurnal as $data) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['nama']; ?></td>
                                    <td><?= $data['tanggal']; ?></td>
                                    <td><?= $data['jam_mulai']; ?> - <?= $data['jam_berakhir']; ?></td>
                                    <td><?= $data['tempat']; ?></td>
                                    <td><?= $data['penyelenggara']; ?></td>
                                    <td>
                                        <img src="<?= base_url(); ?>foto/<?= $data['foto'] ?>" style="width: 150px; height: 150px;object-fit: cover;">
                                    </td>
                                    <td>
                                        <ul class="list-inline m-0 d-flex">
                                            <li class="list-inline-item mail-delete">
                                                <a href="<?= base_url(''); ?>jurnal/edit/<?= $data['id_jurnal']; ?>" class="td-n btn c-deep-purple-500 cH-blue-500 fsz-md p-5">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item mail-unread">
                                                <button type="button" class="td-n btn c-red-500 cH-blue-500 fsz-md p-5" data-bs-toggle="modal" data-bs-target="#hapusjurnal<?= $data['id_jurnal']; ?>">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <!--Hapus User Modal Content -->
                                <div class="modal fade text-left modal-borderless" id="hapusjurnal<?= $data['id_jurnal']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Peringatan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>

                                            <form action="<?= route_to('jurnal-delete'); ?>" method="POST">

                                                <div class="modal-body">
                                                    <p>
                                                        Apakah anda yakin ingin menghapus jurnal harian ini?
                                                    </p>
                                                </div>
                                                <input type="number" name="id_jurnal" value="<?= $data['id_jurnal']; ?>" hidden>
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
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>