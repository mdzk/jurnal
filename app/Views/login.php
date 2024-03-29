<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/static/images/logo.png" type="image/x-icon" />

    <title>Sign In | E-GaWai</title>
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
    <script defer="defer" src="<?= base_url(); ?>assets/static/js/main.js"></script>
    <link href="<?= base_url(); ?>assets/static/css/style.css" rel="stylesheet">
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
    <div class="peers ai-s fxw-nw h-100vh">
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image:url("<?= base_url(); ?>assets/static/images/bg.jpg")'>
            <div class="pos-a centerXY">
                <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="<?= base_url(); ?>assets/static/images/logo.png" alt=""></div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
            <h4 class="fw-300 c-grey-900 mB-40">
                <center>E-GaWai</center>
            </h4>
            <h4 class="fw-300 c-grey-900 mB-40"><b>Login</b></h4>
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
            <?php endif; ?>
            <form action="<?= route_to('auth'); ?>" method="POST">
                <div class="mb-3"><label class="text-normal text-dark form-label">Email</label> <input type="email" class="form-control" name="email" placeholder="Masukkan email"></div>
                <div class="mb-3"><label class="text-normal text-dark form-label">Password</label> <input type="password" class="form-control" name="password" placeholder="Masukkan Password"></div>
                <a style="margin-bottom: 10px;display: block;" href="<?= base_url('forgot'); ?>">Lupa Password?</a>
                <div class="">
                    <div class="peers ai-c jc-sb fxw-nw">
                        <div class="peer">
                            <button type="submit" name="submit" class="btn btn-primary btn-color">Login</button>
                        </div>
                        <div class="peer">&nbsp;</div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>

</html>