<?php

namespace App\Models;

use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        EntityField::LABEL,
        EntityField::CODE,
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, EntityField::ROLE_ID);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, EntityTable::ROLE_PERMISSIONS, EntityField::ROLE_ID, EntityField::PERMISSION_ID);
    }
}
