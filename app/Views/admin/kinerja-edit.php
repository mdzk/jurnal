<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Capaian Kinerja</h3>
                <p class="text-subtitle text-muted">Dapat Mengubah Data Capaian Kinerja yang Diinginkan</p>
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
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <form action="<?= route_to('kinerja-update'); ?>" method="POST">
                        <input value="<?= $kinerja['id_kinerja']; ?>" name="id_kinerja" hidden>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">Capaian Kinerja</label>
                                <div class="position-relative">
                                    <input value="<?= $kinerja['capaian']; ?>" type="text" name="capaian" class="form-control" placeholder="Membuat Laporan Pembelajaran" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Realisasi Waktu</label>
                                <div class="position-relative">
                                    <input value="<?= $kinerja['realisasi']; ?>" type="text" name="realisasi" class="form-control" placeholder="8 Bulan" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Kuantitas Output</label>
                                <div class="position-relative">
                                    <input value="<?= $kinerja['kuantitas']; ?>" type="text" name="kuantitas" class="form-control" placeholder="3 Dokumen" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Point</label>
                                <div class="position-relative">
                                    <input value="<?= $kinerja['point']; ?>" type="number" name="point" class="form-control" placeholder="20" id="name">
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