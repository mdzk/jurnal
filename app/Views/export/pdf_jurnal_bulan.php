<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <style>
        body {
            font-family: serif;
            margin: 0;
            padding: 0;
        }

        .table-jurnal {
            margin-top: 40px;
        }

        .table-jurnal,
        .table-jurnal>thead>tr,
        .table-jurnal>tbody>tr,
        .table-jurnal>thead>tr>th,
        .table-jurnal>tbody>tr>td {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .table-jurnal>tbody>tr>td:nth-child(1) {
            width: 10px;
            text-align: center;
        }

        .table-jurnal>tbody>tr>td:nth-child(3) {
            width: 60px;
            text-align: center;
        }

        .table-jurnal>thead>tr>th,
        .table-jurnal>tbody>tr>td {
            padding: 10px;
        }

        .table-ttd {
            text-align: center;
            width: 100%;
            margin-top: 40px;
        }

        .table-ttd tr:nth-child(2) td {
            padding: 40px;
        }

        .table-ttd tr td:nth-child(1) {
            width: 50%;
        }

        h1 {
            font-size: 16pt;
            padding: 0;
            margin: 0 0 40px 0;
        }

        /* h1 {
            font-size: 16pt;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .h1>th {
            padding: 15px !important;
        }

        .h2>th {
            padding: 10px !important;
        }

        .h3>th {
            padding: 5px !important;
        }

        th {
            font-size: 14px;
            background-color: #D9D9D9;
        }

        td {
            font-size: 12px;
            padding: 5px;
        }

        .number {
            text-align: center;
            width: 20px;
        }

        .data>td:nth-child(2) {
            width: 200px;
        } */
        .data-header>td:nth-child(1) {
            width: 200px;
        }
    </style>
</head>

<body lang=EN-US>
    <h1 align="center">LAPORAN RAKAPITULASI BULANAN PEGAWAI<br> BAPPERIDA KABUPATEN TANGGAMUS</h1>
    <table width="100%">
        <tr class="data-header">
            <td>NAMA</td>
            <td colspan="3">: <?= $user['name']; ?></td>
        </tr>
        <tr class="data-header">
            <td>NIP</td>
            <td colspan="3">: <?= $user['nip']; ?></td>
        </tr>
        <tr class="data-header">
            <td>PANGKAT/GOLONGAN</td>
            <td colspan="3">: <?= $user['nama_golongan']; ?></td>
        </tr>
        <tr class="data-header">
            <td>UNIT KERJA</td>
            <td colspan="3">: <?= $user['unit']; ?></td>
        </tr>
        <tr class="data-header">
            <td>JABATAN</td>
            <td>: <?= $user['jabatan']; ?></td>
            <td>Tanggal</td>
            <td>: <?= $monthName = date('F', mktime(0, 0, 0, $bulan, 10));; ?> <?= $tahun; ?></td>
        </tr>
        <tr class="data-header">
            <td>KEPALA BIDANG</td>
            <td colspan="3">: <?= $user['kepala']; ?></td>
        </tr>
    </table>
    <table class="table-jurnal" width="100%" align="center">
        <thead>
            <tr class="h1">
                <th>No</th>
                <th>Waktu</th>
                <th>Durasi Jam & Menit</th>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Tempat</th>
                <th>Penyelenggara</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            $total_jam = 0;
            foreach ($jurnal as $data) : ?>
                <tr class="data">
                    <td><?= $i++; ?></td>
                    <td><?= date("H:i", strtotime($data['jam_mulai'])); ?> - <?= date("H:i", strtotime($data['jam_berakhir'])); ?></td>
                    <td><?php $start_date = new DateTime($data['jam_mulai']);
                        $since_start = $start_date->diff(new DateTime($data['jam_berakhir']));

                        echo $since_start->h . ' Jam ';
                        echo $since_start->i . ' Menit'; ?></td>
                    <td><?= date('d F Y', strtotime($data['tanggal'])); ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['tempat']; ?></td>
                    <td><?= $data['penyelenggara']; ?></td>
                </tr>
                <?php $total_jam += $since_start->h; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table class="table-ttd">
        <tr>
            <td>
                <span style="text-decoration: underline;">Penilaian Kepala Bidang Langsung :</span> <br>
                Sesuai fakta dan kepatuhan maka yang bersangkutan pada hari ini telah melaksanakan seluruh tugas selama <?= $total_jam; ?> jam.
                Mengetahui Kepala Bidang
            </td>
            <td>Tanggamus, <?= date('d F Y'); ?> <br>
                PNS Yang Bersangkutan</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><span style="text-decoration: underline;"><?= $user['kepala']; ?></span> <br>
                <p style="margin-top:5px;">NIP. ...............................</p>
            </td>
            <td><span style="text-decoration: underline;"><?= $user['name']; ?></span> <br>
                <p style="margin-top:5px;">NIP. <?= $user['nip']; ?></p>
            </td>
        </tr>
    </table>
</body>

</html>