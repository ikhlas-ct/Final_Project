<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Logbook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .info-table {
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px 10px;
            border: none;
        }
    </style>
</head>

<body>
    <h3>Logbook Bimbingan</h3>

    <table style="width: 30%" class="info-table">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $nama }}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td>{{ $nim }}</td>
        </tr>
    </table>

    <table id="example" class="table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembimbing</th>
                <th>Tanggal Bimbingan</th>
                <th>Kegiatan</th>
                <th>Detail Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mergeData as $key => $item)
                @foreach ($item['logbook'] as $logbook)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['nama_dosen'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($item['tanggal_bimbingan'])->translatedFormat('d F Y') }}</td>
                        <td>{{ $logbook['kegiatan'] }}</td>
                        <td>{{ $logbook['detail_kegiatan'] }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
