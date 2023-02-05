<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // php artisan migrate:refresh --seed
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \DB::unprepared(file_get_contents(storage_path("sql/wilayah.sql")));
        // referensi permision
        // https://spatie.be/docs/laravel-permission/v5/basic-usage/middleware

        $dir = new \DirectoryIterator(config('generator_crud_config.scema_path_dirname'));
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $f = explode(".", $fileinfo->getFilename());
                \Illuminate\Support\Facades\Artisan::call('module:make-model ' . $f[0] . ' V1');
                \Illuminate\Support\Facades\Artisan::call('module:make-controller ' . $f[0] . ' V1');
            }
        }

        $this->call([
            UsersTableSeeder::class,
            Universitas::class,
            // Pendaftaran::class
        ]);
    }
}
