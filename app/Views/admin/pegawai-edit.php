<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Pegawai</h3>
                <p class="text-subtitle text-muted">Dapat Mengubah Data Pegawai</p>
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
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <form action="<?= route_to('pegawai-update'); ?>" method="POST" enctype="multipart/form-data">
                        <input required value="<?= $data['id_pegawai']; ?>" name="id_pegawai" hidden>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <div class="position-relative">
                                    <input required value="<?= $data['nama_pegawai']; ?>" type="text" name="nama" class="form-control" placeholder="John Doe" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">NIP</label>
                                <div class="position-relative">
                                    <input required value="<?= $data['nip']; ?>" type="number" name="nip" class="form-control" placeholder="1997110220201220" id="name">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Jabatan</label>
                                <div class="position-relative">
                                    <input required value="<?= $data['jabatan']; ?>" type="text" name="jabatan" class="form-control" placeholder="Pengelola Keuangan" id="name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Tamat Jabatan</label>
                                <div class="position-relative">
                                    <input required value="<?= $data['tmt_jabatan']; ?>" type="date" name="tmt_jabatan" class="form-control" placeholder="2023-01-01" id="name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Masa Kerja</label>
                                <div class="row">
                                    <div class="mb-6 col-md-6">
                                        <label class="form-label" for="inputZip">Tahun</label>
                                        <input required value="<?= $data['kerja_thn']; ?>" type="number" name="thn_masa_kerja" class="form-control" placeholder="17" id="inputZip">
                                    </div>
                                    <div class="mb-6 col-md-6">
                                        <label class="form-label" for="inputZip">Bulan</label>
                                        <input required value="<?= $data['kerja_bln']; ?>" type="number" name="bln_masa_kerja" class="form-control" id="inputZip" placeholder="0">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Golongan/Pangkat</label>
                                <div class="position-relative">
                                    <input required value="<?= $data['golongan']; ?>" type="text" name="golongan" class="form-control" placeholder="V/a" id="name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Tamat Golongan/Pangkat</label>
                                <div class="position-relative">
                                    <input required value="<?= $data['tmt_golongan']; ?>" type="date" name="tmt_golongan" class="form-control" placeholder="V/a" id="name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Tingkat Pendidikan</label>
                                <div class="position-relative">
                                    <select class="form-control" required name="pendidikan" id="">
                                        <option value="" disabled selected>-- Pilih Tingkat Pendidikan --</option>
                                        <option <?= $data['pendidikan'] == 'SLTA' ? 'selected' : ''; ?> value="SLTA">SLTA</option>
                                        <option <?= $data['pendidikan'] == 'DIPLOMA I' ? 'selected' : ''; ?> value="DIPLOMA I">DIPLOMA I</option>
                                        <option <?= $data['pendidikan'] == 'DIPLOMA II' ? 'selected' : ''; ?> value="DIPLOMA II">DIPLOMA II</option>
                                        <option <?= $data['pendidikan'] == 'DIPLOMA III' ? 'selected' : ''; ?> value="DIPLOMA III">DIPLOMA III</option>
                                        <option <?= $data['pendidikan'] == 'STRATA I' ? 'selected' : ''; ?> value="STRATA I">STRATA I</option>
                                        <option <?= $data['pendidikan'] == 'STRATA II' ? 'selected' : ''; ?> value="STRATA II">STRATA II</option>
                                        <option <?= $data['pendidikan'] == 'STRATA III' ? 'selected' : ''; ?> value="STRATA III">STRATA III</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Instansi Pendidikan</label>
                                <div class="position-relative">
                                    <input value="<?= $data['instansi_pendidikan']; ?>" required type="text" name="instansi_pendidikan" class="form-control" placeholder="Universitas Indonesia" id="name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Tahun Lulus</label>
                                <div class="position-relative">
                                    <input value="<?= $data['thn_lulus']; ?>" required type="number" name="thn_lulus" class="form-control" placeholder="2020" id="name">
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