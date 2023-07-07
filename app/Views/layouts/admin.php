<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/static/images/logo.png" type="image/x-icon" />
    <link href="<?= base_url(); ?>assets/static/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <style>
        #loader {
            transition: all .3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden
        }

        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1s infinite ease-in-out;
            animation: sk-scaleout 1s infinite ease-in-out
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }

            100% {
                -webkit-transform: scale(1);
                opacity: 0
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0
            }
        }
    </style>
    <link href="<?= base_url(); ?>assets/static/css/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/static/css/select2.min.css" rel="stylesheet">
</head>

<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <script>
        window.addEventListener("load", (function() {
            const t = document.getElementById("loader");
            setTimeout((function() {
                t.classList.add("fadeOut")
            }), 300)
        }))
    </script>
    <div><!-- #Left Sidebar ==================== -->
        <div class="sidebar">
            <div class="sidebar-inner"><!-- ### $Sidebar Header ### -->
                <div class="sidebar-logo">
                    <div class="peers ai-c fxw-nw">
                        <div class="peer peer-greed"><a class="sidebar-link td-n" href="index.html">
                                <div class="peers ai-c fxw-nw">
                                    <div class="peer">
                                        <div class="logo"><img src="<?= base_url(); ?>assets/static/images/logo.png" alt=""></div>
                                    </div>
                                    <div class="peer peer-greed">
                                        <h5 class="lh-1 mB-0 logo-text">E-GaWai</h5>
                                    </div>
                                </div>
                            </a></div>
                        <div class="peer">
                            <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
                        </div>
                    </div>
                </div><!-- ### $Sidebar Menu ### -->
                <ul class="sidebar-menu scrollable pos-r">
                    <li class="nav-item <?= get_url(2, '') ? 'actived' : ''; ?>"><a class="sidebar-link" href="<?= route_to('home'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a></li>
                    <li class="nav-item <?= get_url(2, 'kinerja') ? 'actived' : ''; ?>"><a class="sidebar-link" href="<?= route_to('kinerja'); ?>"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">Capaian Kinerja</span></a></li>
                    <li class="nav-item <?= get_url(2, 'jurnal') ? 'actived' : ''; ?>"><a class="sidebar-link" href="<?= route_to('jurnal'); ?>"><span class="icon-holder"><i class="c-purple-500 ti-files"></i> </span><span class="title">Jurnal Harian</span></a></li>
                    <li class="nav-item <?= get_url(2, 'pegawai') ? 'actived' : ''; ?>"><a class="sidebar-link" href="<?= route_to('pegawai'); ?>"><span class="icon-holder"><i class="c-blue-500 ti-files"></i> </span><span class="title">Pegawai</span></a></li>
                    <?php if (session('role') == 'admin') : ?>
                        <li class="nav-item <?= get_url(2, 'users') ? 'actived' : ''; ?>"><a class="sidebar-link" href="<?= route_to('users'); ?>"><span class="icon-holder"><i class="c-green-500 fa fa-users"></i> </span><span class="title">Kelola Akun</span></a></li>
                    <?php endif; ?>
                    <li class="nav-item <?= get_url(2, 'setting') ? 'actived' : ''; ?>"><a class="sidebar-link" href="<?= route_to('setting'); ?>"><span class="icon-holder"><i class="c-brown-500 fa fa-gear"></i> </span><span class="title">Pengaturan</span></a></li>

                    <!-- <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">Pages</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="sidebar-link" href="blank.html">Blank</a></li>
                            <li><a class="sidebar-link" href="404.html">404</a></li>
                            <li><a class="sidebar-link" href="500.html">500</a></li>
                            <li><a class="sidebar-link" href="signin.html">Sign In</a></li>
                            <li><a class="sidebar-link" href="signup.html">Sign Up</a></li>
                        </ul>
                    </li> -->

                </ul>
            </div>
        </div><!-- #Main ============================ -->
        <div class="page-container"><!-- ### $Topbar ### -->
            <div class="header navbar">
                <div class="header-container">
                    <ul class="nav-left">
                        <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>
                        <!-- <li class="search-box"><a class="search-toggle no-pdd-right" href="javascript:void(0);"><i class="search-icon ti-search pdd-right-10"></i> <i class="search-icon-close ti-close pdd-right-10"></i></a></li>
                        <li class="search-input"><input class="form-control" type="text" placeholder="Search..."></li> -->
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown"><a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-bs-toggle="dropdown">
                                <!-- <div class="peer mR-10"><img class="w-2r bdrs-50p" src="<?= base_url(); ?>foto/<?= session('foto'); ?>" alt=""></div> -->
                                <div class="peer"><span class="fsz-sm c-grey-900"><?= session('name'); ?></span></div>
                            </a>
                            <ul class="dropdown-menu fsz-sm">
                                <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-user mR-10"></i> <span>Profile</span></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?= route_to('logout'); ?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- ### $App Screen Content ### -->
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <?= $this->renderSection('content'); ?>
                </div>
            </main><!-- ### $App Screen Footer ### -->
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © <?= date('Y'); ?></span></footer>
        </div>
    </div>
    <!-- Sweetalert -->
    <script src="<?= base_url(); ?>/assets/static/js/sweetalert2.min.js"></script>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            Swal.fire(
                'Berhasil!',
                '<?= session()->getFlashdata('pesan'); ?>',
                'success'
            )
        </script>
    <?php endif; ?>

    <script src="<?= base_url(); ?>assets/static/js/jquery-3.7.0.js"></script>
    <script src="<?= base_url(); ?>assets/static/js/select2.min.js"></script>
    <script>
        var dataJurnal = $.ajax({
            url: "<?= base_url() . 'api/terlaksana'; ?>",
            async: false,
            dataType: 'json'
        }).responseJSON;
        $(document).ready(function() {
            $('#kinerja').select2();
        });

        function formatNIP(event) {
            var input = document.getElementById('nip');

            // Menghapus semua karakter selain angka dari input
            var cleanInput = input.value.replace(/\D/g, '');

            // Memisahkan input menjadi bagian-bagian sesuai format
            var part1 = cleanInput.slice(0, 8);
            var part2 = cleanInput.slice(8, 14);
            var part3 = cleanInput.slice(14, 15);
            var part4 = cleanInput.slice(15, 18);

            // Menggabungkan bagian-bagian dengan spasi
            var formattedNIP = part1 + ' ' + part2 + ' ' + part3 + ' ' + part4;

            // Menghapus spasi tambahan jika ada
            if (event.keyCode === 8 || event.keyCode === 46) { // Tombol backspace atau hapus
                formattedNIP = formattedNIP.trim();
            }

            input.value = formattedNIP;
        }

        // Event listener untuk setiap perubahan pada nilai input
        document.getElementById('nip').addEventListener('input', formatNIP);

        // Event listener untuk tombol hapus atau backspace
        document.getElementById('nip').addEventListener('keydown', formatNIP);
        document.getElementById('nip').addEventListener('keyup', formatNIP);

    </script>
    <script src="<?= base_url(); ?>assets/static/js/main.js"></script>

</body>

</html>