<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        EntityField::REFERENCE_CODE,
        EntityField::NAME,
        EntityField::DESCRIPTION,
        EntityField::MARK,
        EntityField::COMPATIBLE_MODELS,
        EntityField::PRICE,
        EntityField::PROMOTIONAL_PRICE,
        EntityField::WEIGHT,
        EntityField::MEASURE_UNIT,
        EntityField::STATUS,
        EntityField::CATEGORY_ID,
        EntityField::SELLER_ID,
    ];
}
