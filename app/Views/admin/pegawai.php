<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pegawai</h3>
                <p class="text-subtitle text-muted">Berisi Daftar Pegawai.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pegawai</li>
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
                <a href="<?= base_url(); ?>pegawai/add" class="btn btn-primary btn-color rounded-pill mb-4">+ Pegawai Harian</a>
                <button class="btn btn-primary btn-color rounded-pill mb-4" data-bs-toggle="modal" data-bs-target="#tambahuser">Cetak Pegawai</button>
                <div class="modal fade text-left modal-borderless" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <form action="<?= route_to('pdf-pegawai'); ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cetak Pegawai</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Cetak Berdasarkan</label>
                                        <div class="position-relative">
                                            <select class="form-control" name="filter" id="">
                                                <option value="pangkat">Pangkat</option>
                                                <option value="jabatan">Jabatan</option>
                                                <option value="masa_kerja">Masa Kerja</option>
                                                <option value="pendidikan">Pendidikan</option>
                                            </select>
                                        </div>
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
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pegawai</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Tamat Jabatan</th>
                                    <th>Masa Kerja</th>
                                    <th>Golongan/Pangkat</th>
                                    <th>Tamat Golongan Pangkat</th>
                                    <th>Tingkat Pendidikan</th>
                                    <th>Instansi Pendidikan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pegawai</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Tamat Jabatan</th>
                                    <th>Masa Kerja</th>
                                    <th>Golongan/Pangkat</th>
                                    <th>Tamat Golongan Pangkat</th>
                                    <th>Tingkat Pendidikan</th>
                                    <th>Instansi Pendidikan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1;
                                foreach ($pegawai as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data['nama_pegawai']; ?></td>
                                        <td><?= $data['nip']; ?></td>
                                        <td><?= $data['jabatan']; ?></td>
                                        <td><?= $data['tmt_jabatan']; ?></td>
                                        <td><?= $data['kerja_thn']; ?> Tahun <?= $data['kerja_bln']; ?> Bulan</td>
                                        <td><?= $data['golongan']; ?></td>
                                        <td><?= $data['tmt_golongan']; ?></td>
                                        <td><?= $data['pendidikan']; ?></td>
                                        <td><?= $data['instansi_pendidikan']; ?></td>
                                        <td><?= $data['thn_lulus']; ?></td>
                                        <td>
                                            <ul class="list-inline m-0 d-flex">
                                                <li class="list-inline-item mail-delete">
                                                    <a href="<?= base_url(''); ?>pegawai/edit/<?= $data['id_pegawai']; ?>" class="td-n btn c-deep-purple-500 cH-blue-500 fsz-md p-5">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item mail-unread">
                                                    <button type="button" class="td-n btn c-red-500 cH-blue-500 fsz-md p-5" data-bs-toggle="modal" data-bs-target="#hapuspegawai<?= $data['id_pegawai']; ?>">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <!--Hapus User Modal Content -->
                                    <div class="modal fade text-left modal-borderless" id="hapuspegawai<?= $data['id_pegawai']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Peringatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>

                                                <form action="<?= route_to('pegawai-delete'); ?>" method="POST">

                                                    <div class="modal-body">
                                                        <p>
                                                            Apakah anda yakin ingin menghapus pegawai harian ini?
                                                        </p>
                                                    </div>
                                                    <input type="number" name="id_pegawai" value="<?= $data['id_pegawai']; ?>" hidden>
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
        </div>
    </section>
</div>
<?= $this->endSection(); ?>