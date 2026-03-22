<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, EntityField::PAYMENT_MEAN_ID);
    }
}
