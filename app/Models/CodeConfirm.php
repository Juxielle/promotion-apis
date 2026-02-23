<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class CodeConfirm extends Model
{
    protected $fillable = [
        EntityField::EMAIL,
        EntityField::CODE,
    ];
}
