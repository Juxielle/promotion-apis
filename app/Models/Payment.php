<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        EntityField::TOTAL_PRICE,
        EntityField::ORDER_ID,
        EntityField::PAYMENT_MEAN_ID,
    ];
}
