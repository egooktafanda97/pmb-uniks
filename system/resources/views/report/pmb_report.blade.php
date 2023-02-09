<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title>Laporan</title>
    <style>
        .table {
            border-collapse: collapse;
            font-size: .8em;
            width: 100%;
            table-layout: fixed;
        }

        .table tr:nth-child(even) {
            background: #f1f7f8;
        }

        .table th,
        .table td {
            border: 1px solid #a0c8cf;
            text-align: center;
            padding: 5px;
        }

        .table th {
            background: #74afb9;
            color: #fff;
        }

        .table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media print {

            @page {
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }

            body {
                -webkit-print-color-adjust: exact;
            }

            #hrz {
                height: 4px;
                width: 100%;
                background: #000;
                margin: 0;
            }

        }
    </style>
</head>

<body>
    <table class=" table-borderless text-center" style="border:none; text-align:center; width:100%">
        <tbody>
            <tr>
                <td style="width:100%">
                    <img alt="" src="https://uniks.ac.id/images/artikel/thumb/Persyaratan-Calon-Rektor-UNIKS.jpg"
                        style="width: 40px; height: 40px; position: absolute;left: 1.6cm">
                    <h4 style="margin:0"><span style="font-size:16px"><span
                                style="font-family:Times New Roman,Times,serif">YAYASAN PERGURUAN TINGGI ISLAM KUANTAN
                                SINGINGI</span></span><br />
                        <span style="font-size:18px"><span style="font-family:Times New Roman,Times,serif">UNIVERSITAS
                                ISLAM KUANTAN SINGINGI</span></span><br />
                        <span style="font-size:16px"><strong><span
                                    style="font-family:Times New Roman,Times,serif">PANITIA PENERIMAAN MAHASISWA
                                    BARU</span></strong></span><br />
                        <em><span style="font-size:11px"><span style="font-family:Times New Roman,Times,serif">Jl. Gatot
                                    Subroto KM. 7 Kebun Nenas, Desa Jake, Kec. Kuantan Tengah</span></span></em>
                    </h4>
                </td>
            </tr>
        </tbody>
    </table>
    <div id="hrz" style="height:4px;width:100%;background:#000;margin:0;">
    </div>
    <div style="height:2px;width:100%;background:#000;margin-top:2px;">
    </div>

    {{--  --}}
    <div style="width: 100%; display: flex; justify-content: center;align-items: center; flex-direction: column">
        <h4 style="margin: 3px; margin-top: 15px">Daftar Rekapitulasi Penerimaan Mahasiswa Baru</h4>
        <h4 style="margin: 3px">Universitas Islam Kuantan Singingi</h4>
        <h5 style="margin: 3px">{{ $info_pendaftaran->pendaftaran ?? '-' }}, TA.
            {{ $info_pendaftaran->tahun_ajaran ?? '-' }}</h5>
    </div>
    <table class="table">
        <tr>
            <th style="width: 3%">No</th>
            <th style="width: 20%; text-align: left">Program Studi</th>
            @foreach ($head as $item)
                <th>{{ $item }}</th>
            @endforeach
        </tr>
        @foreach ($result as $prod => $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="width: 20%; text-align: left">{{ $prod }}</td>
                @foreach ($item as $items)
                    <td>{{ $items }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</body>

</html>
