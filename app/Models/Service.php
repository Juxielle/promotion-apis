<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        EntityField::NAME,
        EntityField::PRICE,
        EntityField::PROMOTIONAL_PRICE,
        EntityField::STATUS,
        EntityField::CATEGORY_ID,
        EntityField::SELLER_ID,
    ];
}
