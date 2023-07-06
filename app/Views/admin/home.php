<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="page-heading">
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item w-100">
            <div class="row gap-20">
                <!-- <div class="col-md-3">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Total Visits</h6>
                        </div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash"></span></div>
                                <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">+10%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Total Page Views</h6>
                        </div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash2"></span></div>
                                <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">-7%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Unique Visitor</h6>
                        </div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash3"></span></div>
                                <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">~12%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Bounce Rate</h6>
                        </div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash4"></span></div>
                                <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">33%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
                <h2>Dashboard</h2>
                <div class="col-md-8">
                 

                    <header style= "background:#008B8B ; color: #fff; padding: 10px; text-align: center;"> E-GaWai</header>

                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Data Profile</h6>
                        </div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="row w-100">
                                    <div class="col-md-3">
                                        <img style="max-width:150px;max-height:150px;width:100%; height:100%; object-fit: cover; object-position: center;" src="<?= base_url(); ?>foto/<?= $user['picture']; ?>" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <table>
                                            <thead>
                                                <tr>
                                 <th>Nama</th>
                                                    <td>&nbsp;: <?= $user['name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>NIP</th>
                                                    <td>&nbsp;: <?= $user['nip']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Pangkat/Golongan</th>
                                                    <td>&nbsp;: <?= $user['nama_golongan']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Jabatan</th>
                                                    <td>&nbsp;: <?= $user['jabatan']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Unit Kerja</th>
                                                    <td>&nbsp;: <?= $user['unit']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Atasan</th>
                                                    <td>&nbsp;: <?= $user['kepala']; ?></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="layers bd bgc-white p-20">
                                <div class="layer w-100 mB-10">
                                    <h6 class="lh-1">Bounce Rate</h6>
                                </div>
                                <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                        <div class="peer peer-greed"><span id="sparklinedash4"></span></div>
                                        <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">33%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="layers bd bgc-white p-20">
                                <div class="layer w-100 mB-10">
                                    <h6 class="lh-1">Bounce Rate</h6>
                                </div>
                                <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                        <div class="peer peer-greed"><span id="sparklinedash4"></span></div>
                                        <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">33%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <?php if (session('role') == 'user') : ?>
                <div class="bgc-white bd bdrs-3 p-20 mB-20 mt-5">
                    <div class="row">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Jurnal Harian</h6>
                        </div>
                        <div class="col-12">
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
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($jurnal as $data) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $data['nama']; ?></td>
                                            <?php if (session('role') == 'admin' || session('role') == 'pimpinan') : ?>
                                                <td><?= $data['name']; ?></td>
                                                <td><?= $data['unit']; ?> </td>
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
            <?php endif; ?>
        </div>
        <?php if (session('role') == 'user') : ?>
            <div class="masonry-item col-md-12"><!-- #Monthly Stats ==================== -->
                <div class="bd bgc-white">
                    <div class="layers">
                        <div class="layer w-100 pX-20 pT-20">
                            <h6 class="lh-1">Statistik Kegiatan Pegawai</h6>
                        </div>
                        <div class="layer w-100 p-20"><canvas id="line-chart" height="220"></canvas></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?= $this->endSection(); ?>