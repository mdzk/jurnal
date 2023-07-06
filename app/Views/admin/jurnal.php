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
        <?php if ($errors = session()->getFlashdata('not-found')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <li><?= $errors ?></li>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <a href="<?= base_url(); ?>jurnal/add" class="btn btn-primary btn-color rounded-pill mb-4">+ Jurnal Harian</a>
                <button class="btn btn-primary btn-color rounded-pill mb-4" data-bs-toggle="modal" data-bs-target="#tambahuser">Cetak Jurnal Harian</button>
                <div class="modal fade text-left modal-borderless" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <form action="<?= route_to('pdf-jurnal'); ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cetak Jurnal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Pilih Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button name="submit" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                        <span class="d-sm-block">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <button class="btn btn-primary btn-color rounded-pill mb-4" data-bs-toggle="modal" data-bs-target="#cetakbulan">Cetak Jurnal Bulanan</button>
                <div class="modal fade text-left modal-borderless" id="cetakbulan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <form action="<?= route_to('pdf-jurnal-bulan'); ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cetak Jurnal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Pilih Bulan</label>
                                        <select name="bulan" class="form-control">
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Pilih Tahun</label>
                                        <select name="tahun" class="form-control">
                                            <?php for ($x = $jurnal_lama; $x <= $jurnal_terbaru; $x++) : ?>
                                                <option name="bulan" value="<?= $x; ?>"><?= $x; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
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
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <?php if (session('role') == 'admin' || session('role') == 'pimpinan') : ?>
                                    <th>Nama User</th>
                                    <th>Unit Kerja</th>
                                <?php endif; ?>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Tempat</th>
                                <th>Penyelenggara</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Kerja</th>
                                <?php if (session('role') == 'admin' || session('role') == 'pimpinan') : ?>
                                    <th>Nama User</th>
                                    <th>Unit Kegiatan</th>
                                <?php endif; ?>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Tempat</th>
                                <th>Penyelenggara</th>
                                <th>Status</th>
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
                                    <?php if (session('role') == 'admin' || session('role') == 'pimpinan') : ?>
                                        <td><?= $data['name']; ?></td>
                                        <td><?= $data['unit']; ?></td>
                                    <?php endif; ?>
                                    <td><?= $data['tanggal']; ?></td>
                                    <td><?= $data['jam_mulai']; ?> - <?= $data['jam_berakhir']; ?></td>
                                    <td><?= $data['tempat']; ?></td>
                                    <td><?= $data['penyelenggara']; ?></td>
                                    <td><span class="badge bg-<?= $data['status'] == 'pending' ? 'warning' : 'primary'; ?>"><?= $data['status']; ?></span></td>
                                    <td>
                                        <img src="<?= base_url(); ?>foto/<?= $data['foto'] ?>" style="width: 150px; height: 150px;object-fit: cover;">
                                    </td>
                                    <td>
                                        <ul class="list-inline m-0 d-flex">
                                            <?php if ($data['status'] == 'pending' || session('role') == 'admin') : ?>
                                                <?php if ($data['status'] == 'pending') : ?>
                                                    <li class="list-inline-item mail-delete">
                                                        <a href="<?= base_url(''); ?>jurnal/edit/<?= $data['id_jurnal']; ?>" class="td-n btn c-deep-purple-500 cH-blue-500 fsz-md p-5">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <li class="list-inline-item mail-unread">
                                                    <button type="button" class="td-n btn c-red-500 cH-blue-500 fsz-md p-5" data-bs-toggle="modal" data-bs-target="#hapusjurnal<?= $data['id_jurnal']; ?>">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </li>

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
                                            <?php endif; ?>

                                            <?php if ($data['status'] == 'pending' && session('role') == 'admin') : ?>
                                                <li class="list-inline-item mail-unread">
                                                    <button type="button" class="td-n btn c-green-500 cH-green-500 fsz-md p-5" data-bs-toggle="modal" data-bs-target="#verifjurnal<?= $data['id_jurnal']; ?>">
                                                        <i class="ti-check"></i>
                                                    </button>
                                                </li>

                                                <!--Verifikasi Jurnal Harian Modal Content -->
                                                <div class="modal fade text-left modal-borderless" id="verifjurnal<?= $data['id_jurnal']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Peringatan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="<?= route_to('jurnal-verif'); ?>" method="POST">

                                                                <div class="modal-body">
                                                                    <p>
                                                                        Apakah anda yakin ingin verifikasi jurnal harian ini?
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
                                                <!--Verifikasi Jurnal Harian Modal Content End-->
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