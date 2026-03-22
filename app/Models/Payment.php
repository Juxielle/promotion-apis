<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function paymentMean(): BelongsTo
    {
        return $this->belongsTo(PaymentMean::class, EntityField::PAYMENT_MEAN_ID);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, EntityField::ORDER_ID);
    }
}
