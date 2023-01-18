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

class PersyaratanUmum extends Model
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
        $instace = new ControllerSource("PersyaratanUmum");
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
}
