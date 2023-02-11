<?php

namespace Modules\V1\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
/*
|--------------------------------------------------------------------------
| CLASS TAMBAHAN
*/

use App\Service\Control\Controller as ControllerSource;
use App\Traits\ManagementModel;
use Modules\V1\Providers\ManagementServiceProvider;
/*
| end 
|--------------------------------------------------------------------------
*/

class Prodi extends Model
{
    use HasFactory;

    use ManagementModel;
    // use SoftDeletes;
    public function __construct(array $attributes = [])
    {
        /*
        |--------------------------------------------------------------------------
        | INSTANCE MODEL GENERATE
        */
        $instace = new ControllerSource("Prodi");
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $instace->instance($pathJson);
        $instace->setNameSpaceModel("\Modules\V1\Entities\\");
        /*
        | end 
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | SETTER DATA MODEL
        */
        $this->fillable = array_merge($instace->getFild());
        $this->table = $instace->table;
        $this->primaryKey = $instace->primary;
        /*
        | end
        |--------------------------------------------------------------------------

        /*
        |--------------------------------------------------------------------------
        | CREATE PROTECTED MODEL
        */
        if ($instace->created_protected()) {
            foreach ($instace->created_protected() as $name_protect => $protect) {
                $this->{$name_protect} = $protect;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE RELATION FUNCTION
        */
        $this->initial_function_relationship($this, $instace);
        /*
        | end
        |--------------------------------------------------------------------------
        */

        Model::__construct($attributes);
    }
    public static function item_priodi($items)
    {
        return  [
            "FAKULTAS" => $items->fakultas->nama_fakultas,
            "NAMA PRODI" => $items->nama_prodi,
            "SINGKATAN" => $items->nama_alias,
            "JENJANG" => $items->jenjang,
            "GELAR" => $items->gelar,
            "BIAYA" => convert_to_rupiah($items->biaya ?? 0),
            "AKREDITAS" => $items->akreditas,
            "KETUA PRODI" => $items->kepala_prodi,
            "SITUS WEB" => $items->situs_web,
        ];
    }
}
