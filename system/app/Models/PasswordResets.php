<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Rocky\Eloquent\HasDynamicRelation;


class PasswordResets extends Model
{
    protected $table = 'password_resets';
    protected $fillable = [
        "email",
        "token",
    ];
}
