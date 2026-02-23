<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;

class PaymentMean extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        EntityField::CODE,
        EntityField::PAYMENT_MODE,
        EntityField::IMAGE,
    ];
}
