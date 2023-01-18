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
                if (!$roler = $this->newRole("api", "admin-fakultas"))
                    return false;
                $m = User::find($s['data']['user_id']);
                $this->createRole($m, $roler);
            }
        }
    }
}
