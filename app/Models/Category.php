<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        EntityField::LABEL,
        EntityField::CODE,
        EntityField::IS_SERVICE,
    ];
}
