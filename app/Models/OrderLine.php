<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        EntityField::ARTICLE_COUNT,
        EntityField::PRICE,
        EntityField::ORDER_ID,
        EntityField::PRODUCT_ID,
        EntityField::SERVICE_ID,
    ];
}
