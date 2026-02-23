<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        EntityField::NAME,
        EntityField::FIRSTNAME,
        EntityField::SEX,
        EntityField::EMAIL,
    ];
}
