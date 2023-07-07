<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
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
        }
    </style>
</head>

<body lang=EN-US>
    <h1 align="center">Daftar Urutan Kepangkatan (DUK) di Bapperida Kab.Tanggamus Tahun <?= date('Y'); ?></h1>
    <table width="100%" align="center">
        <thead>
            <tr class="h1">
                <th rowspan="2">NO</th>
                <th rowspan="2">NAMA</th>
                <th rowspan="2">NIP</th>
                <th colspan="2">JABATAN</th>
                <th rowspan="2">MASA KERJA</th>
                <th colspan="2">GOLONGAN PANGKAT</th>
                <th colspan="3">PENDIDIKAN</th>
            </tr>
            <tr class="h2">
                <th>JABATAN</th>
                <th>TMT JABATAN</th>
                <th>GOLONGAN PANGKAT</th>
                <th>TMT GOLONGAN PANGKAT</th>
                <th>TINGKAT PENDIDIKAN</th>
                <th>INSTANSI PENDIDIKAN</th>
                <th>TAHUN LULUS</th>
            </tr>
            <tr class="h3">
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($pegawai as $data) : ?>
                <tr class="data">
                    <td class="number"><?= $i++; ?></td>
                    <td><?= $data['nama_pegawai']; ?></td>
                    <td><?= get_nip($data['nip']); ?></td>
                    <td><?= $data['jabatan']; ?></td>
                    <td><?= $data['tmt_jabatan']; ?></td>
                    <td><?= $data['kerja_thn']; ?> Tahun <?= $data['kerja_bln']; ?> Bulan</td>
                    <td><?= $data['nama_golongan']; ?></td>
                    <td><?= $data['tmt_golongan']; ?></td>
                    <td><?= $data['pendidikan']; ?></td>
                    <td><?= $data['instansi_pendidikan']; ?></td>
                    <td><?= $data['thn_lulus']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>

</html>