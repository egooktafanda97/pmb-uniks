<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title>idCard</title>
    <style>
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url({{ storage_path('fonts\Poppins-Bold.ttf') }}) format("truetype");
        }

        html,
        body {
            margin: 10px;
            padding: 10px;
        }

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

        .font-kop {
            font-size: .5em;
            margin: 0;
            display: inline-block;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
        }

        span {
            margin: 0 !important;
            line-height: normal;
            font-family: Arial;
        }

        .tb {
            font-size: .5em;
            width: 100%;
        }

        .t_key {
            width: 25%;
            padding-left: 10px;
            font-weight: bold;
        }

        .sepalator {
            width: 2px;
        }
    </style>
</head>

<body>
    <div style="border:1px solid #000;">
        <table class=" table-borderless text-center" style="border:none; text-align:center; width:100%">
            <tbody>
                <tr>
                    <td style="width:100%;">
                        <img alt=""
                            src="https://uniks.ac.id/images/artikel/thumb/Persyaratan-Calon-Rektor-UNIKS.jpg"
                            style="width:35px; height: 35px; position: absolute;left: 25px; top:25px">
                        <font class="font-kop">
                            YAYASAN PERGURUAN TINGGI ISLAM KUANTAN SINGINGI <br>
                            UNIVERSITAS ISLAM KUANTAN SINGINGI
                            <br>
                            PANITIA PENERIMAAN MAHASISWA BARU
                            <br>
                            <small> <strong>Jl. Gatot Subroto KM. 7 Kebun Nenas, Desa Jake, Kec. Kuantan
                                    Tengah</strong></small>
                        </font>
                        <br />
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="hrz" style="height:2px;width:100%;background:#000;margin:0;">
        </div>
        <div style="height:1px;width:100%;background:#000;margin-top:1px;">
        </div>
        <center>
            <div style="font-family: 'Poppins', sans-serif; font-size: .55em; width:100%; color:#166ecc">
                <h3>KARTU PESERTA UJIAN PMB GELOMBANG I</h3>
            </div>
        </center>

        <table class="tb">
            <tr>
                <td class="t_key">NAMA</td>
                <td class="sepalator">:</td>
                <td class="t_val">Ego Oktafanda</td>
            </tr>
            <tr>
                <td class="t_key">NO. PESERTA</td>
                <td class="sepalator">:</td>
                <td class="t_val">Ego Oktafanda</td>
            </tr>
            <tr>
                <td class="t_key">ALAMAT</td>
                <td class="sepalator">:</td>
                <td class="t_val">Ego Oktafanda</td>
            </tr>
            <tr>
                <td class="t_key">No.Hp</td>
                <td class="sepalator">:</td>
                <td class="t_val">Ego Oktafanda</td>
            </tr>
            <tr>
                <td class="t_key">PILIHAN PRODI</td>
                <td class="sepalator">:</td>
                <td class="t_val">Ego Oktafanda</td>
            </tr>
        </table>
        <table class="tb">
            <tr>
                <td style="width: 60%">
                    <img alt="" src="https://pmb.kaptencode.com/assets/lampiran/88iSwXO5ywb4dTjC1675279102.jpg"
                        style="width:50px; height: 70px; margin-top: 10px; margin-left: 15px;">
                </td>
                <td align="right">
                    <div>
                        <center>
                            <font>
                                TELUK KUANTAN <br>
                                SEKRETARIAT PMB
                                <br>
                                <br>
                                <br>
                                ....................
                            </font>
                        </center>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
