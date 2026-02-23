<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        EntityField::NAME,
        EntityField::FIRSTNAME,
        EntityField::IS_SERVICE,
        EntityField::SEX,
        EntityField::EMAIL,
    ];
}
