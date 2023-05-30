<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Jurnal Harian</h3>
                <p class="text-subtitle text-muted">Dapat Menambahkan Data Jurnal Harian Baru</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jurnal</li>
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
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <form action="<?= route_to('jurnal-save'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">Capaian Kinerja</label>
                                <div class="position-relative">
                                    <select name="id_kinerja" class="form-control" id="kinerja">
                                        <?php foreach ($kinerja as $data) : ?>
                                            <option value="<?= $data['id_kinerja']; ?>"><?= $data['capaian']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Nama Kegiatan</label>
                                <div class="position-relative">
                                    <input type="text" name="nama" class="form-control" placeholder="Input Data Laporan" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Tempat</label>
                                <div class="position-relative">
                                    <input type="text" name="tempat" class="form-control" placeholder="Aula Lantai 2" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Tanggal</label>
                                <div class="position-relative">
                                    <input type="date" name="tanggal" class="form-control" placeholder="2023-01-01" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Jam Mulai</label>
                                <div class="position-relative">
                                    <input type="time" name="jam_mulai" class="form-control" placeholder="08:00" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Jam Berakhir</label>
                                <div class="position-relative">
                                    <input type="time" name="jam_berakhir" class="form-control" placeholder="15:00" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Penyelenggara</label>
                                <div class="position-relative">
                                    <input type="text" name="penyelenggara" class="form-control" placeholder="Pemerintah Kabupaten Tanggamus" id="name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Foto</label>
                                <div class="position-relative">
                                    <input type="file" name="foto" class="form-control" id="name" accept="image/png, image/jpeg">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button name="submit" type="submit" class="btn btn-primary btn-color ml-1">
                                <span class="d-sm-block">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>