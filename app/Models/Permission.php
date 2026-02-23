<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = [
        EntityField::LABEL,
        EntityField::CODE,
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, EntityTable::ROLE_PERMISSIONS, EntityField::PERMISSION_ID, EntityField::ROLE_ID);
    }
}
