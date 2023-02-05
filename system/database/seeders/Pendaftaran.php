<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Traits\ManagementRoler;
use App\Service\Control\ManagementCrud;

class Pendaftaran extends Seeder
{
    use ManagementRoler;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function n_digit_random($digits)
    {
        return rand(pow(10, $digits - 1) - 1, pow(10, $digits) - 1);
    }
    public function run()
    {
        $pathJson =  config('generator_crud_config.scema_path');
        $faker = \Faker\Factory::create();
        $th = ["2020-2021,I", "2022-2023,I", "2022-2023,II", "2023-2024,I", "2023-2024,II"];
        for ($xx = 0; $xx < 4; $xx++) {
            /*
            | BUAT DATA PENDAFTARAN
            |
            */
            $request = new \Illuminate\Http\Request();
            $info_daftar = new ManagementCrud("InformasiPendaftaran");
            $info_daftar->instance($pathJson);
            $info_daftar->setNameSpaceModel("\Modules\V1\Entities\\");
            // --------------------------------------------------------
            $info_daftar->setTesting();
            $info_daftar->setSeed();
            // --------------------------------------------------------

            $terpilih = $th[$xx];
            $request->replace([
                "pendaftaran" => "GELOMBANG " . explode(",", $terpilih)[1],
                "tahun" => explode("-", explode(",", $terpilih)[0])[0],
                "tahun_ajaran" => explode(",", $terpilih)[0],
                "informasi_umum" => "
                <ul>
                    <li>Untuk pendaftaran, silakan akses laman berikut:</li>
                    <li>Isi data dengan lengkap dan benar.</li>
                    <li>Penulisan email harap tidak diakhiri dengan spasi dan wajib menggunakan email dengan domain <strong>Gmail</strong></li>
                    <li>Setelah berhasil melakukan pendaftaran, Anda akan menerima email <strong>Konfirmasi Pendaftaran</strong> yang memuat informasi mengenai biaya pembayaran seleksi.</li>
                </ul>
                ",
                "brosur" => "imags/brosur/B0h4i9Q58aiVwB5L1674284271.jpg",
                "buka" => date("Y-m-d"),
                "tutup" => "2023-04-02",
                "biaya_pendaftaran" => '
                <p>Biaya pendaftaran sebesar <strong><span style="color: rgb(209, 72, 65);">Rp.</span></strong><strong><span style="color: rgb(209, 72, 65);">300.000</span></strong>&nbsp;dapat di trasfer ke rekening sbb</p>
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="width: 5.8751%;">1</td>
                            <td style="width: 38.7369%;">BNI</td>
                            <td style="width: 55.3262%;">0000000000000</td>
                        </tr>
                        <tr>
                            <td style="width: 5.8751%;">2</td>
                            <td style="width: 38.7369%;">BRI</td>
                            <td style="width: 55.3262%;">0000000000000</td>
                        </tr>
                        <tr>
                            <td style="width: 5.8751%;">3</td>
                            <td style="width: 38.7369%;">Mandiri</td>
                            <td style="width: 55.3262%;">0000000000000</td>
                        </tr>
                    </tbody>
                </table>
                <p>Setelah trasfer upload bukti pembayaran ke form yang disediakan</p>
                ',
                "kuota" => 10000,
            ]);
            // ---- exekusi
            $save =  $info_daftar->generate_data_insert($request);
            if (empty($save['data']))
                dd($save);
            /*
            | 
            | END DATA PENDAFTARAN
            */
            // ******************************************************
            /*
            | BUAT JADWAL
            |
            */
            $kegiatan = ["pendaftaran", "seleksi", "pendaftaran ulang", "pkkmb", "mulai kuliah"];
            foreach ($kegiatan as $jad) {
                $JADWAL = new ManagementCrud("Jadwal");
                $pathJson =  config('generator_crud_config.scema_path');
                $JADWAL->instance($pathJson);
                $JADWAL->setNameSpaceModel("\Modules\V1\Entities\\");
                $JADWAL->setTesting();
                $JADWAL->setSeed();
                $gender = $faker->randomElement(['L', 'P']);
                $request->replace([
                    "informasi_pendaftaran_id" => $save['data']['id'],
                    "kegiatan" => $jad,
                    "mulai" => date("Y-m-d H:s:i"),
                    "selesai" => date("Y-m-d H:s:i"),
                    "keterangan" =>  "---"
                ]);
                $J_save =  $JADWAL->generate_data_insert($request);
                if (empty($J_save['data']))
                    dd($J_save);
            }
            /*
            | 
            | END JADWAL
            */
            // ******************************************************
            /*
            | BUAT AGENT
            |
            */
            $id_agent = [];

            for ($vv = 0; $vv < 10; $vv++) {
                $agent = new ManagementCrud("Agent");
                $agent->instance($pathJson);
                $agent->setNameSpaceModel("\Modules\V1\Entities\\");
                $agent->setTesting();
                $agent->setSeed();
                $gender = $faker->randomElement(['L', 'P']);
                $na =  $faker->name;
                $request->replace([
                    "nik" => $faker->numerify('################'),
                    "nama_lengkap" => $na,
                    "jenis_kelamin" => $gender,
                    "no_rekening" => "00000000",
                    "nama_bank" => "testing",
                    "status_area" => "dalam kampus",
                    "saldo" =>  '0',
                    "referal" => \Str::random(5),
                    'nama' => $na,
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password' // password
                ]);
                $agent_save =  $agent->generate_data_insert($request);
                if (empty($agent_save['data']))
                    dd($agent_save);
                array_push($id_agent, $agent_save['data']["id"]);
            }
            /*
            | 
            | END AGENT
            */
            // ******************************************************
            /*
            | DAFTARKAN AKUN
            |
            */
            $prodi = \Modules\V1\Entities\Prodi::all();
            $id_prod = [];
            foreach ($prodi as $v) {
                array_push($id_prod, $v->id);
            }
            continue;
            for ($i = 0; $i < rand(1, 5); $i++) {
                $pendaftaran = new ManagementCrud("Pendaftaran");
                $pathJson =  config('generator_crud_config.scema_path');
                $pendaftaran->instance($pathJson);
                $pendaftaran->setNameSpaceModel("\Modules\V1\Entities\\");
                $pendaftaran->setTesting();
                $pendaftaran->setSeed();
                // BUAT BANYAK AKUN

                $nik = (string) $this->n_digit_random(16);
                $request->replace([
                    "no_resister" => "UNIKS:" . \Str::random(5),
                    "informasi_pendaftaran_id" => $save['data']['id'],
                    "prodi_id" =>  $id_prod[array_rand($id_prod)],
                    "nik" => $nik,
                    "agent_id" => $id_agent[array_rand($id_agent)],
                    'nama' => $faker->name,
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password',
                    "status" => ["pending", "valid", "invalid", "lulus", "tidak_lulus", "daftar_ulang"][array_rand(["pending", "valid", "invalid", "lulus", "tidak_lulus", "daftar_ulang"])]
                ]);
                $pen_save =  $pendaftaran->generate_data_insert($request);
                if (empty($pen_save['data']))
                    continue;
                if (!$roler = $this->newRole("api", "mahasiswa"))
                    return false;
                $m = User::find($pen_save['data']['user_id']);
                $this->createRole($m, $roler);
                /*
                | DAFTARKAN DATA MAHASISWA
                |
                */
                $C_MHS = new ManagementCrud("CalonMahasiswa");
                $pathJson =  config('generator_crud_config.scema_path');
                $C_MHS->instance($pathJson);
                $C_MHS->setNameSpaceModel("\Modules\V1\Entities\\");
                $C_MHS->setTesting();
                $C_MHS->setSeed();
                $gender = $faker->randomElement(['L', 'P']);
                $nama_csiswa = $faker->name;
                $request->replace([
                    "pendaftaran_id" => $pen_save['data']['id'],
                    "nik"           => $nik,
                    "nis"           => $faker->numerify('################'),
                    "npwp"          => $faker->numerify('################'),
                    "nama_lengkap" => $nama_csiswa,
                    "jenis_kelamin" => $gender,
                    "tempat_lahir" => 'sungai langsat',
                    "tanggal_lahir" => date("Y-m-d"),
                    "agama" => "islam",
                    "no_telepon" => "082284733404",
                    "asal_sekolah" => "SMK N 1 Teluk Kuantan",
                    "tahun_lulus" => "2016",
                    "alamat_lengkap" => $faker->address,
                    "provinsi" => "14",
                    "kabupaten" => "1401",
                    "kecamatan" => "1401051",
                    "kelurahan" => "1401051017",
                    "kode_pos" => "55555"
                ]);
                $c_save =  $C_MHS->generate_data_insert($request);
                if (empty($c_save['data']))
                    dd($c_save);
                /*
                | 
                | END DATA MAHASISWA
                */
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                /*
                | DATA LAMPIRAN
                |
                */
                $C_LAMPIRAN = new ManagementCrud("LampiranPendaftaran");
                $pathJson =  config('generator_crud_config.scema_path');
                $C_LAMPIRAN->instance($pathJson);
                $C_LAMPIRAN->setNameSpaceModel("\Modules\V1\Entities\\");
                $C_LAMPIRAN->setTesting();
                $C_LAMPIRAN->setSeed();
                $request->replace([
                    "pendaftaran_id" => $pen_save['data']['id'],
                    "foto_formal" => "seed/img/foto.jpg",
                    "sc_ktp" => rand(0, 1) == 1 ? "seed/pdf/ktp.pdf" : "seed/pdf/ktp.jpg",
                    "sc_kk" => rand(0, 1) == 1 ? "seed/pdf/kk.pdf" : "seed/pdf/ktp.jpg",
                    "sc_ijasa_skl" => rand(0, 1) == 1 ? "seed/pdf/skl.pdf" : "seed/pdf/ktp.jpg",
                    "sc_kip_kks_pkh" => rand(0, 1) == 1 ? "seed/img/foto.pdf" : '',
                    "lain_lain" => rand(0, 1) == 1 ? "seed/img/foto.pdf" : '',
                ]);
                $l_save =  $C_LAMPIRAN->generate_data_insert($request);
                if (empty($l_save['data']))
                    dd($l_save);
                /*
                | END DATA LAMPIRAN
                |
                */
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                /*
                | DATA ORANGTUA
                |
                */
                $C_ORTU = new ManagementCrud("OrangTua");
                $pathJson =  config('generator_crud_config.scema_path');
                $C_ORTU->instance($pathJson);
                $C_ORTU->setNameSpaceModel("\Modules\V1\Entities\\");
                $C_ORTU->setTesting();
                $C_ORTU->setSeed();
                $request->replace([
                    "calon_mahasiswa_id" => $c_save['data']['id'],
                    "nama_ayah"     => $faker->name,
                    "tempat_lahir_ayah"     => $faker->address,
                    "tanggal_lahir_ayah"        => date("Y-m-d"),
                    "no_telepon_ayah"       => "082200000000",
                    "pekerjaan_ayah"        => "pekerjaan",
                    "penghasilan_ayah"      => "6000000",
                    "alamat_lengkap_ayah"       => $faker->address,
                    "nama_ibu"      => $faker->name,
                    "tempat_lahir_ibu"      => $faker->address,
                    "tanggal_lahir_ibu"     => date("Y-m-d"),
                    "no_telepon_ibu"        => "0822",
                    "pekerjaan_ibu"     => "ibu rumah tangga",
                    "penghasilan_ibu"       => "0",
                    "alamat_lengkap_ibu"        =>  $faker->address,
                ]);
                $o_save =  $C_ORTU->generate_data_insert($request);
                if (empty($o_save['data']))
                    dd($o_save);
                /*
                | END DATA ORTU
                |
                */
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                /*
                | DATA BUKTI BAYAR
                |
                */
                $C_BUKTI = new ManagementCrud("BuktiPembayaran");
                $pathJson =  config('generator_crud_config.scema_path');
                $C_BUKTI->instance($pathJson);
                $C_BUKTI->setNameSpaceModel("\Modules\V1\Entities\\");
                $C_BUKTI->setTesting();
                $C_BUKTI->setSeed();
                $request->replace([
                    "pendaftaran_id" => $pen_save['data']['id'],
                    "bukti_pembayaran" => "seed/bukti/bukti.jpg",
                    "nama_bank" => "BRI",
                    "atas_nama" => $nama_csiswa,
                    "waktu_bayar" => date("Y-m-d H:s:i"),
                    "jumlah_tf" => "300000",
                    "keterangan" => "-"
                ]);
                $b_save =  $C_BUKTI->generate_data_insert($request);
                if (empty($b_save['data']))
                    dd($o_save);
                /*
                /*
                | END BUKTI BAYAR
                |
                */
            }
            /*
            | 
            | END DAFTARKAN AKUN
            */
        }
    }
}
