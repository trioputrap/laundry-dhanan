<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            font-family: sans-serif;
        }

        table.inner-table, table.inner-table>tr,table.inner-table>tr>td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        h1,h2,h3,h4,h5 {
            margin: 0;
        }

        .logo-brand {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity .5s ease;
            transition: opacity .5s ease;
            font-weight: 900;
            font-size: 25px;
            letter-spacing: -1px;
            color: #031a61; }
        .logo-brand span {
            color: #727cf5;
            font-weight: 300; }
    </style>
</head>
<body>
    <table width="300px" align="center">
        <tr>
            <td colspan=3 style="text-align:center; font-size: 18px"><div class="logo-brand">Ceria<span>Laundry</span></div></td>
        </tr>
        <tr>
            <td colspan=3 style="text-align:center;">Jl. Janger No.31, Dauh Yeh Cani, Kec. Abiansemal, Kabupaten Badung, Bali 80352</td>
        </tr>
        <tr>
            <td colspan=3 style="text-align:center; font-size: 18px; padding-bottom: 32px">-------------------------------------------------</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ $pengerjaan->tanggal }}</td>
        </tr>
        <tr>
            <td>Karyawan</td>
            <td>:</td>
            <td>{{ $pengerjaan->pegawai->nama_pegawai }}</td>
        </tr>
        <tr>
            <td>ID Pelanggan</td>
            <td>:</td>
            <td>{{ $pengerjaan->id_konsumen }}</td>
        </tr>
        <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td>{{ $pengerjaan->konsumen->nama }}</td>
        </tr>
        <tr>
            <td>Layanan</td>
            <td>:</td>
            <td>{{ $pengerjaan->layanan->jenis_layanan }}</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td>{{ $pengerjaan->jumlah }}</td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td>Rp{{ number_format($pengerjaan->harga, 0, "", ".") }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>:</td>
            <td>Rp{{ number_format($pengerjaan->total_harga, 0, "", ".") }}</td>
        </tr>
        
        <tr>
            <td colspan=3 style="text-align:center; font-size: 18px; padding-top: 32px">-------------------------------------------------</td>
        </tr>
        <tr>
            <td colspan=3 align='center'>Terimakasih Atas Kepercayaan Anda Karena Telah Menggunakan Jasa Kami </td>
        </tr>
    </table>
    
    <script>
        window.print();
    </script>
</body>
</html>