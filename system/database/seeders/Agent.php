<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Traits\ManagementRoler;
use App\Service\Control\ManagementCrud;

class Agent extends Seeder
{
    use ManagementRoler;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new ManagementCrud("Agent");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $data->setTesting();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $instansi = new \Illuminate\Http\Request();
            $gender = $faker->randomElement(['L', 'P']);
            $instansi->replace([
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $gender,
                'referal' => "uniks-".rand(2,1000),
                'nama' => $faker->name,
                'username'    => $faker->userName,
                'email' => $faker->unique()->safeEmail(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);
            $s =  $data->generate_data_insert($instansi);
            if (empty($s['data']))
                dd($s);
            if (!$roler = $this->newRole("api", "agent"))
                return false;
            $m = User::find($s['data']['user_id']);
            $this->createRole($m, $roler);
        }
    }
}
