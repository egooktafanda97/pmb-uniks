<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Traits\ManagementRoler;
use App\Service\Control\ManagementCrud;

class Universitas extends Seeder
{
    use ManagementRoler;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        | ADD FAKULTAS
        |
        */
        $fakultas = [
            "PERTANIAN" => ["AGRIBISNIS, AGB", "AGROTEKNOLOGI, AGT", "PETERNAKAN ,PETER"],
            "TARBIYAH DAN KEGURUAN" => ["PENDIDIKAN AGAMA ISLAM, PAI", "PENDIDIKAN KIMIA"],
            "SOSIAL" => ["ADMINITRASI NEGARA, ADM", "HUKUM", "PERBANKAN SYARI'AH, PBS"],
            "TEKNIK" => ["PERANCANAAN WILAYAH DAN KOTA, PWK", "SIPIL", "INFORMATIKA, TI"]
        ];
        foreach ($fakultas as $ky => $fak) {
            $data = new ManagementCrud("Fakultas");
            $pathJson =  config('generator_crud_config.scema_path');
            $data->instance($pathJson);
            $data->setNameSpaceModel("\Modules\V1\Entities\\");
            $data->setTesting();
            $data->setSeed();
            $faker = \Faker\Factory::create();
            $instansi = new \Illuminate\Http\Request();

            $instansi->replace([
                "nama_fakultas" => $ky,
                "info_fakultas" => $faker->realText(500),
                "visi_misi" => $faker->realText(500),
                'tujuan' =>  $faker->realText(500),
                'kepala_fakultas' => "Z",
                'situs_web' => "http:://testing.com",
                'nama' => $ky,
                'email' => $faker->unique()->safeEmail(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);
            $fk =  $data->generate_data_insert($instansi);
            if (empty($fk['data']))
                dd($fk);
            if (!$roler = $this->newRole("api", "admin-fakultas"))
                return false;
            $m = User::find($fk['data']['user_id']);
            $this->createRole($m, $roler);
            /*
            | ADD PRODI
            |
            */
            $inx = 0;
            foreach ($fak as  $value) {
                $data = new ManagementCrud("Prodi");
                $data->instance($pathJson);
                $data->setNameSpaceModel("\Modules\V1\Entities\\");
                $data->setTesting();
                $data->setSeed();
                $prod = new \Illuminate\Http\Request();
                $p_nama = $value;
                $alias =  $value;
                $p_names = explode(",", $value);
                if (count($p_names) > 1) {
                    $p_nama = $p_names[0];
                    $alias =  $p_names[1];
                }

                $prod->replace([
                    'fakultas_id'  => $fk["data"]["id"],
                    "nama_prodi" => $p_nama,
                    "nama_alias" => $alias,
                    'jenjang' => "S-1",
                    "gelar" => "S...",
                    'akreditas' => ["A", "B", "C"][array_rand(["A", "B", "BAIK"])],
                    "biaya" => "1000000",
                    "latar_belakang" => $faker->realText(500),
                    "visi_misi" => $faker->realText(500),
                    'tujuan' =>  $faker->realText(500),
                    'kurikulum' => $faker->realText(300),
                    'kepala_prodi' => "I",
                    'situs_web' => "http:://testing.com",
                    'nama' => $value,
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password' // password
                ]);
                $s =  $data->generate_data_insert($prod);
                if (empty($s['data']))
                    dd($prod->all());
                if (!$roler = $this->newRole("api", "admin-prodi"))
                    return false;
                $m = User::find($s['data']['user_id']);
                $this->createRole($m, $roler);
                $inx++;
                for ($ix = 0; $ix < 3; $ix++) {
                    // /////////////////////////////
                    $ket_biaya = ["biaya smester", "biaya praktek"];
                    foreach ($ket_biaya as $va) {
                        $_a = new ManagementCrud("BiayaKuliah");
                        $_apathJson =  config('generator_crud_config.scema_path');
                        $_a->instance($_apathJson);
                        $_a->setNameSpaceModel("\Modules\V1\Entities\\");
                        $_a->setTesting();
                        $_a->setSeed();
                        $biaya_kuliah = new \Illuminate\Http\Request();
                        $jml = ["1500000", "2000000", "2500000", "3000000"];
                        $biaya_kuliah->replace([
                            "prodi_id" => $s['data']['id'],
                            "keterangan" => $va,
                            "jumlah" => $jml[array_rand($jml)],
                            "deskripsi" => $faker->realText(200)
                        ]);
                        $a =  $_a->generate_data_insert($biaya_kuliah);
                        if (empty($a['data']))
                            dd($a);
                    }
                    // /////////////////////////////
                    for ($i = 0; $i < 5; $i++) {
                        $_b = new ManagementCrud("GalleryProdi");
                        $_bpathJson =  config('generator_crud_config.scema_path');
                        $_b->instance($_bpathJson);
                        $_b->setNameSpaceModel("\Modules\V1\Entities\\");
                        $_b->setTesting();
                        $_b->setSeed();
                        $gallery = new \Illuminate\Http\Request();
                        $gallery->replace([
                            "prodi_id" => $s['data']['id'],
                            "gambar" =>  "seed/pdf/gallery.jpg",
                            "keterangan" => "keteragan " . $ix,
                            "deskripsi" => $faker->realText(200)
                        ]);
                        $b =  $_b->generate_data_insert($gallery);
                        if (empty($b['data']))
                            dd($b);
                    }
                    // /////////////////////////////
                    for ($i = 0; $i < 2; $i++) {
                        $_c = new ManagementCrud("PersyaratanProdi");
                        $_cpathJson =  config('generator_crud_config.scema_path');
                        $_c->instance($_cpathJson);
                        $_c->setNameSpaceModel("\Modules\V1\Entities\\");
                        $_c->setTesting();
                        $_c->setSeed();
                        $persyaratan_prodi = new \Illuminate\Http\Request();
                        $persyaratan_prodi->replace([
                            "prodi_id" => $s['data']['id'],
                            "persyaratan" =>  $faker->name,
                            "keterangan" => $faker->realText(100)
                        ]);
                        $c =  $_c->generate_data_insert($persyaratan_prodi);
                        if (empty($c['data']))
                            dd($c);
                    }
                }
            }
            /*
            | 
            | END PRODI
            */
        }
        /*
        | 
        | END FAKULTAS
        */
    }
}
