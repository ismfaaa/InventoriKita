<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #588133;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8faf2;
            color: #588133;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Dicetak pada: {{ $tanggal }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Usulan</th>
                <th>Nama Aset</th>
                <th>Tanggal Usulan</th>
                <th>Estimasi Biaya</th>
                <th>Status</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengadaans as $pengadaan)
            <tr>
                <td>{{ $pengadaan->id }}</td>
                <td>{{ $pengadaan->aset->nama_aset ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($pengadaan->tanggal_pengadaan)->format('d M Y') }}</td>
                <td>Rp {{ number_format($pengadaan->estimasi_biaya, 0, ',', '.') }}</td>
                <td>{{ ucfirst($pengadaan->status_pengadaan) }}</td>
                <td>{{ $pengadaan->feedback_pengadaan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dihasilkan oleh Sistem InventoriKita</p>
    </div>
</body>
</html>