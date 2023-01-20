<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Traits\ManagementRoler;
use App\Service\Control\ManagementCrud;

class Prodi extends Seeder
{
    use ManagementRoler;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new ManagementCrud("Prodi");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $data->setTesting();
        $faker = \Faker\Factory::create();
        $fakultas = \Modules\V1\Entities\Fakultas::all();
        foreach ($fakultas as $key => $value) {
            for ($i = 0; $i < 2; $i++) {
                $instansi = new \Illuminate\Http\Request();
                $instansi->replace([
                    'fakultas_id'  => $value->id,
                    "nama_prodi" => $faker->name,
                    'jenjang' => "S-1",
                    'akreditas' => "A",
                    "latar_belakang" => $faker->realText(500),
                    "visi_misi" => $faker->realText(500),
                    'tujuan' =>  $faker->realText(500),
                    'kurikulum' => "lorem",
                    'kepala_prodi' => "I",
                    'situs_web' => "http:://testing.com",
                    'nama' => $faker->name,
                    'username'    => $faker->userName,
                    'email' => $faker->unique()->safeEmail(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ]);
                $s =  $data->generate_data_insert($instansi);
                if (empty($s['data']))
                    dd($s);
                if (!$roler = $this->newRole("api", "admin-prodi"))
                    return false;
                $m = User::find($s['data']['user_id']);
                $this->createRole($m, $roler);
                for ($ix = 0; $ix < 3; $ix++) {
                    // /////////////////////////////
                    $_a = new ManagementCrud("BiayaKuliah");
                    $_apathJson =  config('generator_crud_config.scema_path');
                    $_a->instance($_apathJson);
                    $_a->setNameSpaceModel("\Modules\V1\Entities\\");
                    $_a->setTesting();
                    $biaya_kuliah = new \Illuminate\Http\Request();
                    $biaya_kuliah->replace([
                        "prodi_id" => $s['data']['id'],
                        "keterangan" => "keteragan " . $ix,
                        "jumlah" => $faker->randomDigit,
                        "deskripsi" => $faker->realText(200)
                    ]);
                    $a =  $_a->generate_data_insert($biaya_kuliah);
                    if (empty($a['data']))
                        dd($a);
                    // /////////////////////////////
                    // $_b = new ManagementCrud("GalleryProdi");
                    // $_bpathJson =  config('generator_crud_config.scema_path');
                    // $_b->instance($_bpathJson);
                    // $_b->setNameSpaceModel("\Modules\V1\Entities\\");
                    // $_b->setTesting();
                    // $gallery = new \Illuminate\Http\Request();
                    // $gallery->replace([
                    //     "prodi_id" => $s['data']['id'],
                    //     "gambar" => "default.jpg",
                    //     "keterangan" => "keteragan " . $ix,
                    //     "deskripsi" => $faker->realText(200)
                    // ]);
                    // $b =  $_b->generate_data_insert($gallery);
                    // if (empty($b['data']))
                    //     dd($b);
                    // /////////////////////////////
                    $_c = new ManagementCrud("PersyaratanProdi");
                    $_cpathJson =  config('generator_crud_config.scema_path');
                    $_c->instance($_cpathJson);
                    $_c->setNameSpaceModel("\Modules\V1\Entities\\");
                    $_c->setTesting();
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
    }
}
