<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Rocky\Eloquent\HasDynamicRelation;

use App\Service\Control\Controller as ControllerSource;

class Verify extends Model
{
    use HasFactory;
    use HasDynamicRelation;
    protected $table = 'verify';
    protected $fillable = [
        "user_id",
        "key_reference",
        "key_for"
    ];
}
