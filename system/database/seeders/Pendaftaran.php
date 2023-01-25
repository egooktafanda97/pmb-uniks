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
        $pendafataran = \Modules\V1\Entities\InformasiPendaftaran::create(
            [
                "pendaftaran" => "GELOMBANG I",
                "informasi_umum" => "lorem",
                "brosur" => "assets/imags/brosur/B0h4i9Q58aiVwB5L1674284271.jpg",
                "buka" => date("Y-m-d"),
                "tutup" => "2023-04-02",
                "biaya_pendaftaran" => "lorem",
                "kuota" => 10000,
                "status" => "active"
            ]
        );
        $data = new ManagementCrud("Pendaftaran");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $data->setTesting();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 3; $i++) {
            $instansi = new \Illuminate\Http\Request();
            $gender = $faker->randomElement(['L', 'P']);
            $instansi->replace([
                "no_resister" => \Str::random(5),
                "informasi_pendaftaran_id" => $pendafataran->id,
                "nik" => (string) $this->n_digit_random(16),
                'nama' => $faker->name,
                'username'    => $faker->userName,
                'email' => $faker->unique()->safeEmail(),
                'password' => 'password',
            ]);
            $s =  $data->generate_data_insert($instansi);
            if (empty($s['data']))
                dd($s);
            if (!$roler = $this->newRole("api", "mahasiswa"))
                return false;
            $m = User::find($s['data']['user_id']);
            $this->createRole($m, $roler);
        }
    }
}
